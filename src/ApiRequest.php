<?php

namespace NineDigit\eKasa\Cloud\ApiClient;

class ApiRequest {
  public string $method;
  public string $url;
  public array $headers = array();
  public ?object $payload = null;

  public function __construct(string $method, string $url, array $headers = array(), ?object $payload = null) {
    $this->method = $method;
    $this->url = $url;
    $this->headers = $headers;
    $this->payload = $payload;
  }
}

?>