<?php

namespace NineDigit\eKasa\Cloud\Client\Models;

/**
 * Množstvo predaného tovaru alebo poskytnutej služby s príslušnou množstevnou jednotkou
 */
final class QuantityDto {
    /**
     * Množstvo predaného tovaru alebo poskytnutej služby s presnosťou na 4 desatinné miesta
     */
    public float $amount;
    /**
     * Množstevná jednotka s dĺžkou 1 až 3 znaky
     */
    public string $unit;

    public function __construct(float $amount = 0, string $unit = "x") {
        $this->amount = $amount;
        $this->unit = $unit;
    }
}

?>