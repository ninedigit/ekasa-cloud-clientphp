<?php

namespace NineDigit\eKasa\Cloud\Client\Models\Registrations\Receipts;

use NineDigit\eKasa\Cloud\Client\Models\GuidEntityDto;
use NineDigit\eKasa\Cloud\Client\Models\Registrations\RegistrationErrorDto;
use NineDigit\eKasa\Cloud\Client\Models\Registrations\RegistrationState;

abstract class ReceiptRegistrationDtoBase extends GuidEntityDto {
    /**
     * Tlačové nastavenia
     */
    public ReceiptPrinterDto $printer;
    /**
     * Dátum a čas vytvorenia požidavky na zaevidovanie dokladu.
     */
    public \DateTime $creationDate;
    /**
     * Unikátny identifikátor používateľa, ktorý vytvoril požiadavku.
     * @example e52ff4d1-f2ed-4493-9e9a-a73739b1ba23
     */
    public string $createdBy;
    /**
     * Dátum a čas, kedy došlo k notifikovaniu o vzniku novej požidavky
     * a zaevodivanie dokladu a teda aj zmene stavu tejto požiadavky na 
     * Notified.
     */
    public ?\DateTime $notificationDate;
    /**
     * Časový interval platnosti požiadavky, v milisekundách, dokým nebude 
     * jej stav zmenený z Notified na Accepted.
     * @example 10000
     */
    public int $validityTimeSpan;
    /**
     * Dátum a čas, kedy došlo k akceptácií požiadavky registračnou 
     * pokladňou a teda aj zmene stavu tejto požiadavky na Accepted.
     * Hodnota je null, ak nie je požiadavka aspoň v stave Accepted.
     */
    public ?\DateTime $acceptationDate;
    /**
     * Časový interval v milisekundách, určený registračnou pokladňou alebo
     * serverom, počas ktorého by malo dôjsť k úspešnému dokončeniu 
     * požiadavky evidencie dokladu.
     * Hodnota je null, ak nie je požiadavka aspoň v stave Accepted.
     * @example 10000
     */
    public ?int $completionTimeSpan;
    /**
     * Dátum a čas, kedy došlo k vybaveniu požiadavky registračnou 
     * pokladňou alebo serverom a teda aj zmene stavu tejto požiadavky na 
     * jeden zo stavov Expired, Canceled, TimedOut, Processed, 
     * ProcessedOffline alebo Faulted.
     */
    public ?\DateTime $completionDate;
    /**
     * Stav požiadavky evidencie dokladu.
     * @var RegistrationState
     * @example Accepted
     */
    public string $state;
    /**
     * Informácie o chybe pre požiadavku v stave Failed.
     * @var RegistrationErrorDto
     */
    public ?RegistrationErrorDto $error;

    //

    public function isCompleted(): bool {
        return $this->isCompletedSuccessfully()
            || $this->isCompletedUnsuccessfully();
    }

    public function isCompletedSuccessfully(): bool {
        return $this->state === RegistrationState::PROCESSED
            || $this->state === RegistrationState::PROCESSED_OFFLINE;
    }

    public function isCompletedUnsuccessfully(): bool {
        return $this->state === RegistrationState::EXPIRED
            || $this->state === RegistrationState::TIMED_OUT
            || $this->state === RegistrationState::CANCELED
            || $this->state === RegistrationState::FAILED
            || $this->state === RegistrationState::PROCESS_FAILED;
    }
}

?>