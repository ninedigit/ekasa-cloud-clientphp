<?php

namespace NineDigit\eKasa\Cloud\Client\Models;

/**
 * A Microsoft.AspNetCore.Mvc.ProblemDetails for validation errors.
 */
final class ValidationProblemDetails extends ProblemDetails {
    /**
     * Gets the validation errors associated with this instance
     * of ValidationProblemDetails.
     * @var array
     * @example array("field1" => array("error1", "error2"))
     */
    public array $errors;

    public function __construct() {
        $this->title = "Validation failed.";
    }
}
?>