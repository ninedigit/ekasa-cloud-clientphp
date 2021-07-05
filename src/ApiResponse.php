<?php

namespace NineDigit\eKasa\Cloud\Client;

final class ApiResponse {
  public int $statusCode;
  public array $headers;
  public ?object $payload;

  public function __construct(int $statusCode, array $headers, ?object $payload = null) {
    $this->statusCode = $statusCode;
    $this->headers = $headers;
    $this->payload = $payload;
  }
}

?>