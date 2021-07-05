<?php

namespace NineDigit\eKasa\Cloud\Client;

class LocalDateTimeService implements DateTimeServiceInterface {
  public function getNowUtc(): \DateTime {
    return new \DateTime("now", new \DateTimeZone("UTC"));
  }
}

?>