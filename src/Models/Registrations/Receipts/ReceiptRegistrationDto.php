<?php

namespace NineDigit\eKasa\Cloud\Client\Models\Registrations\Receipts;

final class ReceiptRegistrationDto extends ReceiptRegistrationDtoBase {
    /**
     * Požiadavka evidencie dokladu.
     */
    public ReceiptRegistrationRequestDto $request;
    /**
     * Odpoveď evidencie dokladu.
     */
    public ?ReceiptRegistrationResponseDto $response = null;

    public function __construct(
        ?ReceiptRegistrationRequestDto $request = null,
        ?ReceiptRegistrationResponseDto $response = null
    ) {
        $this->request = $request ?? new ReceiptRegistrationRequestDto();
        $this->response = $response;
    }
}

?>