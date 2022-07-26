<?php

namespace NineDigit\eKasa\Cloud\Client\Models\Customers;

/**
 * Stav zákazníckeho profilu
 */
final class CustomerState {
    /**
     * Platný.
     */
    public const VALID = "Valid";
    /**
     * Ešte nie je platný. Aktuálny dátum je skorší ako activationTime.
     */
    public const NOT_YET_VALID = "NotYetValid";
    /**
     * Exspirovaný.
     */
    public const EXPIRED = "Expired";
}

?>