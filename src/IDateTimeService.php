<?php

namespace NineDigit\eKasa\Cloud\ApiClient;

interface IDateTimeService {
  public function getNowUtc(): \DateTime;
}

?>