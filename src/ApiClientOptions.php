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
    ?string $url = CloudEnvironment::PRODUCTION,
    ?string $proxyUrl = null
  ) {
    $this->publicKey = $publicKey;
    $this->privateKey = $privateKey;
    $this->tenantId = $tenantId;
    $this->proxyUrl = $proxyUrl;
    $this->url = $url;
  }

  public static function load(string $filename): ApiClientOptions {
    $contents = file_get_contents($filename);
    $data = json_decode($contents, true, 512, JSON_THROW_ON_ERROR);

    $publicKey = $data['publicKey'];
    $privateKey = $data['privateKey'];
    
    $tenantId = null;
    $url = CloudEnvironment::PRODUCTION;
    $proxyUrl = null;

    if (array_key_exists('tenantId', $data)) {
      $tenantId = $data['tenantId'];
    }

    if (array_key_exists('url', $data)) {
      $url = $data['url'];
    }

    if (array_key_exists('proxyUrl', $data)) {
      $proxyUrl = $data['proxyUrl'];
    }

    $options = new ApiClientOptions($publicKey, $privateKey, $tenantId, $url, $proxyUrl);
    return $options;
  }

  // public function save(string $filename): void {
  //   $data = array(
  //     'publicKey' => $this->publicKey,
  //     'privateKey' => $this->privateKey,
  //     'url' => $this->url
  //   );

  //   if ($this->tenantId !== null) {
  //     $data['tenantId'] = $this->tenantId;
  //   }

  //   if ($this->proxyUrl !== null) {
  //     $data['proxyUrl'] = $this->proxyUrl;
  //   }

  //   $json = json_encode($data, JSON_THROW_ON_ERROR);
  //   file_put_contents($filename, $json);
  // }
}

?>