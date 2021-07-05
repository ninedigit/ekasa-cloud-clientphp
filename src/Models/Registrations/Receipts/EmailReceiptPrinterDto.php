<?php

namespace NineDigit\eKasa\Cloud\Client\Models\Registrations\Receipts;

final class EmailReceiptPrinterDto extends ReceiptPrinterDto {
    /**
     * Nastavenia tlačiarne.
     */
    public EmailReceiptPrinterOptions $options;

    public function __construct(?EmailReceiptPrinterOptions $options = null) {
        $this->options = $options ?? new EmailReceiptPrinterOptions();
        parent::__construct(ReceiptPrinterName::EMAIL, $options);
    }
}

?>