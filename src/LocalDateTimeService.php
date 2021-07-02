<?php

namespace NineDigit\eKasa\Cloud\ApiClient;

class LocalDateTimeService implements IDateTimeService {
  public function getNowUtc(): \DateTime {
    return new \DateTime("now", new \DateTimeZone("UTC"));
  }
}

?>