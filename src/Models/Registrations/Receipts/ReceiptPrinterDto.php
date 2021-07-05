<?php

namespace NineDigit\eKasa\Cloud\Client\Models\Registrations\Receipts;

use Symfony\Component\Serializer\Annotation\DiscriminatorMap;

/**
 * @DiscriminatorMap(typeProperty="name", mapping={
 *    "pos"="NineDigit\eKasa\Cloud\Client\Models\Registrations\Receipts\PosReceiptPrinterDto",
 *    "pdf"="NineDigit\eKasa\Cloud\Client\Models\Registrations\Receipts\PdfReceiptPrinterDto",
 *    "email"="NineDigit\eKasa\Cloud\Client\Models\Registrations\Receipts\EmailReceiptPrinterDto"
 * })
 */
abstract class ReceiptPrinterDto {
    /**
     * Názov tlačiarne, na ktorej bude doklad spracovaný.
     * Dostupné možnosti: pos, pdf, email.
     * @see ReceiptPrinterName
     */
    public string $name;

    /**
     * Nastavenia tlačiarne.
     */
    // public ?ReceiptPrinterOptions $options;
    
    public function __construct(?string $name/*, ?ReceiptPrinterOptions $options = null*/) {
        $this->name = $name;
        //$this->options = $options;
    }
}

?>