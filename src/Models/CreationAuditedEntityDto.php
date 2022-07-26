<?php

namespace NineDigit\eKasa\Cloud\Client\Models;

abstract class CreationAuditedEntityDto extends EntityDto {
    /**
     * Dátum a čas vytvorenia modelu.
     */
    public \DateTime $creationTime;
    /**
     * Unikátny identifikátor používateľa, ktorý model vytvoril.
     */
    public ?string $creatorId;
}

?>