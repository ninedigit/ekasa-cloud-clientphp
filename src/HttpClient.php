<?php

namespace NineDigit\eKasa\Cloud\Client;

use NineDigit\eKasa\Cloud\Client\Authentication\NWS4ApiRequestMessageSigner;
use NineDigit\eKasa\Cloud\Client\Authentication\ApiRequestMessageSignerInterface;
use NineDigit\eKasa\Cloud\Client\Exceptions\ValidationProblemDetailsException;
use \GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;
use NineDigit\eKasa\Cloud\Client\Models\ProblemDetails;
use NineDigit\eKasa\Cloud\Client\Models\ValidationProblemDetails;
use NineDigit\eKasa\Cloud\Client\Serialization\SerializerInterface;
use NineDigit\eKasa\Cloud\Client\Serialization\SymfonyJsonSerializer;


final class HttpClient implements HttpClientInterface {
  private ApiRequestMessageSignerInterface $requestMessageSigner;
  private SerializerInterface $serializer;
  private array $defaultHttpHeaders;
  private $client;
  private $url;

  public function __construct(ApiClientOptions $options) {
    $this->url = $options->url;

    $guzzleHttpClientConfig = [
      //'base_uri' => $this->url
    ];

    if (!empty($options->proxyUrl)) {
      $guzzleHttpClientConfig["proxy"] = $options->proxyUrl;
    }

    $this->client = new GuzzleHttpClient($guzzleHttpClientConfig);

    $this->requestMessageSigner = $options->requestMessageSigner
      ?? new NWS4ApiRequestMessageSigner($options->publicKey, $options->privateKey);
    $this->serializer = $options->serializer ?? new SymfonyJsonSerializer();

    $this->defaultHttpHeaders = array();
    $this->defaultHttpHeaders["__tenant"] = $options->tenantId;
  }

  public function send(ApiRequest $request, $sign = false, $type = null): void {
    $requestMessage = $this->createRequestMessage($request, $sign);
    $responseMessage = $this->sendRequestMessage($requestMessage);

    if (!$responseMessage->isSuccessStatusCode()) {
      $problemDetails = $this->getProblemDetails($response);
      throw new Exceptions\ProblemDetailsException($problemDetails);
    }
  }

  public function receive(ApiRequest $request, $type, $sign = false) {
    $requestMessage = $this->createRequestMessage($request, $sign);
    $responseMessage = $this->sendRequestMessage($requestMessage);
    $result = $this->deserializeResponseMessage($responseMessage, $type);

    return $result;
  }

  private function createRequestMessage(ApiRequest $request, $sign = false): ApiRequestMessage {
    if (!str_starts_with($request->url, $this->url)) {
      $url = $this->url . '/' . trim($request->url, '/');
    }

    $body = $this->serializer->serialize($request->payload);
    $headers = array_merge($this->defaultHttpHeaders, $request->headers);

    if (!array_key_exists('Content-Type', $headers) || empty($headers['Content-Type'])) {
      $headers['Content-Type'] = 'application/json; charset=utf-8';
    }

    if (!array_key_exists('Accept', $headers) || empty($headers['Accept'])) {
      $headers['Accept'] = "application/json";
    }

    $apiRequestMessage = new ApiRequestMessage($request->method, $url, $headers, $body);

    if ($sign === true) {
      $this->signRequestMessage($apiRequestMessage);
    }

    return $apiRequestMessage;
  }

  private function sendRequestMessage(ApiRequestMessage $request): ApiResponseMessage {
    $body = '';
    
    try {
      $guzzleRequest = new Request(
        $request->method,
        $request->url,
        $request->headers,
        $request->body);

      $guzzleResponse = $this->client->send($guzzleRequest, ['debug' => true]);
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

  private function signRequestMessage(ApiRequestMessage $request) {
    $this->requestMessageSigner->sign($request);
  }

  private function deserializeResponseMessage(ApiResponseMessage $response, $classType) {
    if ($response->isSuccessStatusCode()) {
      return $this->serializer->deserialize($response->body, $classType);
    } else {
      $problemDetails = $this->getProblemDetails($response);
      throw new Exceptions\ProblemDetailsException($problemDetails);
    }
  }

  private function getProblemDetails(ApiResponseMessage $response): ?ProblemDetails {
    if ($response->isSuccessStatusCode()) {
      throw new Exception("Unable to get error from successful response.");
    }

    if ($response->statusCode === 400 || $response->statusCode === 422) {
      $validationProblemDetails = $this->serializer->deserialize($response->body, ValidationProblemDetails::class);
      throw new ValidationProblemDetailsException($validationProblemDetails);
    } else {
      $problemDetails = $this->serializer->deserialize($response->body, ProblemDetails::class);
      throw new Exceptions\ProblemDetailsException($problemDetails);
    }
  }
}