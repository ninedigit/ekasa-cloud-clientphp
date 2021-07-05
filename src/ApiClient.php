<?php

namespace NineDigit\eKasa\Cloud\Client;

use NineDigit\eKasa\Cloud\Client\Authentication\NWS4ApiRequestMessageSigner;
use NineDigit\eKasa\Cloud\Client\Authentication\ApiRequestMessageSignerInterface;
use NineDigit\eKasa\Cloud\Client\Exceptions\ValidationProblemDetailsException;
use \GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;
use NineDigit\eKasa\Cloud\Client\Models\Registrations\Receipts\CreateReceiptRegistrationDto;
use NineDigit\eKasa\Cloud\Client\Models\Registrations\Receipts\ReceiptRegistrationDto;
use NineDigit\eKasa\Cloud\Client\Serialization\SerializerInterface;
use NineDigit\eKasa\Cloud\Client\Serialization\SymfonyJsonSerializer;


final class ApiClient {
  private ApiRequestMessageSignerInterface $requestMessageSigner;
  private SerializerInterface $serializer;
  private array $defaultHttpHeaders;
  private $url;
  private $client;

  public function __construct(
    ApiClientOptions $options,
    ?ApiRequestMessageSignerInterface $requestMessageSigner = null,
    ?SerializerInterface $serializer = null
    ) {
    $this->url = $options->url;
    $this->client = new GuzzleHttpClient([
      //'base_uri' => $this->url
    ]);

    $this->requestMessageSigner = $requestMessageSigner
      ?? new NWS4ApiRequestMessageSigner($options->publicKey, $options->privateKey);
    $this->serializer = $serializer ?? new SymfonyJsonSerializer();

    $this->defaultHttpHeaders = array();
    $this->defaultHttpHeaders['Accept'] = "application/json";
    $this->defaultHttpHeaders[$options->tenantKey] = $options->tenantId;
  }

  public function registerReceipt(CreateReceiptRegistrationDto $receipt): ReceiptRegistrationDto {
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

    $body = $this->serializer->serialize($request->payload);

    if (!array_key_exists('Content-Type', $request->headers) || empty($request->headers['Content-Type'])) {
      $request->headers['Content-Type'] = 'application/json; charset=utf-8';
    }

    $apiRequestMessage = new ApiRequestMessage($request->method, $url, $request->headers, $body);

    return $apiRequestMessage;
  }

  private function deserializeJsonApiResponseMessage(ApiResponseMessage $response, $classType): mixed {
    if ($response->statusCode === 400 || $response->statusCode === 422) {
      $validationProblemDetails = $this->serializer->deserialize($response->body, ValidationProblemDetails::class);
      throw new ValidationProblemDetailsException($validationProblemDetails);
    } else if ($response->statusCode >= 200 && $response->statusCode <= 299) {
      return $this->serializer->deserialize($response->body, $classType);
    } else {
      $problemDetails = $this->serializer->deserialize($response->body, ProblemDetails::class);
      throw new Exceptions\ProblemDetailsException($problemDetails);
    }
  }
}