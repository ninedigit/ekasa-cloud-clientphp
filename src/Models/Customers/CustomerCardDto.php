<?php

namespace NineDigit\eKasa\Cloud\Client\Models\Customers;

use NineDigit\eKasa\Cloud\Client\Models\AuditedEntityDto;
use Symfony\Component\Serializer\Annotation\DiscriminatorMap;

/**
 * Zákaznícka karta
 * @DiscriminatorMap(typeProperty="processor", mapping={
 *    "G"="NineDigit\eKasa\Cloud\Client\Models\Customers\CustomerGeneralCardDto",
 *    "P"="NineDigit\eKasa\Cloud\Client\Models\Customers\CustomerPhysicalCardDto",
 * })
 */
abstract class CustomerCardDto extends AuditedEntityDto {
    /**
     * Unikátny identifikátor nájomcu
     */
    public ?string $tenantId;
    /**
     * Unikátny externý identifikátor
     */
    public ?string $externalId;
    /**
     * Identifikátor verzie zákazníka. Táto hodnota je po každej
     * vykonanej zmene automaticky aktualizovaná serverom.
     */
    public ?string $concurrencyStamp;
    /**
     * Indikácia aktívnosti zákazníka
     */
    public bool $isActive;
    /**
     * Indikácia, či sa jedná o virtuálnu kartu (true),
     * alebo fyzickú (false)
     */
    public bool $isVirtual;
    /**
     * Sériové číslo karty, ktoré je unikátne naprieč zákazníkmi
     */
    public string $serialNumber;
    /**
     * Unikátny identifikátor vydavateľa karty
     * @see CustomerCardProcessorNames
     */
    public string $processor;
    /**
     * Stav vydania zákazníckej karty
     * @see CustomerCardState
     */
    public string $status;
    /**
     * Dátum a čas zmeny stavu vydania zákazníckej karty
     */
    public ?\DateTime $statusTime;
    /**
     * Sprievodná správa bližšie popisujúca aktuálny stav vydania zákazníckej karty
     */
    public ?string $statusReason;
    /**
     * Dátum a čas aktivácie zákazníckej karty
     */
    public \DateTime $activationTime;
    /**
     * Dátum a čas exspirácie zákazníckej karty
     */
    public ?\DateTime $expirationTime;
    /**
     * Poznámka
     */
    public ?string $note;
    /**
     * Meta dáta
     */
    public array $meta;
    /**
     * Unikátny identifikátor zákazníka, ku ktorému táto transakcia patrí
     */
    public string $customerId;
}

?>