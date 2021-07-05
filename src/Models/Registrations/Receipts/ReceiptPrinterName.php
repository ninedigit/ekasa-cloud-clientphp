<?php

namespace NineDigit\eKasa\Cloud\Client\Models\Registrations\Receipts;

/**
 * Názov tlačiarne.
 */
final class ReceiptPrinterName {
    /**
     * Označuje názov tlačiarne papierových dokladov.
     */
    public const POS = "pos";
    /**
     * Označuje názov tlačiarne vyhotovujúci PDF súbory.
     */
    public const PDF = "pdf";
    /**
     * Označuje názov tlačiarne vyhotuvujúci emailové správy.
     */
    public const EMAIL = "email";

    private function __construct() {
    }
}

?>