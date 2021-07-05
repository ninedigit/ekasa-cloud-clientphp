<?php

namespace NineDigit\eKasa\Cloud\Client\Exceptions;

class ApiException extends \Exception {
    /**
     * HTTP stavový kód
     */
    public ?int $statusCode;

    public function __construct(?int $statusCode = null, $message = "", $code = 0, \Throwable $previous = null) {
        $this->statusCode = $statusCode;
        parent::__construct($message, $code, $previous);
    }

    public function __toString() {
        $result = __CLASS__ . ": ";

        if ($this-> statusCode) {
            $result .= "[{$this->code}]: ";
        }

        $result .= "{$this->message}\n";
    }
}

?>