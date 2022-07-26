<?php

namespace NineDigit\eKasa\Cloud\Client\Models\Customers;

use NineDigit\eKasa\Cloud\Client\Models;
use NineDigit\eKasa\Cloud\Client\Models\CreditDto;
use NineDigit\eKasa\Cloud\Client\Models\AuditedEntityDto;


/**
 * Zákazník
 */
final class CustomerDto extends AuditedEntityDto {
    /**
     * Identifikátor verzie zákazníka. Táto hodnota je po každej
     * vykonanej zmene automaticky aktualizovaná serverom.
     */
    public ?string $concurrencyStamp;
    /**
     * Unikátny identifikátor nájomcu
     */
    public ?string $tenantId;
    /**
     * Indikácia aktívnosti zákazníka
     */
    public bool $isActive;
    /**
     * Stav zákazníckeho profilu, ktorý je determinovaný
     * aktuálnym časom a intervalom času aktivácie a času exspirácie
     * @see CustomerState
     */
    public string $status;
    /**
     * Unikátny externý identifikátor
     */
    public ?string $externalId;
    /**
     * Dátum a čas aktivácie
     */
    public ?\DateTime $activationTime;
    /**
     * Dátum a čas exspirácie
     */
    public ?\DateTime $expirationTime;
    /**
     * Meno zákazníka
     */
    public ?string $firstName;
    /**
     * Priezvisko zákazníka
     */
    public ?string $lastName;
    /**
     * Pohlavie
     */
    public ?string $gender;
    /**
     * Dátum narodenia vo formáte 'yyyy-MM-dd'
     */
    public ?string $birthDate;
    /**
     * Emailová adresa
     */
    public ?string $email;
    /**
     * Kontaktné telefónne číslo
     */
    public ?string $phone;
    /**
     * Indikácia, či je zákazník viazaný na firmu.
     * Ak je hodnota true, vlastnosť company je uvedená.
     */
    public bool $isCompany;
    /**
     * Spoločnosť, na ktorú je zákazník viazaný.
     */
    public ?CustomerCompanyDto $company;
    /**
     * Adresa bydliska
     */
    public ?CustomerAddressDto $address;
    /**
     * Aktuálny stav kreditu
     */
    public CreditDto $creditBalance;
    /**
     * Zoznam posledných vykonaných kreditných transakcií
     * @var CustomerCreditBalanceTransactionDto[]
     */
    public array $creditBalanceTransactions;
    /**
     * Zoznam kariet, ktoré boli zákazníkovi vydané
     * @var CustomerCardDto[]
     */
    public array $cards;
    /**
     * Koeficient určujúci, koľko jednotiek peňazí sa po zaplatení
     * jednej jednotky peňazí premietne do vlastnosti credit.
     * Príklad: Pre hodnotu 0.05 bude po zaplatení 1EUR pripísaný kredit 0.05EUR.
     */
    public float $creditRate;
    /**
     * Percentuálne vyjadrená zľava v rozsahu <0, 100>%
     */
    public float $discountRate;
    /**
     * Poznámka k zákazníkovi
     */
    public ?string $note;
    /**
     * Meta dáta
     */
    public array $meta;
}