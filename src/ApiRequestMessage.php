<?php

namespace NineDigit\eKasa\Cloud\ApiClient;

class ApiRequestMessage {
  public $method;
  public $url;
  public $body = '';
  public $headers = array();

  public function __construct(string $method, string $url, array $headers = array(), string $body = '') {
    $this->method = $method;
    $this->url = $url;
    $this->headers = $headers;
    $this->body = $body;
  }
}

?>