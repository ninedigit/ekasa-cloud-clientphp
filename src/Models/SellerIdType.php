<?php

namespace NineDigit\eKasa\Cloud\Client\Models;

/**
 * Typ identifikátora predávajúceho, v ktorého mene bol predaný tovar alebo poskytnutá služba.
 */
final class SellerIdType {
    /**
     * Daňové identifikačné číslo.
     */
    const DIC = "DIC";
    /**
     * Identifikačné číslo pre daň z pridanej hodnoty.
     */
    const ICDPH = "ICDPH";

    private function __construct() {
    }
}

?>