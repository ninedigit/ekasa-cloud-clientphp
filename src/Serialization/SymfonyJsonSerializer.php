<?php

namespace NineDigit\eKasa\Cloud\Client\Serialization;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;

use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\ClassDiscriminatorFromClassMetadata;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class SymfonyJsonSerializerFlags {
  public const ENABLE_SERIALIZE_PRECISION_FIXTURE = 0x1;
}

final class SymfonyJsonSerializer implements SerializerInterface {
  private Serializer $serializer;
  private bool $enableSerializePrecisionFixture = false;

  function __construct(int $flags = 0) {
    $this->enableSerializePrecisionFixture = $flags & SymfonyJsonSerializerFlags::ENABLE_SERIALIZE_PRECISION_FIXTURE;

    // Deprecated and will be removed in 2.0 but currently needed
    AnnotationRegistry::registerLoader('class_exists');

    $extractor = new PropertyInfoExtractor([], [new PhpDocExtractor(), new ReflectionExtractor()]);
    $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));
    $discriminator = new ClassDiscriminatorFromClassMetadata($classMetadataFactory);
    $normalizers = [
        // TODO: Add ProblemNormalizer (https://symfony.com/doc/current/components/serializer.html#built-in-normalizers)
        new ArrayDenormalizer(),
        new CloudDateTimeNormalizer(),
        new ObjectNormalizer($classMetadataFactory, null, null, $extractor, $discriminator)
    ];
    $this->serializer = new Serializer($normalizers, [
        'json' => new JsonEncoder()
    ]);
  }

  function serialize($data): string {
    if ($this->enableSerializePrecisionFixture) {
      $precision = ini_get('precision');
      $serialize_precision = ini_get('serialize_precision');

      // https://3v4l.org/ed6Yo#v7.4.0
      // https://stackoverflow.com/questions/42981409/php7-1-json-encode-float-issue/43056278#43056278
      if ($precision !== $serialize_precision) {
        ini_set('precision', 14);
        ini_set('serialize_precision', 14);
      }
    }

    try {
      return $this->serializer->serialize($data, 'json', [
        ObjectNormalizer::SKIP_NULL_VALUES => true,
        ObjectNormalizer::PRESERVE_EMPTY_OBJECTS => true
      ]);
    } finally {
      if ($this->enableSerializePrecisionFixture) {
        ini_set('precision', $precision);
        ini_set('serialize_precision', $serialize_precision);
      }
    }
  }

  function deserialize($data, $type) {
    return $this->serializer->deserialize($data, $type, 'json');
  }
}

?>