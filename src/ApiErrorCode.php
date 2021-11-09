<?php

namespace NineDigit\eKasa\Cloud\Client;

/**
 * Kódy chyby vrátený z API
 */
class ApiErrorCode {
  /**
   * Neznáma chyba
   */
  const UNKNOWN = 0;
  /**
   * Všeobecná chyba
   */
  const GENERAL = -100;
  /**
   * Organizácia nebola nájdená
   */
  const TENANT_NOT_FOUND = -101;
  /**
   * Validačná chyba
   */
  const VALIDATION_ERROR = -900;
}

?>