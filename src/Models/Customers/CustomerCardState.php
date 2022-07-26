<?php

namespace NineDigit\eKasa\Cloud\Client\Models\Customers;

/**
 * Stav zákazníckej karty
 */
final class CustomerCardState {
    /**
     * Záznam karty bol vytvorený, no samotná karta nebola vydaná
     */
    public const NOT_ISSUED = "NotIssued";
    /**
     * Vydanie karty zlyhalo
     */
    public const ISSUE_FAILED = "IssueFailed";
    /**
     * Vydanie karty bolo zrušené
     */
    public const ISSUE_CANCELED = "IssueCanceled";
    /**
     * Karta nebola vydaná, nakoľko neboli splnené podmienky pre jej vydanie
     */
    public const ISSUE_SKIPPED = "IssueSkipped";
    /**
     * Znovuvydanie karty bolo vyžiadané
     */
    public const REISSUE_REQUESTED = "ReissueRequested";
    /**
     * Karta je vydaná a platná
     */
    public const VALID = "Valid";
    /**
     * Karta je vydaná, no ešte nie je platná
     */
    public const NOT_YET_VALID = "NotYetValid";
    /**
     * Karta je exspirovaná
     */
    public const EXPIRED = "Expired";
    /**
     * Karta bola zablokovaná
     */
    public const BLOCKED = "Blocked";
    /**
     * Zrušenie karty bolo vyžiadané
     */
    public const DISPOSE_REQUESTED = "DisposeRequested";
    /**
     * Karta bola zrušená
     */
    public const DISPOSED = "Disposed";
}

?>