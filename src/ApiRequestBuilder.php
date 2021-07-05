<?php

namespace NineDigit\eKasa\Cloud\Client;

final class ApiRequestBuilder {
  private ApiRequestHeadersBuilder $headersBuilder;
  private string $method;
  private string $url;
  private ?object $payload;

  public function __construct(string $method, string $url, array $defaultHeaders = array()) {
    $this->headersBuilder = new ApiRequestHeadersBuilder($defaultHeaders);
    $this->method = $method;
    $this->url = $url;
  }

  function withPayload(?object $payload): ApiRequestBuilder {
    $this->payload = $payload;
    return $this;
  }

  function withDefaultHeaders(array $defaultHeaders): ApiRequestBuilder {
    $this->headersBuilder->setDefault($defaultHeaders);
    return $this;
  }

  function withHeaders(callable $callable): ApiRequestBuilder {
    $callable($this->headersBuilder);
    return $this;
  }

  function build(): ApiRequest {
    $headers = $this->headersBuilder->build();
    $apiRequest = new ApiRequest($this->method, $this->url, $headers, $this->payload);

    return $apiRequest;
  }

  public static function createPost(string $url, array $defaultHeaders = array()): ApiRequestBuilder {
    return new ApiRequestBuilder("POST", $url, $defaultHeaders);
  }
}

?>