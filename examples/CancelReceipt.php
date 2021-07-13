<?php

namespace NineDigit\eKasa\Cloud\Client\Examples;

use \Error;
use NineDigit\eKasa\Cloud\Client\ApiClient;
use NineDigit\eKasa\Cloud\Client\ApiClientOptions;

require '../vendor/autoload.php';

//////////////////////////////////////////////////

// Verejný kľúč pre prístup k API
$publicKey = "public_key";
// Súkromný kľúč pre prístup k API
$privateKey = "private_key";
// Identifikátor skupiny koncových zariadení
$tenantId = "tenant_id";

// Inštanciácia API klienta
$clientOptions = new ApiClientOptions($publicKey, $privateKey, $tenantId);
$client = new ApiClient($clientOptions);

// Kód on-line registračnej pokladne (ORP kód), ktorá požiadavku spracuje
$cashRegisterCode = "88812345678900001";
/*
 * Identifikátor požiadavky, priradený nadradenou aplikáciou.
 * Spolu s ORP kódom tvoria unikátny identifikátor požidavky naprieč systémom.
 */
$externalId = "e52ff4d1-f2ed-4493-9e9a-a73739b1ba23";

// Zaslanie požidavky a obdržanie výsledku
$result = $client->cancelReceipt($cashRegisterCode, $externalId);

if ($result->isSuccessful) {
  // Požiadavka bola úspešne zamietnutá.
}

?>