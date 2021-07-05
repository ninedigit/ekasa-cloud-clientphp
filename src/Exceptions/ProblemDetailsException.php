<?php

namespace NineDigit\eKasa\Cloud\Client\Exceptions;

use NineDigit\eKasa\Cloud\Client\Models\ProblemDetails;
use NineDigit\eKasa\Cloud\Client\Exceptions\ApiException;

class ProblemDetailsException extends ApiException {
    public ProblemDetails $details;

    public function __construct(ProblemDetails $details, $code = 0, \Throwable $previous = null) {
        $this->details = $details;
        $statusCode = $details->status;
        $message = "{$details->type} : {$details->title}";
        parent::__construct($statusCode, $message, $code, $previous);
    }

    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n" .
        "Type    : {$this->details->type}\n" .
        "Title   : {$this->details->title}\n" .
        "Status  : {$this->details->status}\n" .
        "Detail  : {$this->details->detail}\n" .
        "Instance: {$this->details->instance}";
    }
}

?>