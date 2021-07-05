<?php

namespace NineDigit\eKasa\Cloud\Client\Models\Registrations\Receipts;

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
        ReceiptPrinterDto $printer,
        ?CreateReceiptRegistrationRequestDto $request,
        int $validityTimeSpan = 5000
    ) {
        $this->printer = $printer;
        $this->request = $request;
        $this->validityTimeSpan = $validityTimeSpan;
    }
}

?>