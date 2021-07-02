<?php

namespace NineDigit\eKasa\Cloud\ApiClient\Models\Registrations\Receipts;

final class ReceiptRegistrationResponseDto {
    /**
     * Chybová správa.
     */
    public ?string $error;
    /**
     * Chybová správa zo systému e-Kasa.
     */
    public ?string $eKasaError;
    /**
     * Kód chybovej správy zo systému e-Kasa.
     */
    public ?int $eKasaErrorCode;
}

?>