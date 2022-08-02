<?php

namespace NineDigit\eKasa\Cloud\Client\Examples;

use \Error;
use NineDigit\eKasa\Cloud\Client\ApiClient;
use NineDigit\eKasa\Cloud\Client\ApiClientOptions;
use NineDigit\eKasa\Cloud\Client\CloudEnvironment;

require '../vendor/autoload.php';

//////////////////////////////////////////////////

// Verejný kľúč pre prístup k API
$publicKey = "public_key";
// Súkromný kľúč pre prístup k API
$privateKey = "private_key";
// Identifikátor skupiny koncových zariadení
$tenantId = "tenant_id";

// Inštanciácia API klienta
$clientOptions = new ApiClientOptions($publicKey, $privateKey, $tenantId, CloudEnvironment::PRODUCTION);
$client = new ApiClient($clientOptions);

// Kód on-line registračnej pokladne (ORP kód), ktorá požiadavku spracuje
$cashRegisterCode = "88812345678900001";

// Unikátny identifikátor zákanzníka
$customerId = "3a0537ea-cfb2-2b4b-d521-02db003b276c";

/*
 * Metóda pre získanie zákazníckeho účtu.
 * Ak sa zákazník nenašiel, hodnota bude null,
 * inak CustomerDto.
 */
$customer = $client->getCustomer($customerId);

?>