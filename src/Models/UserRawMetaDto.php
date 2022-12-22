<?php

namespace NineDigit\eKasa\Cloud\Client\Models;

final class UserRawMetaDto {
    /**
     * Unikátny identifikátor používateľa, ku ktorému sú viazané meta dáta
     */
    public string $userId;
    /**
     * Meta dáta
     */
    public array $meta;
}

?>