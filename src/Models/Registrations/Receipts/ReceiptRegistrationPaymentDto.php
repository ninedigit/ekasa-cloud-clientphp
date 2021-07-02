<?php

namespace NineDigit\eKasa\Cloud\ApiClient\Models\Registrations\Receipts;

/**
 * Platidlo
 */
final class ReceiptRegistrationPaymentDto {
    /**
     * Názov platidla v dĺžke 1 až 255 znakov
     * @example Hotovosť
     */
    public string $name;
    /**
     * Celková suma v EUR.
     * Číslo v rozsahu -10000000 až 10000000 s presnosťou na dve desatinné miesta.
     * @example 15.00
     */
    public float $amount;

    public function __construct(float $amount, string $name = "Hotovosť") {
        $this->amount = $amount;
        $this->name = $name;
    }
}

?>