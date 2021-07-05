<?php

namespace NineDigit\eKasa\Cloud\Client\Models\Registrations\Receipts;

/**
 * Typ položky dokladu.
 */
final class ReceiptItemType {
    /**
     * Kladná (Kladná položka) - suma položky za predaj tovaru alebo poskytnutie služby.
     */
    const POSITIVE = "Positive";
    /**
     * Vrátené obaly (Záporná položka) - suma položky za vykúpené zálohované obaly.
     */
    const RETURNED_CONTAINER = "ReturnedContainer";
    /**
     * Vrátená (Záporná položka) - zrušenie evidovanej položky po jej vystavení na pokladničnom
     * doklade pri vrátení tovaru alebo služby.
     */
    const RETURNED = "Returned";
    /**
     * Opravná (Kladná alebo záporná položka) - negácia položky už zaevidovaného dokladu
     * v systéme e-kasa v prípade jej opravy.
     */
    const CORRECTION = "Correction";
    /**
     * Zľava (Záporná položka) – suma poskytnutých zliav.
     */
    const DISCOUNT = "Discount";
    /**
     * Odpočítaná záloha (Záporná položka) – suma prijatého preddavku uvedená na doklade
     * vystavenom v čase úhrady doplatku ceny za predaný tovar alebo poskytnutú službu.
     */
    const ADVANCE = "Advance";
    /**
     * Výmena poukazu (Záporná položka) – suma jednoúčelového poukazu pri jeho výmene za tovar
     * alebo poskytnutú službu.
     */
    const VOUCHER = "Voucher";

    private function __construct() {
    }
}