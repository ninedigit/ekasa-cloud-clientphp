<?php

namespace NineDigit\eKasa\Cloud\ApiClient;

use NineDigit\eKasa\Cloud\ApiClient\Authentication\NWS4ApiRequestMessageSigner;
use \Symfony\Component\Serializer\Encoder\JsonEncoder;
use \Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use \Symfony\Component\Serializer\Serializer;
use \GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;
use ReceiptRegistrationDto;

class Client {
  private Authentication\IApiRequestMessageSigner $requestMessageSigner;
  private Serializer $serializer;
  private array $defaultHttpHeaders;
  private $url;
  private $client;

  public function __construct(ClientOptions $options, ?Authentication\IApiRequestMessageSigner $requestMessageSigner = null) {
    $this->url = $options->url;
    $this->client = new GuzzleHttpClient([
      //'base_uri' => $this->url
    ]);

    $this->requestMessageSigner = $requestMessageSigner
      ?? new NWS4ApiRequestMessageSigner($options->publicKey, $options->privateKey);

    $this->defaultHttpHeaders = array();
    $this->defaultHttpHeaders['Accept'] = "application/json";
    $this->defaultHttpHeaders[$options->tenantKey] = $options->tenantId;

    $encoders = [new JsonEncoder()];
    $normalizers = [new ObjectNormalizer()];
    $this->serializer = new Serializer($normalizers, $encoders);
  }

  public function registerReceipt(Models\Registrations\Receipts\CreateReceiptRegistrationDto $receipt): Models\Registrations\Receipts\ReceiptRegistrationDto {
    $apiRequest = ApiRequestBuilder::createPost("/v1/registrations/receipts", $this->defaultHttpHeaders)
      ->withHeaders(function ($builder) {
        $builder->accept('application/json');
      })
      ->withPayload($receipt)
      ->build();
    
    $apiRequestMessage = $this->createJsonApiRequestMessage($apiRequest);
    $this->signRequestMessage($apiRequestMessage);

    $apiResponseMessage = $this->sendRequestMessage($apiRequestMessage);
    $result = $this->deserializeJsonApiResponseMessage($apiResponseMessage, ReceiptRegistrationDto::class);

    return $result;
  }

  private function signRequestMessage(ApiRequestMessage $request) {
    $this->requestMessageSigner->sign($request);
  }

  private function sendRequestMessage(ApiRequestMessage $request): ApiResponseMessage {
    $body = '';
    
    try {
      $guzzleRequest = new Request(
        $request->method,
        $request->url,
        $request->headers,
        $request->body);

      $guzzleResponse = $this->client->send($guzzleRequest, ['debug' => true, 'proxy' => "127.0.0.1:8888"]); // Use 'proxy' => "127.0.0.1:8888" option when debugging
      $body = $guzzleResponse->getBody();
    } catch (RequestException $ex) {
      if ($ex->hasResponse()) {
        $guzzleResponse = $ex->getResponse();
        $body = $ex->getResponse()->getBody()->getContents();
      } else {
        throw $ex;
      }
    }

    foreach ($guzzleResponse->getHeaders() as $key => $value)
      $headers[$key] = $value;

    $response = new ApiResponseMessage();
    $response->statusCode = $guzzleResponse->getStatusCode();
    $response->headers = $headers;
    $response->body = $body;

    return $response;
  }

  private function createJsonApiRequestMessage(ApiRequest $request): ApiRequestMessage {
    if (!str_starts_with($request->url, $this->url)) {
      $url = $this->url . '/' . trim($request->url, '/');
    }

    $body = json_encode($request->payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

    if (!array_key_exists('Content-Type', $request->headers) || empty($request->headers['Content-Type'])) {
      $request->headers['Content-Type'] = 'application/json; charset=utf-8';
    }

    $apiRequestMessage = new ApiRequestMessage($request->method, $url, $request->headers, $body);

    return $apiRequestMessage;
  }

  private function deserializeJsonApiResponseMessage(ApiResponseMessage $response, $classType): mixed {
    if ($response->statusCode === 400 || $response->statusCode === 422) {
      $validationProblemDetails = $this->deserializeJson($response->body, ValidationProblemDetails::class);
      throw new ValidationProblemDetailsException($validationProblemDetails);
    } else if ($response->statusCode >= 200 && $response->statusCode <= 299) {
      return $this->deserializeJson($response->body, $classType);
    } else {
      $problemDetails = $this->deserializeJson($response->body, ProblemDetails::class);
      throw new Exceptions\ProblemDetailsException($problemDetails);
    }
  }

  private function deserializeJson(string $content, $classType): mixed {
    return $this->serializer->deserialize($content, $classType, 'json');
  }
}