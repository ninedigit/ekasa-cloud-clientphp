<?php

namespace NineDigit\eKasa\Cloud\Client\Serialization;

use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;

// Pozn: C# serializuje sekundy s presnosťou na 7 desatinných miest, no PHP vie pracovať s max. 6 a preto je nutné odstrániť poslednú číslicu.

final class CloudDateTimeNormalizer extends DateTimeNormalizer {
  public function denormalize($data, string $type, string $format = null, array $context = []) {
    if (preg_match('/(\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}\.)(\d{7})Z/', $data, $matches)) { // "2021-07-14T08:20:03.8016655Z"
      $data = $matches[1] . substr($matches[2], 0, 6) . "UTC";
    }

    return parent::denormalize($data, $type, $format, $context);
  }
}

?>