<?php

namespace NineDigit\eKasa\Cloud\Client\Models\Customers;

/**
 * Adresa zákazníka
 */
final class CustomerAddressDto {
    /**
     * Názov ulice
     */
    public ?string $street;
    /**
     * Mesto
     */
    public ?string $city;
    /**
     * Poštové smerové číslo - PSČ
     */
    public ?string $postalCode;
    /**
     * Krajina
     */
    public ?string $country;
    /**
     * Súradnice presnej polohy adresy
     */
    public ?GeoCoordinatesDto $coordinates;
    /**
     * Poznámka k adrese
     */
    public ?string $note;
}

?>