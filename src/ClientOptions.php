<?php

namespace NineDigit\eKasa\Cloud\ApiClient;

class ClientOptions {
  public const DEFAULT_URL = "http://cloud-ekasa.ninedigit.sk/api";
  public const DEFAULT_TENANT_KEY = "__tenant";

  public string $url;
  public string $publicKey;
  public string $privateKey;
  public ?string $tenantId;

  public string $tenantKey;

  public function __construct(
    string $publicKey,
    string $privateKey,
    ?string $tenantId = null
  ) {
    $this->publicKey = $publicKey;
    $this->privateKey = $privateKey;
    $this->tenantId = $tenantId;
    $this->url = ClientOptions::DEFAULT_URL;
    $this->tenantKey = ClientOptions::DEFAULT_TENANT_KEY;
  }
}

?>