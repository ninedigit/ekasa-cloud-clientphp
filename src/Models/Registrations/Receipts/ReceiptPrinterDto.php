<?php

namespace NineDigit\eKasa\Cloud\ApiClient\Models\Registrations\Receipts;

final class ReceiptPrinterDto {
    /**
     * Názov tlačiarne, na ktorej bude doklad spracovaný.
     * Dostupné možnosti: pos, pdf, email.
     * @see ReceiptPrinterName
     */
    public string $name;
    /**
     * Nastavenia tlačiarne.
     * Jednotlivé tlačiarne majú rozličné nastavenia a to:
     * Tlačiareň "pos" používa PosReceiptPrinterOptions,
     * tlačiareň "pdf" používa PdfReceiptPrinterOptions,
     * tlačiareň "email" používate EmailReceiptPrinterOptions.
     */
    public ?ReceiptPrinterOptions $options;

    public function __construct(?string $name = "pos", ?ReceiptPrinterOptions $options = null) {
        $this->name = $name;
        $this->options = $options;
    }
}

?>