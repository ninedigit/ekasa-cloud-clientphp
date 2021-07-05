<?php

namespace NineDigit\eKasa\Cloud\Client\Serialization;

use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\ClassDiscriminatorFromClassMetadata;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

final class SymfonyJsonSerializer implements SerializerInterface {
  private Serializer $serializer;

  function __construct() {
    $extractor = new PropertyInfoExtractor([], [/*new PhpDocExtractor(),*/ new ReflectionExtractor()]);
    $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));
    $discriminator = new ClassDiscriminatorFromClassMetadata($classMetadataFactory);
    $normalizers = [
        new ArrayDenormalizer(),
        new ObjectNormalizer($classMetadataFactory, null, null, $extractor, $discriminator)
    ];
    $this->serializer = new Serializer($normalizers, [
        'json' => new JsonEncoder()
    ]);
  }

  function serialize($data): string {
    return $this->serializer->serialize($data, 'json');
  }

  function deserialize($data, $type) {
    return $this->serializer->deserialize($data, $type, 'json');
  }
}

?>