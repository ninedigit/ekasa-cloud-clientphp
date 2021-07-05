<?php

namespace NineDigit\eKasa\Cloud\Client\Models\Registrations\Receipts;

/**
 * Objekt nastavení elektronického dokladu.
 */
final class EmailReceiptPrinterOptions extends ReceiptPrinterOptions {
    /**
     * Povinná e-mailová adresa adresáta (príjemca e-mailu).
     * @example mail@mail.com
     */
    public string $to;

    /**
     * Zobrazovacie meno adresáta (príjemca e-mailu).
     */
    public ?string $recipientDisplayName;

    /**
     * Nepovinný predmet e-mailu. Ak je uvedené (nie <c>null</c>), 
     * aplikácia uprednostní túto hodnotu pred hodnotou v nastaveniach aplikácie.
     */
    public ?string $subject;

    /**
     * Nepovinné telo e-mailu. Ak je uvedené (nie <c>null</c>), aplikácia 
     * uprednostní túto hodnotu pred hodnotou v nastaveniach aplikácie.
     */
    public ?string $body;

    public function __construct(string $to = "mail@mail.com") {
        $this->to = $to;
    }
}

?>