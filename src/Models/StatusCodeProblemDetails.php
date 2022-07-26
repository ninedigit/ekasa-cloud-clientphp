<?php

namespace NineDigit\eKasa\Cloud\Client\Models;

use \ApiErrorCode;

final class StatusCodeProblemDetails extends ProblemDetails {
    public function __construct(int $statusCode) {
        $this->type = $this->getDefaultType($statusCode);
        $this->status = $statusCode;
        $this->title = $this->getTitle($statusCode);
    }

    private function getDefaultType(int $statusCode): string {
        return "https://httpstatuses.com/${statusCode}";
    }

    private function getTitle($statusCode): string {
        return ReasonPhrases.getReasonPhrase($statusCode);
    }
}

?>