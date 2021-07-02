<?php

namespace NineDigit\eKasa\Cloud\ApiClient\Models;

/**
 * Typ identifikátora kupujúceho
 */
final class CustomerIdType {
    /**
     * Identifikačné číslo organizácie, ak bolo pridelené
     */
    const ICO = "ICO";
    /**
     * Daňové identifikačné číslo
     */
    const DIC = "DIC";
    /**
     * Identifikačné číslo pre daň z pridanej hodnoty
     */
    const ICDPH = "ICDPH";
    /**
     * Iný typ identifikátora kupujúceho ako sú IČO, DIČ alebo IČ DPH
     */
    const OTHER = "Other";

    private function __construct() {
    }
}

?>