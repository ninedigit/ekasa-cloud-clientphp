<?php

namespace NineDigit\eKasa\Cloud\Client\Models;

abstract class AuditedEntityDto extends CreationAuditedEntityDto {
    /**
     * Dátum a čas poslednej úpravy.
     * Ak nie je hodnota uvedená, model nebol doposiaľ upravený.
     */
    public ?\DateTime $lastModificationTime;
    /**
     * Unikátny identifikátor používateľa, ktorý model vytvoril.
     */
    public ?string $lastModifierId;
}

?>