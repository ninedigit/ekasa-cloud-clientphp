<?php

namespace NineDigit\eKasa\Cloud\Client;

final class ApiRequest {
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