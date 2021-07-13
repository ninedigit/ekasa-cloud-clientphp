<?php

namespace NineDigit\eKasa\Cloud\Client\Models\Registrations\Receipts;


/**
 * Dôvod zamietnutia spracovania požiadavky zo strany ORP.
 */
final class RegistrationCancellationReasonDto {
    /**
     * Dôvod zamietnutia spracovania požiadavky.
     */
    public string $message;
    /**
     * Voliteľný kód dôvodu zamietnutia spracovania požiadavky.
     */
    public ?int $code;
}

?>