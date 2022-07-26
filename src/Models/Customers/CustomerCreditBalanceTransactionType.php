<?php

namespace NineDigit\eKasa\Cloud\Client\Models\Customers;

/**
 * Typ transakcie
 */
final class CustomerCreditBalanceTransactionType {
    /**
     * Spotreba/navýšenie (cash-back) kreditu
     */
    public const ADJUSTMENT = "Adjustment";
    /**
     * Navýšenie kreditu dobitím
     */
    public const DEPOSIT = "Deposit";
    /**
     * Výber kreditu
     */
    public const WITHDRAWAL = "Withdrawal";
    /**
     * Manuálna zmena kreditu
     */
    public const CORRECTION = "Correction";
    /**
     * Iný typ pohybu
     */
    public const OTHER = "Other";
}

?>