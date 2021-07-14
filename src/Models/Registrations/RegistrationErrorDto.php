<?php

namespace NineDigit\eKasa\Cloud\Client\Models\Registrations;

final class RegistrationErrorDto {
    /**
     * Chybová správa.
     */
    public string $message;
    /**
     * Kód chybovej správy.
     */
    public ?string $code;
    /**
     * Pôvod chybovej správy.
     */
    public ?string $source;
    /**
     * Sledovac=í kód požiadavky.
     */
    public ?string $traceId;
}

?>