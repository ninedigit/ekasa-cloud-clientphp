<?php

namespace NineDigit\eKasa\Cloud\Client;

final class ApiResponseMessage {
    public int $statusCode;
    public array $headers;
    public ?string $body;
}

?>