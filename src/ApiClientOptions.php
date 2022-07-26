<?php

namespace NineDigit\eKasa\Cloud\Client;

use NineDigit\eKasa\Cloud\Client\Serialization\SerializerInterface;
use NineDigit\eKasa\Cloud\Client\Authentication\ApiRequestMessageSignerInterface;

final class ApiClientOptions {
  /**
   * Url adresa e-Kasa Cloud servera
   * @example "https://ekasa-cloud.ninedigit.sk/api"
   * @see CloudEnvironment
   */
  public string $url;
  /**
   * Verejný kľúč pre prístup k API
   */
  public string $publicKey;
  /**
   * Súkromný kľúč pre prístup k API
   */
  public string $privateKey;
  /**
   * Identifikátor skupiny koncových zariadení
   */
  public ?string $tenantId;

  /**
   * Adresa Proxy servera
   * @example "127.0.0.1:8888"
   */
  public ?string $proxyUrl;

  /**
   * Iba na účely testovania
   */
  public ?ApiRequestMessageSignerInterface $requestMessageSigner = null;

  /**
   * Iba na účely testovania
   */
  public ?SerializerInterface $serializer = null;

  public function __construct(
    string $publicKey,
    string $privateKey,
    ?string $tenantId = null,
    ?string $url = CloudEnvironment::PRODUCTION
  ) {
    $this->publicKey = $publicKey;
    $this->privateKey = $privateKey;
    $this->tenantId = $tenantId;
    $this->proxyUrl = null;
    $this->url = $url;
  }
}

?>