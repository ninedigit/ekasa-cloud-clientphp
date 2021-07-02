<?php

namespace NineDigit\eKasa\Cloud\ApiClient;

class ApiRequestHeadersBuilder {
  private array $headers;

  public function __construct(array $defaultHeaders = array()) {
    $this->headers = $defaultHeaders;
  }

  public function setDefault(array $defaultHeaders): ApiRequestHeadersBuilder {
    foreach ($defaultHeaders as $key => $value) {
      $this->headers[$key] = $value;
    }
    return $this;
  }

  public function accept(string $value): ApiRequestHeadersBuilder {
    $this->headers['Accept'] = $value;
    return $this;
  }

  public function build(): array {
    return $this->headers;
  }
}

?>