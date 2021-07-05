<?php

namespace NineDigit\eKasa\Cloud\Client\Models\Registrations\Receipts;

final class PosReceiptPrinterDto extends ReceiptPrinterDto {
    /**
     * Nastavenia tlačiarne.
     */
    public PosReceiptPrinterOptions $options;

    public function __construct(?PosReceiptPrinterOptions $options = null) {
        $this->options = $options ?? new PosReceiptPrinterOptions();
        parent::__construct(ReceiptPrinterName::POS);
    }
}

?>