
# e-Kasa Cloud Client PHP

HTTP klient v jazyku PHP pre [e-Kasa cloudové riešenie](https://github.com/ninedigit/ekasa-cloud) spoločnosti [Nine Digit, s.r.o.](https://ekasa.ninedigit.sk/).

Knižnica je kompatibilná s PHP verzie 7.4 a vyššie.

# Testovanie

Pre vykonanie integračných testov je nutné vytvoriť súbor `ApiClientOptions.json` v `tests\integration` vo formáte **JSON** so štruktúrou zhodnou s triedou `ApiClientOptions` a teda:

```json
{
    "publicKey": "PUBLIC_KEY",
    "privateKey": "PRIVATE_KEY",
    "tenantId": "TENANT_ID",
    "url": "https://ekasa-cloud.ninedigit.sk/api",
    "proxyUrl": null
}
```

Testy je možné spustiť príkazom
`./vendor/bin/phpunit --verbose tests`.

## Overenie kompatibility PHP

/vendor/bin/phpcs --standard=PHPCompatibility --extensions=php --runtime-set testVersion 7.4- ./src

# Inštalácia

Upravte súbor `composer.json` a pridajte nový repozitár:

```
{
  "repositories": [
    {
      "type": "vcs",
      "url": "https://github.com/ninedigit/ekasa-cloud-clientphp"
    }
  ]
}
```

Následne nainštalujte balík príkazom `composer require ninedigit/ekasa-cloud-clientphp`. Pre inštaláciu špecifickej verzie bude príkaz vyzerať nasledovne `composer require ninedigit/ekasa-cloud-clientphp:1.0.0`.

> Pre viac informácií navštívte https://getcomposer.org/doc/05-repositories.md#using-private-repositories.

# Použitie

> Príklady sú dostupné v adresári [examples](https://github.com/ninedigit/ekasa-cloud-clientphp/tree/master/examples).

## Zaokrúhľovanie

Výsledky všetkých matematických operácií musia byť pred priradením do príslušných premenných zaokrúhlené a to buď na 6 desatinných miest pre jednotkové ceny (napr. vlastnosť `ReceiptRegistrationItemDto.unitPrice`) alebo na dve desatinné miesta pre ostatné ceny prípadne množstvá (napr. vlastnosť `QuantityDto.amount` alebo `ReceiptRegistrationItemDto.price`).

```php
// Nastavenia tlače
$receiptPrinter = new PosReceiptPrinterDto();

// Položka
$receiptItem = new ReceiptRegistrationItemDto(
  ReceiptItemType::POSITIVE,
  "Coca Cola 0.25l",
  1.29,
  20.00,
  new QuantityDto(2, "ks"), 2.58);

// Platba
$receiptPayment = new ReceiptRegistrationPaymentDto(2.58, "Hotovosť");

// Požiadavka registrácie
$receiptRegistrationRequest = new CreateReceiptRegistrationRequestDto(
  ReceiptType::CASH_REGISTER,
  "88812345678900001",
  "e52ff4d1-f2ed-4493-9e9a-a73739b1ba23",
  [$receiptItem],
  [$receiptPayment]);

// Registrácia
$createReceiptRegistration = new CreateReceiptRegistrationDto(
  $receiptPrinter, $receiptRegistrationRequest, 10000);
$receiptRegistration = $client->registerReceipt($createReceiptRegistration);

if ($receiptRegistration->isCompletedSuccessfully()) {
  // ...
}
```