<?php

namespace NineDigit\eKasa\Cloud\Client;

final class DateTimeHelper {
    public static function createUtc(int $year, int $month, int $day, int $hour, int $minute, int $second = 0, int $microsecond = 0): \DateTime {
      $date = new \DateTime("now", new \DateTimeZone("UTC"));
      $date = $date->setDate($year, $month, $day);
      $date = $date->setTime($hour, $minute, $second, $microsecond);
  
      return $date;
    }
  }

?>