<?php

namespace NineDigit\eKasa\Cloud\Client\Models\Registrations;

/**
 * Stav zaevidovania požiadavky.
 */
final class RegistrationState {
    /**
     * Požiadavka na zaevidovanie dokladu alebo polohy bola vytvorená.
     */
    public const CREATED = "Created";
    /**
     * Koncové ziariadenie bolo upovedomené o novej požiadavke na zaevidovanie
     * dokladu alebo polohy.
     */
    public const NOTIFIED = "Notified";
    /**
     * Spracovanie požiadavky na zaevidovanie dokladu alebo polohy bolo zrušené
     * z dôvodu vypršania časového limitu.
     */
    public const EXPIRED = "Expired";
    /**
     * Požiadavka na zaevidovanie dokladu alebo polohy bola prijatá koncovým
     * zariadením.
     */
    public const ACCEPTED = "Accepted";
    /**
     * Spracovanie požiadavky bolo zamietnuté.
     */
    public const CANCELED = "Canceled";
    /**
     * Požiadavka na zaevidovanie dokladu alebo polohy vypršala.
     * Koncové zariadenie túto požiadavku nestihlo odbaviť v deklarovanom
     * alebo určenom časovom intervale.
     */
    public const TIMED_OUT = "TimedOut";
    /**
     * Požiadavka na zaevidovanie dokladu alebo polohy bolo zamietnutá
     * zo strany ORP.
     */
    public const REJECTED = "Rejected";
    /**
     * Požiadavka na zaevidovanie dokladu alebo polohy bola úspešne vybavená.
     */
    public const PROCESSED = "Processed";
    /**
     * Požiadavka na zaevidovanie dokladu alebo polohy bola spracovaná
     * off-line.
     */
    public const PROCESSED_OFFLINE = "ProcessedOffline";
    /**
     * Požiadavka na zaevidovanie dokladu alebo polohy zlyhala zo
     * strany ORP.
     */
    public const PROCESS_FAILED = "ProcessFailed";
    /**
     * Požiadavka na zaevidovanie dokladu alebo polohy zlyhala.
     */
    public const FAILED = "Failed";

    private function __construct() {
    }
}

?>