<?php

namespace NineDigit\eKasa\Cloud\Client;

final class ApiClientOptions {
  public const DEFAULT_URL = "https://cloud-ekasa.ninedigit.sk/api";
  public const DEFAULT_TENANT_KEY = "__tenant";

  /**
   * Adresa servera eKasa Cloud
   * @example https://cloud-ekasa.ninedigit.sk/api
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
   * Kĺúč, pod ktorým bude vyhľadaný identifikátor
   * skupiny koncových zariadení
   * @example __tenant
   */
  public string $tenantKey;

  public function __construct(
    string $publicKey,
    string $privateKey,
    ?string $tenantId = null
  ) {
    $this->publicKey = $publicKey;
    $this->privateKey = $privateKey;
    $this->tenantId = $tenantId;
    $this->proxyUrl = null;
    $this->url = ApiClientOptions::DEFAULT_URL;
    $this->tenantKey = ApiClientOptions::DEFAULT_TENANT_KEY;
  }
}

?>