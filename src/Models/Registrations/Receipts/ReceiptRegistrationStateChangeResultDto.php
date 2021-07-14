<?php

namespace NineDigit\eKasa\Cloud\Client\Models\Registrations\Receipts;

final class ReceiptRegistrationStateChangeResultDto {
  /**
   * Indikuje, či zmena stavu požiadavky bola úspešná.
   */
  public bool $isSuccessful;
  /**
   * Požiadavka registrácie.
   * Hodnota je null, ak požiadavka nebola nájdená.
   */
  public ?ReceiptRegistrationDto $registration;
}

?>