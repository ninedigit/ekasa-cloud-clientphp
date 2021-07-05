<?php

namespace NineDigit\eKasa\Cloud\Client\Exceptions;

use NineDigit\eKasa\Cloud\Client\Models\ValidationProblemDetails;
use NineDigit\eKasa\Cloud\Client\Exceptions\ProblemDetailsException;

final class ValidationProblemDetailsException extends ProblemDetailsException {
    private ValidationProblemDetails $validationProblemDetails;

    public function __construct(ValidationProblemDetails $details, $code = 0, \Throwable $previous = null) {
        $this->validationProblemDetails = $details;
        parent::__construct($details, $code, $previous);
    }

    public function __toString() {
        $result = parent::__toString() . "\nErrors  :\n";

        foreach ($this->validationProblemDetails->errors as $key => $value) {
            $errors = implode(", ", $value);
            $result = $result . " - {$key}: {$errors}\n";
        }

        return $result;
    }

    public function getValidationDetails(): ValidationProblemDetails {
        return $this->validationProblemDetails;
    }
}

?>