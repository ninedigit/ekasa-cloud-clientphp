<?php

namespace NineDigit\eKasa\Cloud\Client;

use NineDigit\eKasa\Cloud\Client\HttpMethod;

final class ApiRequestBuilder {
  private ApiRequestHeadersBuilder $headersBuilder;
  private string $method;
  private string $url;
  private ?object $payload;

  public function __construct(string $method, string $url, array $defaultHeaders = array()) {
    $this->headersBuilder = new ApiRequestHeadersBuilder($defaultHeaders);
    $this->method = $method;
    $this->url = $url;
    $this->payload = null;
  }

  function withPayload(?object $payload): ApiRequestBuilder {
    $this->payload = $payload;
    return $this;
  }

  /**
   * Metóda na nastavenie hlavičiek
   * @param mixed $headersOrCallable Pole hlavičiek alebo vyvolateľná funkcia preberajúca ApiRequestHeadersBuilder.
   */
  function withHeaders(mixed $headersOrCallable): ApiRequestBuilder {
    if (is_callable($headersOrCallable)) {
      $headersOrCallable($this->headersBuilder);
    } else if (is_array($headers)) {
      $this->headersBuilder->set($defaultHeaders);
    } else {
      throw new \InvalidArgumentException("Expecting array or callable as an argument.");
    }
    return $this;
  }

  function build(): ApiRequest {
    $headers = $this->headersBuilder->build();
    $apiRequest = new ApiRequest($this->method, $this->url, $headers, $this->payload);

    return $apiRequest;
  }

  public static function createGet(string $url, array $defaultHeaders = array()): ApiRequestBuilder {
    return new ApiRequestBuilder(HttpMethod::GET, $url, $defaultHeaders);
  }

  public static function createPost(string $url, array $defaultHeaders = array()): ApiRequestBuilder {
    return new ApiRequestBuilder(HttpMethod::POST, $url, $defaultHeaders);
  }

  public static function createPut(string $url, array $defaultHeaders = array()): ApiRequestBuilder {
    return new ApiRequestBuilder(HttpMethod::PUT, $url, $defaultHeaders);
  }

  public static function createDelete(string $url, array $defaultHeaders = array()): ApiRequestBuilder {
    return new ApiRequestBuilder(HttpMethod::DELETE, $url, $defaultHeaders);
  }

  public static function fromApiRequest(ApiRequest $apiRequest, array $defaultHeaders = array()): ApiRequestBuilder {
    $headers = array_merge($defaultHeaders, $apiRequest->headers);
    $builder = new ApiRequestBuilder($apiRequest->method, $apiRequest->url, $headers);
    $builder->withPayload($apiRequest->payload);

    return $builder;
  }
}

?>