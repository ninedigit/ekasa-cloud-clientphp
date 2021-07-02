<?php

namespace NineDigit\eKasa\Cloud\ApiClient;

final class ApiResponseMessage {
    public int $statusCode;
    public array $headers;
    public ?string $body;
}

?>