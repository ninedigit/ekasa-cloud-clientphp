<?php

namespace NineDigit\eKasa\Cloud\Client\Models\Customers;


final class CustomerFilterDto {
    private bool $isExternalIdSet = false;

    /**
     * Zoznam identifikátorov zákazníckych účtov.
     * Táto hodnota sa vyhodnocuje voči Customer.id.
     * @var ?string[]
     */
    private ?array $ids = null;
    /**
     * Externý identifikátor zákazníka.
     * Táto hodnota sa vyhodnocuje voči Customer.externalId.
     */
    private ?string $externalId = null;
    /**
     * Dátum a čas, po ktorom došlo k modifikácií zákazníka.
     * Vo výsledku sa budú nachádzať všetci zákazníci, ktorých
     * dátum poslednej úpravy je neskorší alebo rovný s uvedeným.
     * Táto hodnota sa vyhodnocuje voči Customer.lastModificationTime.
     */
    private ?\DateTime $modifiedAfter = null;
    /**
     * Indikácia, či je alebo nie je zákazník aktívny.
     * Táto hodnota sa vyhodnocuje voči Customer.isActive.
     */
    private ?bool $isActive = null;
    /**
     * Identifikátor zákazníckej karty.
     * Táto hodnota sa vyhodnocuje voči Customer.cards.id.
     */
    private ?string $cardId = null;
    /**
     * Zoznam sériových čísel zákazníckych kariet.
     * Táto hodnota sa vyhodnocuje voči Customer.cards.serialNumber.
     * @var ?string[];
     */
    private ?array $cardSerialNumbers = null;

    // Ids

    public function getIds(): ?array {
        return $this->ids;
    }

    public function setIds(?array $ids): CustomerFilterDto {
        $this->ids = $ids;
        return $this;
    }

    // ExternalId

    public function getExternalId(): ?string {
        return $this->externalId;
    }

    public function setExternalId(?string $externalId): CustomerFilterDto {
        $this->externalId = $externalId;
        $this->isExternalIdSet = $externalId;
        return $this;
    }

    // ModifiedAfter

    public function getModifiedAfter(): ?\DateTime {
        return $this->modifiedAfter;
    }

    public function setModifiedAfter(?\DateTime $modifiedAfter): CustomerFilterDto {
        $this->modifiedAfter = $modifiedAfter;
        return $this;
    }

    // IsActive

    public function getIsActive(): bool {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): CustomerFilterDto {
        $this->isActive = $isActive;
        return $this;
    }

    // CardId

    public function getCardId(): ?string {
        return $this->cardId;
    }

    public function setCardId(?string $cardId): CustomerFilterDto {
        $this->cardId = $cardId;
        return $this;
    }

    // CardSerialNumbers

    public function getCardSerialNumbers(): ?array {
        return $this->cardSerialNumbers;
    }

    public function setCardSerialNumbers(?array $cardSerialNumbers): CustomerFilterDto {
        $this->cardSerialNumbers = $cardSerialNumbers;
        return $this;
    }

    //

    public function toQueryString(): string {
        $result = "";
        $params = [];
    
        if (is_array($this->ids)) {
            $params["ids"] = $this->ids;
        }

        if ($this->isExternalIdSet === true) {
            $params["externalId"] = $this->externalId;
        }

        if ($this->modifiedAfter !== null) {
            $params["modifiedAfter"] = $this->modifiedAfter->format('Y-m-d\TH:i:s.u\Z');
        }

        if (is_bool($this->isActive)) {
            $params["isActive"] = $this->isActive ? "true" : "false";
        }

        if (is_string($this->cardId)) {
            $params["cardId"] = $this->cardId;
        }

        if (count($params) > 0) {
            $result = http_build_query($params);
            $result = preg_replace('/%5B[0-9]?%5D/simU', '', $result);
        }

        return $result;
    }
}