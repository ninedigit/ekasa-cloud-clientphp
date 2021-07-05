<?php

namespace NineDigit\eKasa\Cloud\Client\Models\Registrations\Receipts;
use NineDigit\eKasa\Cloud\Client\Models;

final class CreateReceiptRegistrationRequestDto {
    /**
     * Externý unikátny identifikátor požiadavky.
     * Neprázdny reťazec s maximálnou dĺžkou 40 znakov.
     * @example e52ff4d1-f2ed-4493-9e9a-a73739b1ba17
     */
    public string $externalId;
    /**
     * Kód on-line registračnej pokladnice.
     * Textový reťazec pozostávajúci z čísel s dĺžkou 16 alebo 17 znakov.
     * @example 88812345678900001
     */
    public string $cashRegisterCode;
    /**
     * Typ pokladničného dokladu.
     * @var ReceiptType
     * @example CashRegister
     */
    public string $receiptType;
    /**
     * Dátum a čas vyhotovenia dokladu typu Paragon alebo InvoiceParagon.
     * Serializovaná hodnota musí byť typu reťazec v štandarde ISO 8601.
     */
    public ?\DateTime $issueDate;
    /**
     * Číslo faktúry.
     * Neprázdny textový reťazec s maximálnou dĺžkou 50 znakov, pre dokad typu Invoice
     * alebo InvoiceParagon, inak null.
     * @example 201801001
     */
    public ?string $invoiceNumber;
    /**
     * Číslo paragónu.
     * Číslo v rozsahu 1 až 4294967295 pre doklad typu Paragon, inak null.
     */
    public ?int $paragonNumber;
    /**
     * Celková suma v EUR.
     * Číslo v rozsahu -10000000 až 10000000 s presnosťou na dve desatinné miesta pre
     * doklad typu Invoice, InvoiceParagon, Deposit alebo Withdraw, inak null.
     */
    public ?float $amount;
    /**
     * Textová hlavička dokladu.
     * Textový reťazec, ktorý nesmie obsahovať kontrolné znaky, okrem znakov CR a LF.
     */
    public ?string $headerText;
    /**
     * Textová pätička dokladu.
     * Textový reťazec, ktorý nesmie obsahovať kontrolné znaky, okrem znakov CR a LF.
     */
    public ?string $footerText;
    /**
     * Identifikácia kupujúceho.
     * Identifikácia kupujúceho alebo null pre doklad typu iný ako Invalid, Deposit a 
     * Withdraw. V opačnom prípade null.
     */
    public ?Models\CustomerDto $customer;
    /**
     * Položky dokladu.
     * Neprázdny zoznam položiek dokladu s maximálnym počtom 500 pre doklad typu 
     * CashRegister, Paragon alebo Invalid, inak null.
     * Ak zoznam obsahuje zľavnené položky, ich celková suma musí byť nižšia alebo rovná 
     * sume kladných položiek. Ak zoznam obsahuje kupóny, musia byť v rovnakej sadzbe 
     * DPH, ako zaevidované položky, ku ktorým sa kupóny vzťahujú.
     * @var ReceiptRegistrationItemDto[] alebo null
     */
    public ?array $items;
    /**
     * Zoznam platidiel.
     * Zoznam platidiel, ktorého suma hodnôt každého platidla musí byť vyššia alebo rovná 
     * sume cien všetkých položiek dokladu.
     * @var ReceiptRegistrationPaymentDto[] alebo null
     */
    public ?array $payments;

    public function __construct(
        string $receiptType = ReceiptType::CASH_REGISTER,
        string $cashRegisterCode = "",
        string $externalId = "",
        ?array $items = null,
        ?array $payments = null
    ) {
        $this->receiptType = $receiptType;
        $this->cashRegisterCode = $cashRegisterCode;
        $this->externalId = $externalId;
        $this->items = $items;
        $this->payments = $payments;
    }
}

?>