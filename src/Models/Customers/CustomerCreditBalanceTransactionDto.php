<?php

namespace NineDigit\eKasa\Cloud\Client\Models\Customers;

use NineDigit\eKasa\Cloud\Client\Models;
use NineDigit\eKasa\Cloud\Client\Models\UserRawMetaDto;
use NineDigit\eKasa\Cloud\Client\Models\CreditDto;
use NineDigit\eKasa\Cloud\Client\Models\CreationAuditedEntityDto;

/**
 * Záznam transakcie na zákazníckom profile
 */
final class CustomerCreditBalanceTransactionDto extends CreationAuditedEntityDto {
    /**
     * Poradové číslo transakcie, podľa ktorého sa transakcie
     * v zozname zoraďujú. Táto hodnota nie je unikátny identifikátor
     * a môže sa po aktualizácií zákazníka zmeniť.
     */
    public int $sequenceNumber;
    /**
     * Unikátny externý identifikátor transakcie
     */
    public ?string $externalId;
    /**
     * Výška transakcie
     */
    public CreditDto $amount;
    /**
     * Typ transakcie
     */
    public string $type;
    /**
     * Stav zákazníckeho kreditu po aplikovaní transakcie
     */
    public CreditDto $endingCreditBalance;
    /**
     * Poznámka
     */
    public ?string $note;
    /**
     * Meta dáta
     */
    public ?array $meta;
    /**
     * Kolekcia meta dát viazaných na kokrétnych používateľov
     * @var UserRawMetaDto[]
     */
    public array $userMeta;
    /**
     * Unikátny identifikátor zákazníka, ku ktorému táto transakcia patrí
     */
    public string $customerId;
}

?>