<?php

namespace NineDigit\eKasa\Cloud\Client;

final class ApiClientOptions {
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
    $this->url = ApiClientOptions::DEFAULT_URL;
    $this->tenantKey = ApiClientOptions::DEFAULT_TENANT_KEY;
  }
}

?>