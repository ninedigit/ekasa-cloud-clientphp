
# e-Kasa Cloud Client PHP

HTTP klient pre e-Kasa cloudové riešenie spoločnosti [Nine Digit, s.r.o.](https://ekasa.ninedigit.sk/)

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

**Výsledok požiadavky registrácie dokladu :**
```json
{
  "request": {
    "externalId": "e52ff4d1-f2ed-4493-9e9a-a73739b1ba23",
    "receiptType": "CashRegister",
    "amount": null,
    "issueDate": null,
    "orpCreateDate": "2021-07-09T12:42:48.5408721Z",
    "receiptNumber": 1,
    "paragonNumber": null,
    "invoiceNumber": null,
    "dic": "1234567890",
    "icDph": "SK1234567890",
    "ico": "76543210",
    "customer": {
      "id": "2004567890",
      "type": "DIC"
    },
    "cashRegisterCode": "88812345678900001",
    "paragon": false,
    "basicVatAmount": 0.43,
    "reducedVatAmount": null,
    "taxFreeAmount": null,
    "taxBaseBasic": 2.15,
    "taxBaseReduced": null,
    "items": [
      {
        "type": "Positive",
        "name": "Coca Cola 0.25l",
        "price": 2.58,
        "unitPrice": 1.29,
        "quantity": {
          "amount": 2.0000,
          "unit": "ks"
        },
        "referenceReceiptId": null,
        "vatRate": 20.00,
        "specialRegulation": null,
        "voucherNumber": null,
        "seller": null,
        "description": null
      }
    ],
    "payments": [
      {
        "name": "Hotovosť",
        "amount": 2.58
      }
    ],
    "eKasaError": null,
    "okp": "32627337-07256af7-bb27ad9c-27a2cf6a-21292715",
    "pkp": "T+ALV0Tfcvrpo6kHMJmof3mcJBFsl6cCYUym5RjoNT8lqpHHsOmXIwL9D/AUYblvfYLGa7IdMyk1gi1ycYNbGkATBnMF4VBCLdXELmCF0zGD2cdTIspE2irRKEtlOWwV5ixDnkXnt3NORHwjG5YWwS2X6rdN3TTx19qgAdLC4iD80keypTD9A7JBAEen6dH10pDQjU5fj4JSJfObJHbBuJXra880wDW1C29YNTq1bmrpjA/qG1P5khhiFNubUrKf2KQmbAuIRepHl3wxgWxMjPzg3pWWRG/dGTHmdC9OszT8MuMQlDgO+uGC6W6uY6qp7aDy1sGbkp4gCoi05cgCjg==",
    "headerText": null,
    "footerText": null,
    "requestId": "bf4e7cbb-fccb-4794-bb19-b31814265892",
    "requestDate": "2021-07-09T12:42:48.5408721Z",
    "sendingCount": 1,
    "receiptId": null,
    "orpProcessDate": "2021-07-09T12:42:49Z"
  },
  "error": null,
  "printer": {
    "name": "pos",
    "options": {}
  },
  "creationDate": "2021-07-09T12:42:48.157573",
  "createdBy": "39fd0e35-c06a-7c3b-3bf7-acd229d31764",
  "notificationDate": "2021-07-09T12:42:48.221826",
  "validityTimeSpan": 20000,
  "acceptationDate": "2021-07-09T12:42:48.423687",
  "completionTimeSpan": 60000,
  "completionDate": "2021-07-09T12:42:49.533928Z",
  "state": "Processed",
  "id": "39fd9d77-91e8-ba5d-5a7a-1da365bb4278"
}
```