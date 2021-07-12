<?php

namespace NineDigit\eKasa\Cloud\Client\Models\Registrations\Receipts;

final class ReceiptRegistrationDto extends ReceiptRegistrationDtoBase {
    /**
     * Požiadavka evidencie dokladu.
     */
    public ReceiptRegistrationRequestDto $request;

    public function __construct(
        ?ReceiptRegistrationRequestDto $request = null
    ) {
        $this->request = $request ?? new ReceiptRegistrationRequestDto();
    }
}

?>