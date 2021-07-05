<?php

namespace NineDigit\eKasa\Cloud\Client\Examples;

use NineDigit\eKasa\Cloud\Client\ApiClient;
use NineDigit\eKasa\Cloud\Client\ApiClientOptions;
use NineDigit\eKasa\Cloud\Client\Models\QuantityDto;
use NineDigit\eKasa\Cloud\Client\Models\Registrations\Receipts;
use NineDigit\eKasa\Cloud\Client\Models\Registrations\Receipts\ReceiptItemType;
use NineDigit\eKasa\Cloud\Client\Models\Registrations\Receipts\ReceiptPrinterName;
use NineDigit\eKasa\Cloud\Client\Models\Registrations\Receipts\ReceiptRegistrationItemDto;
use NineDigit\eKasa\Cloud\Client\Models\Registrations\Receipts\ReceiptRegistrationPaymentDto;
use NineDigit\eKasa\Cloud\Client\Models\Registrations\Receipts\ReceiptType;

require '../vendor/autoload.php';

$publicKey = "f6a705661402f301e87e355338357b7a607e52b4";
$privateKey = "90607ca3ff34834972b52dee459cf9b1dcda4123fc2550a13c5c2fdeee2231d1";
$tenantId = "39fd0386-1c7b-5fb0-201f-36725cbfcacc";

$clientOptions = new ApiClientOptions($publicKey, $privateKey, $tenantId);
$client = new ApiClient($clientOptions);

// Register receipt

$cashRegisterCode = "88812345678900001";
$externalId = "e52ff4d1-f2ed-4493-9e9a-a73739b1ba23";
$printerOptions = new Receipts\EmailReceiptPrinterOptions("mail@example.com");
$receiptPrinter = new Receipts\EmailReceiptPrinterDto($printerOptions);

$item = new ReceiptRegistrationItemDto(ReceiptItemType::POSITIVE, "Coca Cola 0.25l", 1.29, 20.00, new QuantityDto(1, "ks"), 2.58);
$payment = new ReceiptRegistrationPaymentDto(2.58, "Hotovosť");

$items = array($item);
$payments = array($payment);

$receiptRegistrationRequest = new Receipts\CreateReceiptRegistrationRequestDto(
  ReceiptType::CASH_REGISTER, $cashRegisterCode, $externalId, $items, $payments);
$receiptRegistrationRequest->headerText = "www.ninedigit.sk";
$receiptRegistrationRequest->footerText = "Ďakujeme za váš nákup.";

$validityTimeSpan = 10000; // 10 sekúnd
$createReceiptRegistration = new Receipts\CreateReceiptRegistrationDto($receiptPrinter, $receiptRegistrationRequest, $validityTimeSpan);
$receiptRegistration = $client->registerReceipt($createReceiptRegistration);

echo '<pre>';
print_r($receiptRegistration);
echo '</pre>';