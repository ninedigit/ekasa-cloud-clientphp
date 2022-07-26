<?php

namespace NineDigit\eKasa\Cloud\Client\Models\Customers;

/**
 * Výsledok dopytu na vyhľadanie zákázníkov
 */
final class GetCustomerListResultDto {
    /**
     * Zoznam nájdených zákazníkov
     * @var CustomerDto[]
     */
    public array $items;
    /**
     * Dátum a čas vykonaného dopytu
     */
    public \DateTime $requestTime;
  }

?>