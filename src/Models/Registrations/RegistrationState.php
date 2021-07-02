<?php

namespace NineDigit\eKasa\Cloud\ApiClient\Models\Registrations;

/**
 * Stav zaevidovania požiadavky.
 */
final class RegistrationState {
    /**
     * Požiadavka na zaevidovanie dokladu alebo polohy bola vytvorená.
     */
    public const CREATED = "created";
    /**
     * Koncové ziariadenie bolo upovedomené o novej požiadavke na zaevidovanie
     * dokladu alebo polohy.
     */
    public const NOTIFIED = "notified";
    /**
     * Spracovanie požiadavky na zaevidovanie dokladu alebo polohy bolo zrušené
     * z dôvodu vypršania časového limitu.
     */
    public const EXPIRED = "expired";
    /**
     * Požiadavka na zaevidovanie dokladu alebo polohy bola prijatá koncovým
     * zariadením.
     */
    public const ACCEPTED = "accepted";
    /**
     * Spracovanie požiadavky bolo zamietnuté.
     */
    public const CANCELED = "canceled";
    /**
     * Požiadavka na zaevidovanie dokladu alebo polohy vypršala.
     * Koncové zariadenie túto požiadavku nestihlo odbaviť v deklarovanom
     * alebo určenom časovom intervale.
     */
    public const TIMED_OUT = "timedOut";
    /**
     * Požiadavka na zaevidovanie dokladu alebo polohy bola úspešne vybavená.
     */
    public const PROCESSED = "processed";
    /**
     * Požiadavka na zaevidovanie dokladu alebo polohy bola spracovaná
     * off-line.
     */
    public const PROCESSED_OFFLINE = "processedOffline";
    /**
     * Požiadavka na zaevidovanie dokladu alebo polohy zlyhala.
     */
    public const FAULTED = "faulted";

    private function __construct() {
    }
}

?>