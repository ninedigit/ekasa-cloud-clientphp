<?php

namespace NineDigit\eKasa\Cloud\ApiClient\Models\Registrations\Receipts;

/**
 * Typ dokladu
 */
final class ReceiptType {
    /**
     * Pokladničný doklad
     */
    const CASH_REGISTER = "CashRegister";
    /**
     * Neplatný doklad
     */
    const INVALID = "Invalid";
    /**
     * Paragón
     */
    const PARAGON = "Paragon";
    /**
     * Úhrada faktúry
     */
    const INVOICE = "Invoice";
    /**
     * Paragón pri úhrade faktúry
     */
    const INVOICE_PARAGON = "InvoiceParagon";
    /**
     * Doklad označený slovom „Vklad“
     */
    const DEPOSIT = "Deposit";
    /**
     * Doklad označený slovom „Výber“
     */
    const WITHDRAW = "Withdraw";

    private function __construct() {
    }
}

?>