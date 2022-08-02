<?php

namespace NineDigit\eKasa\Cloud\Client\Examples;

use \Error;
use NineDigit\eKasa\Cloud\Client\ApiClient;
use NineDigit\eKasa\Cloud\Client\ApiClientOptions;
use NineDigit\eKasa\Cloud\Client\CloudEnvironment;
use NineDigit\eKasa\Cloud\Client\Models\Customers\CustomerFilterDto;

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

// Kritéria pre vyhľadávané zákaznícke účty
$customerFilter = (new CustomerFilterDto())
    ->setIds(array("3a0537ea-cfb2-2b4b-d521-02db003b276c"))
    ->setExternalId("1:Petovskys-iMac:62d5542d9c104378d6db9ab6:")
    ->setIsActive(true)
    ->setCardId("3a05321e-8285-b22c-5a5f-e4d70833935f")
    ->setCardSerialNumbers(array("10000037"));

// Metóda pre získanie zoznamu zákaznícky účtov podľa zvoleného filtra
$getCustomerResult = $client->getCustomers($query);

// Zoznam zákazníckych účtov
$customers = $getCustomerResult->items;

/*
 * Dátum a čas vykonaného dopytu. Táto hodnota môže byť použitá v ďalšej požiadavke
 * nastavením $customerFilter->setModifiedAfter($requestTime) na získanie zákazníckych
 * profilov vytvorených alebo upravených od posledného dopytu.
 */
$requestTime = $getCustomerResult->requestTime;

?>