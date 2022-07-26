<?php

namespace NineDigit\eKasa\Cloud\Client\Models\Customers;

/**
 * Informácie o firme, pod ktorou zákazník figuruje.
 */
final class CustomerCompanyDto {
    /**
     * Formálny názov spoločnosti
     */
    public ?string $name;
    /**
     * Unikátny identifikátor spoločnosti - IČO
     */
    public ?string $crn;
    /**
     * Identifikačné číslo pre daň z pridanej hodnoty - IČ DPH
     */
    public ?string $vatId;
    /**
     * Daňové identifikačné číslo - DIČ
     */
    public ?string $taxId;
}

?>