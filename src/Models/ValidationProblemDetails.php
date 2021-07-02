<?php

namespace NineDigit\eKasa\Cloud\ApiClient\Models;

/**
 * A Microsoft.AspNetCore.Mvc.ProblemDetails for validation errors.
 */
class ValidationProblemDetails extends ProblemDetails {
    /**
     * Gets the validation errors associated with this instance
     * of ValidationProblemDetails.
     * @var array of string keys and string containing array values
     * @example array("field1" => array("error1", "error2"))
     */
    public array $errors;
}
?>