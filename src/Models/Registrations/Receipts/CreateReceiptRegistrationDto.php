<?php

namespace NineDigit\eKasa\Cloud\ApiClient\Models\Registrations\Receipts;

final class CreateReceiptRegistrationDto {
    /**
     * Tlačiareň, na ktorej bude doklad spracovaný.
     */
    public ReceiptPrinterDto $printer;

    /**
     * Doklad.
     */
    public CreateReceiptRegistrationRequestDto $request;

    /**
     * Hraničný čas v milisekundách, počas ktorého bude server 
     * čakať vybavenie požiadavky registračnou pokladňou.
     */
    public int $validityTimeSpan;

    public function __construct(
        ?ReceiptPrinterDto $printer = null,
        ?CreateReceiptRegistrationRequestDto $request = null,
        int $validityTimeSpan = 5000
    ) {
        $this->printer = $printer ?? new ReceiptPrinterDto();
        $this->request = $request ?? new CreateReceiptRegistrationRequestDto();
        $this->validityTimeSpan = $validityTimeSpan;
    }
}

?>