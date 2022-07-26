<?php

namespace NineDigit\eKasa\Cloud\Client\Models;

/**
 * Kredit
 */
final class CreditDto {
    /**
     * Hodnota kreditu
     */
    public float $amount;
    /**
     * Mena, v ktorej je kredit vedený
     */
    public ?string $currency;
}

?>