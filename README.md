
# e-Kasa Cloud Client PHP

HTTP klient pre e-Kasa cloudové riešenie spoločnosti [Nine Digit, s.r.o.](https://ekasa.ninedigit.sk/)

# Testovanie

`./vendor/bin/phpunit --verbose tests`

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