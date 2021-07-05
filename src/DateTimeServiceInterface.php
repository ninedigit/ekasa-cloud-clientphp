<?php

namespace NineDigit\eKasa\Cloud\Client;

interface DateTimeServiceInterface {
  public function getNowUtc(): \DateTime;
}

?>