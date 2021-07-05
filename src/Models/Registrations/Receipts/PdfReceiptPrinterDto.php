<?php

namespace NineDigit\eKasa\Cloud\Client\Models\Registrations\Receipts;

final class PdfReceiptPrinterDto extends ReceiptPrinterDto {
    /**
     * Nastavenia tlačiarne.
     */
    public PdfReceiptPrinterOptions $options;

    public function __construct(?PdfReceiptPrinterOptions $options = null) {
        $this->options = $options ?? new PdfReceiptPrinterOptions();
        parent::__construct(ReceiptPrinterName::PDF);
    }
}

?>