<?php

namespace NineDigit\eKasa\Cloud\Client\Examples;

use \Error;
use NineDigit\eKasa\Cloud\Client\ApiClient;
use NineDigit\eKasa\Cloud\Client\ApiClientOptions;
use NineDigit\eKasa\Cloud\Client\Models\QuantityDto;
use NineDigit\eKasa\Cloud\Client\Models\Registrations\Receipts;
use NineDigit\eKasa\Cloud\Client\Models\Registrations\Receipts\PosReceiptPrinterOptions;
use NineDigit\eKasa\Cloud\Client\Models\Registrations\Receipts\PosReceiptPrinterDto;
use NineDigit\eKasa\Cloud\Client\Models\Registrations\Receipts\PdfReceiptPrinterDto;
use NineDigit\eKasa\Cloud\Client\Models\Registrations\Receipts\EmailReceiptPrinterOptions;
use NineDigit\eKasa\Cloud\Client\Models\Registrations\Receipts\EmailReceiptPrinterDto;
use NineDigit\eKasa\Cloud\Client\Models\Registrations\Receipts\CreateReceiptRegistrationDto;
use NineDigit\eKasa\Cloud\Client\Models\Registrations\Receipts\ReceiptItemType;
use NineDigit\eKasa\Cloud\Client\Models\Registrations\Receipts\ReceiptRegistrationItemDto;
use NineDigit\eKasa\Cloud\Client\Models\Registrations\Receipts\ReceiptRegistrationPaymentDto;
use NineDigit\eKasa\Cloud\Client\Models\Registrations\Receipts\ReceiptType;
use NineDigit\eKasa\Cloud\Client\Models\Registrations\RegistrationState;

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

/**
 * Konfigurácia tlačiarne, na ktorej bude doklad spracovaný.
 * K dispozícií sú nasledovné:
 */

  // 1. Tlačiareň papierových dokladov
  $posPrinterOptions = new PosReceiptPrinterOptions();
  $posPrinterOptions->openDrawer = true;
  $receiptPrinter = new PosReceiptPrinterDto($posPrinterOptions);

  // 2. Tlačiareň vyhotovujúca PDF súbory
  $receiptPrinter = new PdfReceiptPrinterDto($pdfPrinterOptions);

  // 3. Tlačiareň vyhotovujúca e-maily
  $emailPrinterOptions = new EmailReceiptPrinterOptions("mail@example.com");
  $emailPrinterOptions->subject = "Váš elektronický doklad";
  $receiptPrinter = new EmailReceiptPrinterDto($emailPrinterOptions);

// Položka dokladu
$item = new ReceiptRegistrationItemDto(
  ReceiptItemType::POSITIVE,  // Kladný typ položky
  "Coca Cola 0.25l",          // Názov
  1.29,                       // Jednotková cena
  20.00,                      // Daňová hladina
  new QuantityDto(2, "ks"),   // Množstvo
  2.58                        // Cena
);

// Platba
$payment = new ReceiptRegistrationPaymentDto(2.58, "Hotovosť");

$receiptRegistrationRequest = new Receipts\CreateReceiptRegistrationRequestDto(
  ReceiptType::CASH_REGISTER, // Typ dokladu
  $cashRegisterCode,          // ORP kód
  $externalId,                // Externý identifikátor
  [$item],                    // Zoznam položiek
  [$payment]                  // Zoznam platidiel
);

// Voliteľná hlavička a pätička dokladu
$receiptRegistrationRequest->headerText = "www.ninedigit.sk";
$receiptRegistrationRequest->footerText = "Ďakujeme za váš nákup.";

/*
 * Maximálna platnosť požiadavky registrácie dokladu v milisekundách.
 * Ak počas tohto intervalu nedôjde k akceptácií požiadavky dokladu
 * registračnou pokladňou, požiadavka bude zrušená.
 */
$validityTimeSpan = 10000; // 10 sekúnd

// Kontext požidavky registrácie dokladu
$createReceiptRegistration = new CreateReceiptRegistrationDto(
  $receiptPrinter, $receiptRegistrationRequest, $validityTimeSpan);

// Zaslanie požidavky a obdržanie výsledku
$receiptRegistration = $client->registerReceipt($createReceiptRegistration);

// Doklad bol úspešne spracovaný v režíme ON-LINE
if ($receiptRegistration->state === RegistrationState::PROCESSED) {
  
}
// Doklad bol úspešne spracovaný v režíme OFF-LINE
else if ($receiptRegistration->state === RegistrationState::PROCESSED_OFFLINE) {
  
}
// Spracovanie dokladu zlyhalo zo strany e-Kasa systému
else if ($receiptRegistration->state === RegistrationState::PROCESS_FAILED) {
  $errorMessage = $receiptRegistration->request->eKasaError->message;
  $errorCode = $receiptRegistration->request->eKasaError->code;
  throw new Error(`Spracovanie požiadavky bolo zamietnuté: ${errorMessage} [${errorCode}]`);
}
// Spracovanie dokladu zlyhalo
else if ($receiptRegistration->state === RegistrationState::FAILED) {
  $errorMessage = $receiptRegistration->error->message;
  throw new Error(`Spracovanie požiadavky zlyhalo: ${errorMessage}.`);
}
else {
  // Odpoveď môže byť v jednom zo stavov: EXPIRED, TIMED_OUT, CANCELED alebo FAILED.
}

?>