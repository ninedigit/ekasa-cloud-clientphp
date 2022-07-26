<?php

namespace NineDigit\eKasa\Cloud\Client\Models\Customers;

/**
 * Identifikátor vydavateľa zákazníckej karty
 */
final class CustomerCardProcessorNames {
    /**
     * Generický vydávateľ kariet
     */
    public const GENERAL = "G";
    /**
     * Vydavateľ fyzických kariet
     */
    public const PHYSICAL = "P";
    /**
     * Vydavateľ kariet pre Apple Wallet
     */
    public const APPLE_WALLET = "AW";
    /**
     * Vydavateľ kariet pre Google Wallet
     */
    public const GOOGLE_WALLET = "GW";
}

?>