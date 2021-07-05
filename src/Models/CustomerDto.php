<?php

namespace NineDigit\eKasa\Cloud\Client\Models;

/**
 * Informácie o kupujúcom
 */
final class CustomerDto {
    /**
     * Unikátny identifikátor kupujúceho.
     */
    public string $id;
    /**
     * Typ identifikátora kupujúceho.
     * @see CustomerIdType
     */
    public string $type;

    public function __construct(string $id, string $type) {
        $this->id = $id;
        $this->type = $type;
    }
}

?>