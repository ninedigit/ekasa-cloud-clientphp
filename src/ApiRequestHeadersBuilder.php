<?php

namespace NineDigit\eKasa\Cloud\Client;

final class ApiRequestHeadersBuilder {
  private array $headers;

  public function __construct(array $defaultHeaders = array()) {
    $this->headers = $defaultHeaders;
  }

  public function set(array $headers): ApiRequestHeadersBuilder {
    foreach ($headers as $key => $value) {
      $this->headers[$key] = $value;
    }
    return $this;
  }

  public function accept(string $value): ApiRequestHeadersBuilder {
    $this->headers['Accept'] = $value;
    return $this;
  }

  public function clear(): void {
    array_splice($this->headers, 0);
  }

  public function build(): array {
    return $this->headers;
  }
}

?>