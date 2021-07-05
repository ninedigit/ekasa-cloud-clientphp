<?php

namespace NineDigit\eKasa\Cloud\Client\Models;

/**
 * Príznak, ktorý bližšie špecifikuje „dôvod“ priradenia dane s hodnotou 0, ak bola položke priradená
 */
final class TaxFreeReason {
    /**
     * Informácia identifikujúca položku, ktorej bola priradená daň s hodnotou 0 v prípade,
     * ak sa jedná o prenesenie daňovej povinnosti
     */
    const VAT_REVERSE_CHARGE = "VATReverseCharge";
    /**
     * Informácia identifikujúca položku, ktorej bola priradená daň s hodnotou 0 v prípade
     * oslobodenia položky od dane
     */
    const VAT_EXEMPTION_GOOD = "VATExemptionGood";
    /**
     * Informácia identifikujúca položku, ktorej bola priradená daň s hodnotou 0 v prípade
     * osobitnej úpravy uplatňovania dane pri cestovných kanceláriách
     */
    const TRAVEL_AGENCY = "TravelAgency";
    /**
     * Informácia identifikujúca položku, ktorej bola priradená daň s hodnotou 0 v prípade
     * osobitnej úpravy uplatňovania dane pri použitom tovare
     */
    const USED_GOOD = "UsedGood";
    /**
     * Informácia identifikujúca položku, ktorej bola priradená daň s hodnotou 0 v prípade
     * osobitnej úpravy uplatňovania dane pri umeleckých dielach
     */
    const ARTWORK = "Artwork";
    /**
     * Informácia identifikujúca položku, ktorej bola priradená daň s hodnotou 0 v prípade
     * osobitnej úpravy uplatňovania dane pri zberateľských predmetoch a starožitnostiach
     */
    const COLLECTIBLES_AND_ANTIQUES = "CollectiblesAndAntiques";

    private function __construct() {
    }
}

?>