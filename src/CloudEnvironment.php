<?php

namespace NineDigit\eKasa\Cloud\Client;

/**
 * e-Kasa Cloud prostredie
 */
final class CloudEnvironment {
  /**
   * Produkčné prostredie
   */
  public const PRODUCTION = "https://ekasa-cloud.ninedigit.sk/api";
  /**
   * Integračné prostredie
   */
  public const PLAYGROUND = "https://ekasa-cloud-int.ninedigit.sk/api";
}

?>