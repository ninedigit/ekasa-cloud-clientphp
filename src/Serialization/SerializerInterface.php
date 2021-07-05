<?php

namespace NineDigit\eKasa\Cloud\Client\Serialization;

interface SerializerInterface {
  function serialize($data): string;
  function deserialize($data, $type);
}

?>