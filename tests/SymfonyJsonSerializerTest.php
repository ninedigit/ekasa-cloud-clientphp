<?php

namespace NineDigit\eKasa\Cloud\Client\Tests;

use NineDigit\eKasa\Cloud\Client\Models\CreditDto;
use NineDigit\eKasa\Cloud\Client\Models\CustomerDto;
use NineDigit\eKasa\Cloud\Client\Models\Customers\CustomerDto as Customer;
use NineDigit\eKasa\Cloud\Client\Models\Customers\CustomerCompanyDto;
use NineDigit\eKasa\Cloud\Client\Models\Customers\CustomerAddressDto;
use NineDigit\eKasa\Cloud\Client\Models\CustomerIdType;
use NineDigit\eKasa\Cloud\Client\Models\QuantityDto;
use NineDigit\eKasa\Cloud\Client\Models\Registrations\EKasaErrorDto;
use NineDigit\eKasa\Cloud\Client\Models\Registrations\Receipts\EmailReceiptPrinterDto;
use NineDigit\eKasa\Cloud\Client\Models\Registrations\Receipts\EmailReceiptPrinterOptions;
use NineDigit\eKasa\Cloud\Client\Models\Registrations\Receipts\ReceiptItemType;
use NineDigit\eKasa\Cloud\Client\Models\Registrations\Receipts\ReceiptPrinterName;
use PHPUnit\Framework\TestCase;
use NineDigit\eKasa\Cloud\Client\Models\Registrations\Receipts\ReceiptRegistrationDto;
use NineDigit\eKasa\Cloud\Client\Models\Registrations\Receipts\ReceiptRegistrationItemDto;
use NineDigit\eKasa\Cloud\Client\Models\Registrations\Receipts\ReceiptRegistrationPaymentDto;
use NineDigit\eKasa\Cloud\Client\Models\Registrations\Receipts\ReceiptRegistrationRequestDto;
use NineDigit\eKasa\Cloud\Client\Models\Registrations\Receipts\ReceiptType;
use NineDigit\eKasa\Cloud\Client\Models\Registrations\Receipts\RegistrationRejectionReasonDto;
use NineDigit\eKasa\Cloud\Client\Models\Registrations\RegistrationErrorDto;
use NineDigit\eKasa\Cloud\Client\Models\Registrations\RegistrationState;
use NineDigit\eKasa\Cloud\Client\Models\SellerDto;
use NineDigit\eKasa\Cloud\Client\Models\SellerIdType;
use NineDigit\eKasa\Cloud\Client\ApiErrorCode;
use NineDigit\eKasa\Cloud\Client\Models\ProblemDetails;
use NineDigit\eKasa\Cloud\Client\Models\ValidationProblemDetails;
use NineDigit\eKasa\Cloud\Client\Serialization\SymfonyJsonSerializer;

final class SymfonyJsonSerializerTest extends TestCase {

  public function testReceiptRegistrationDtoDeserialization() {
    $serializer = new SymfonyJsonSerializer();
    $type = ReceiptRegistrationDto::class;

    $json = '{
      "request": {
          "externalId": "e52ff4d1-f2ed-4493-9e9a-a73739b1ba69",
          "receiptType": "CashRegister",
          "amount": 2.58,
          "issueDate": "2021-07-14T08:20:03.8016655Z",
          "orpCreateDate": "2021-07-14T08:20:03.8016655Z",
          "receiptNumber": 1,
          "paragonNumber": 1,
          "invoiceNumber": "FA-0001",
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
          "reducedVatAmount": 0.43,
          "taxFreeAmount": 0.43,
          "taxBaseBasic": 0.43,
          "taxBaseReduced": 0.43,
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
                  "referenceReceiptId": "O-7DBCDA8A56EE426DBCDA8A56EE426D1A",
                  "vatRate": 20.00,
                  "specialRegulation": "UsedGood",
                  "voucherNumber": "201801001",
                  "seller": {
                    "id": "SK1234567890",
                    "type": "ICDPH"
                  },
                  "description": "Tovar"
              }
          ],
          "payments": [
              {
                  "name": "Hotovosť",
                  "amount": 2.58
              }
          ],
          "okp": "32627337-07256af7-bb27ad9c-27a2cf6a-21292715",
          "pkp": "T+ALV0Tfcvrpo6kHMJmof3mcJBFsl6cCYUym5RjoNT8lqpHHsOmXIwL9D/AUYblvfYLGa7IdMyk1gi1ycYNbGkATBnMF4VBCLdXELmCF0zGD2cdTIspE2irRKEtlOWwV5ixDnkXnt3NORHwjG5YWwS2X6rdN3TTx19qgAdLC4iD80keypTD9A7JBAEen6dH10pDQjU5fj4JSJfObJHbBuJXra880wDW1C29YNTq1bmrpjA/qG1P5khhiFNubUrKf2KQmbAuIRepHl3wxgWxMjPzg3pWWRG/dGTHmdC9OszT8MuMQlDgO+uGC6W6uY6qp7aDy1sGbkp4gCoi05cgCjg==",
          "headerText": "Nine Digit, s.r.o.",
          "footerText": "Otvorené non-stop.",
          "requestId": "bf4e7cbb-fccb-4794-bb19-b31814265892",
          "requestDate": "2021-07-09T12:42:48.5408721Z",
          "sendingCount": 1,
          "receiptId": "O-7DBCDA8A56EE426DBCDA8A56EE426D1A",
          "orpProcessDate": "2021-07-09T12:42:49Z",
          "eKasaError": {
            "message": "Chyba v podpise dátovej správy.",
            "code": -10
          }
      },
      "printer": {
          "name": "email",
          "options": {
            "to": "mail@example.com"
          }
      },
      "creationDate": "2021-07-14T08:19:49.6432131Z",
      "createdBy": "39fd0e35-c06a-7c3b-3bf7-acd229d31764",
      "notificationDate": "2021-07-14T08:20:03.8016655Z",
      "validityTimeSpan": 3600000,
      "acceptationDate": "2021-07-14T08:20:03.8016655Z",
      "completionTimeSpan": 1000,
      "completionDate": "2021-07-14T08:20:03.8016655Z",
      "state": "Canceled",
      "error": {
        "message": "General error.",
        "code": "-1",
        "source": "Cloud",
        "traceId": "T:0001"
      },
      "rejectionReason": {
        "message": "Rejected.",
        "code": -1
      },
      "id": "39fdb646-a356-c69c-8c64-a4d6e63fb2c4"
    }';
    
    $receiptRegistration = $serializer->deserialize($json, $type);

    $this->assertInstanceOf(ReceiptRegistrationDto::class, $receiptRegistration);
    $this->assertEquals(DateTimeHelper::createUtc(2021, 7, 14, 8, 19, 49, 643213), $receiptRegistration->creationDate);
    $this->assertIsString("39fd0e35-c06a-7c3b-3bf7-acd229d31764", $receiptRegistration->createdBy);
    $this->assertEquals(DateTimeHelper::createUtc(2021, 7, 14, 8, 20, 3, 801665), $receiptRegistration->notificationDate);
    $this->assertEquals(3600000, $receiptRegistration->validityTimeSpan);
    $this->assertEquals(DateTimeHelper::createUtc(2021, 7, 14, 8, 20, 3, 801665), $receiptRegistration->acceptationDate);
    $this->assertEquals(1000, $receiptRegistration->completionTimeSpan);
    $this->assertEquals(DateTimeHelper::createUtc(2021, 7, 14, 8, 20, 3, 801665), $receiptRegistration->completionDate);
    $this->assertEquals(RegistrationState::CANCELED, $receiptRegistration->state);

    $this->assertInstanceOf(RegistrationErrorDto::class, $receiptRegistration->error);
    $this->assertEquals("General error.", $receiptRegistration->error->message);
    $this->assertEquals("-1", $receiptRegistration->error->code);
    $this->assertEquals("Cloud", $receiptRegistration->error->source);
    $this->assertEquals("T:0001", $receiptRegistration->error->traceId);

    $this->assertInstanceOf(RegistrationRejectionReasonDto::class, $receiptRegistration->rejectionReason);
    $this->assertEquals("Rejected.", $receiptRegistration->rejectionReason->message);
    $this->assertEquals(-1, $receiptRegistration->rejectionReason->code);

    $this->assertEquals("39fdb646-a356-c69c-8c64-a4d6e63fb2c4", $receiptRegistration->id);
    
    // Request
    $this->assertInstanceOf(ReceiptRegistrationRequestDto::class, $receiptRegistration->request);
    $this->assertEquals("e52ff4d1-f2ed-4493-9e9a-a73739b1ba69", $receiptRegistration->request->externalId);
    $this->assertEquals(ReceiptType::CASH_REGISTER, $receiptRegistration->request->receiptType);
    $this->assertEquals(2.58, $receiptRegistration->request->amount);
    $this->assertEquals(DateTimeHelper::createUtc(2021, 7, 14, 8, 20, 3, 801665), $receiptRegistration->request->issueDate);
    $this->assertEquals(DateTimeHelper::createUtc(2021, 7, 14, 8, 20, 3, 801665), $receiptRegistration->request->orpCreateDate);
    $this->assertEquals(1, $receiptRegistration->request->receiptNumber);
    $this->assertEquals(1, $receiptRegistration->request->paragonNumber);
    $this->assertEquals("FA-0001", $receiptRegistration->request->invoiceNumber);
    $this->assertEquals("1234567890", $receiptRegistration->request->dic);
    $this->assertEquals("SK1234567890", $receiptRegistration->request->icDph);
    $this->assertEquals("76543210", $receiptRegistration->request->ico);

    $this->assertEquals("88812345678900001", $receiptRegistration->request->cashRegisterCode);
    $this->assertEquals(false, $receiptRegistration->request->paragon);
    $this->assertEquals(0.43, $receiptRegistration->request->basicVatAmount);
    $this->assertEquals(0.43, $receiptRegistration->request->reducedVatAmount);
    $this->assertEquals(0.43, $receiptRegistration->request->taxFreeAmount);
    $this->assertEquals(0.43, $receiptRegistration->request->taxBaseBasic);
    $this->assertEquals(0.43, $receiptRegistration->request->taxBaseReduced);

    // Customer
    $this->assertInstanceOf(CustomerDto::class, $receiptRegistration->request->customer);
    $this->assertEquals("2004567890", $receiptRegistration->request->customer->id);
    $this->assertEquals(CustomerIdType::DIC, $receiptRegistration->request->customer->type);

    // Items
    $this->assertIsArray($receiptRegistration->request->items);
    $this->assertCount(1, $receiptRegistration->request->items);

    // Item[0]
    $this->assertInstanceOf(ReceiptRegistrationItemDto::class, $receiptRegistration->request->items[0]);

    $this->assertEquals(ReceiptItemType::POSITIVE, $receiptRegistration->request->items[0]->type);
    $this->assertEquals("Coca Cola 0.25l", $receiptRegistration->request->items[0]->name);
    $this->assertEquals(2.58, $receiptRegistration->request->items[0]->price);
    $this->assertEquals(1.29, $receiptRegistration->request->items[0]->unitPrice);

    $this->assertInstanceOf(QuantityDto::class, $receiptRegistration->request->items[0]->quantity);
    $this->assertEquals(2.000, $receiptRegistration->request->items[0]->quantity->amount);
    $this->assertEquals("ks", $receiptRegistration->request->items[0]->quantity->unit);

    $this->assertEquals("O-7DBCDA8A56EE426DBCDA8A56EE426D1A", $receiptRegistration->request->items[0]->referenceReceiptId);
    $this->assertEquals(20.00, $receiptRegistration->request->items[0]->vatRate);
    $this->assertEquals("UsedGood", $receiptRegistration->request->items[0]->specialRegulation);
    $this->assertEquals("201801001", $receiptRegistration->request->items[0]->voucherNumber);

    $this->assertInstanceOf(SellerDto::class, $receiptRegistration->request->items[0]->seller);
    $this->assertEquals("SK1234567890", $receiptRegistration->request->items[0]->seller->id);
    $this->assertEquals(SellerIdType::ICDPH, $receiptRegistration->request->items[0]->seller->type);

    $this->assertEquals("Tovar", $receiptRegistration->request->items[0]->description);

    // Payments
    $this->assertIsArray($receiptRegistration->request->payments);
    $this->assertCount(1, $receiptRegistration->request->payments);

    // Payment[0]
    $this->assertInstanceOf(ReceiptRegistrationPaymentDto::class, $receiptRegistration->request->payments[0]);

    $this->assertEquals("Hotovosť", $receiptRegistration->request->payments[0]->name);
    $this->assertEquals(2.58, $receiptRegistration->request->payments[0]->amount);

    //

    $this->assertEquals("32627337-07256af7-bb27ad9c-27a2cf6a-21292715", $receiptRegistration->request->okp);
    $this->assertEquals("T+ALV0Tfcvrpo6kHMJmof3mcJBFsl6cCYUym5RjoNT8lqpHHsOmXIwL9D/AUYblvfYLGa7IdMyk1gi1ycYNbGkATBnMF4VBCLdXELmCF0zGD2cdTIspE2irRKEtlOWwV5ixDnkXnt3NORHwjG5YWwS2X6rdN3TTx19qgAdLC4iD80keypTD9A7JBAEen6dH10pDQjU5fj4JSJfObJHbBuJXra880wDW1C29YNTq1bmrpjA/qG1P5khhiFNubUrKf2KQmbAuIRepHl3wxgWxMjPzg3pWWRG/dGTHmdC9OszT8MuMQlDgO+uGC6W6uY6qp7aDy1sGbkp4gCoi05cgCjg==", $receiptRegistration->request->pkp);
    $this->assertEquals("Nine Digit, s.r.o.", $receiptRegistration->request->headerText);
    $this->assertEquals("Otvorené non-stop.", $receiptRegistration->request->footerText);
    $this->assertEquals("bf4e7cbb-fccb-4794-bb19-b31814265892", $receiptRegistration->request->requestId);
    $this->assertEquals(DateTimeHelper::createUtc(2021, 7, 9, 12, 42, 48, 540872), $receiptRegistration->request->requestDate);
    $this->assertEquals(1, $receiptRegistration->request->sendingCount);
    $this->assertEquals("O-7DBCDA8A56EE426DBCDA8A56EE426D1A", $receiptRegistration->request->receiptId);
    $this->assertEquals(DateTimeHelper::createUtc(2021, 7, 9, 12, 42, 49), $receiptRegistration->request->orpProcessDate);

    $this->assertInstanceOf(EKasaErrorDto::class, $receiptRegistration->request->eKasaError);
    $this->assertEquals("Chyba v podpise dátovej správy.", $receiptRegistration->request->eKasaError->message);
    $this->assertEquals(-10, $receiptRegistration->request->eKasaError->code);

    // Printer
    $this->assertInstanceOf(EmailReceiptPrinterDto::class, $receiptRegistration->printer);
    $this->assertEquals(ReceiptPrinterName::EMAIL, $receiptRegistration->printer->name);
    $this->assertInstanceOf(EmailReceiptPrinterOptions::class, $receiptRegistration->printer->options);
    $this->assertEquals("mail@example.com", $receiptRegistration->printer->options->to);
  }

  public function testCustomerDtoDeserialization() {
    $serializer = new SymfonyJsonSerializer();
    $type = Customer::class;

    $json = '{
      "id": "3a0537ea-ce28-5636-85ea-a33b27f9958c",
      "creationTime": "2022-07-22T11:49:42Z",
      "creatorId": "3a053799-6dc4-20c5-9544-e4f8391f3f3a",
      "lastModificationTime": "2022-07-22T13:09:48Z",
      "lastModifierId": "3a053799-6dc4-20c5-9544-e4f8391f3f3a",
      "concurrencyStamp": "ad6c3d54d87044dbb55ccc77a9791b5a",
      "tenantId": "3a053799-6da6-6458-c289-8dcfd9de42cc",
      "isActive": true,
      "status": "Valid",
      "externalId": "1:Petovskys-iMac:62d5542c9c104378d6db9a79:",
      "isCompany": true,
      "company": {
          "name": "Company, s.r.o.",
          "crn": "1234567890",
          "vatId": "SK9876543210",
          "taxId": "9876543210"
      },
      "creditBalance": {
          "amount": 2.20,
          "currency": "EUR"
      },
      "creditBalanceTransactions": [
          {
              "id": "3a05321e-8003-dfc6-f2bd-e100a5a55c7c",
              "creationTime": "2022-07-22T11:49:42",
              "creatorId": "3a053799-6dc4-20c5-9544-e4f8391f3f3a",
              "sequenceNumber": 1,
              "externalId": "1:Petovskys-iMac:1:",
              "amount": {
                  "amount": 2.20,
                  "currency": "EUR"
              },
              "type": "Correction",
              "endingCreditBalance": {
                  "amount": 2.20,
                  "currency": "EUR"
              },
              "meta": {
                  "Portos.Features:NineDigit.EKasaCloud:Remote:Id": "s:3a05321e-8003-dfc6-f2bd-e100a5a55c7c"
              },
              "note": "Transakcia #498503871",
              "customerId": "3a0537ea-ce28-5636-85ea-a33b27f9958c"
          }
      ],
      "cards": [
          {
              "id": "3a05321e-7ffd-9089-f57b-fa48f6c08d65",
              "creationTime": "2022-07-22T11:49:42Z",
              "creatorId": "3a053799-6dc4-20c5-9544-e4f8391f3f3a",
              "lastModificationTime": "2022-07-22T13:09:48Z",
              "lastModifierId": "3a053799-6dc4-20c5-9544-e4f8391f3f3a",
              "tenantId": "3a053799-6da6-6458-c289-8dcfd9de42cc",
              "externalId": "1:Petovskys-iMac:0179000000015140:",
              "concurrencyStamp": "3536485aadb0472f8a27127ea9bb2f66",
              "isActive": true,
              "isVirtual": true,
              "serialNumber": "0179000000015140",
              "processor": "G",
              "status": "Valid",
              "statusTime": "2022-07-22T11:49:53Z",
              "activationTime": "2022-06-01T00:00:00Z",
              "expirationTime": "2022-12-01T00:00:00Z",
              "meta": {
                  "Portos.Features:NineDigit.EKasaCloud:Remote:Id": "s:3a05321e-7ffd-9089-f57b-fa48f6c08d65"
              },
              "note": "Karta #1",
              "customerId": "3a0537ea-ce28-5636-85ea-a33b27f9958c"
          },
          {
              "id": "3a05321e-8069-042c-ca14-4704f4b97d28",
              "creationTime": "2022-07-22T11:49:42Z",
              "creatorId": "3a053799-6dc4-20c5-9544-e4f8391f3f3a",
              "lastModificationTime": "2022-07-22T13:09:48Z",
              "lastModifierId": "3a053799-6dc4-20c5-9544-e4f8391f3f3a",
              "tenantId": "3a053799-6da6-6458-c289-8dcfd9de42cc",
              "externalId": "1:Petovskys-iMac:0179000000017039:",
              "concurrencyStamp": "b8bbbb3ef3ea4c20a5600827637e251d",
              "isActive": true,
              "isVirtual": false,
              "serialNumber": "0179000000017039",
              "processor": "P",
              "status": "Valid",
              "statusTime": "2022-07-22T11:49:59Z",
              "activationTime": "2022-06-01T00:00:00Z",
              "expirationTime": "2022-12-01T00:00:00Z",
              "meta": {
                  "Portos.Features:NineDigit.EKasaCloud:Remote:Id": "s:3a05321e-8069-042c-ca14-4704f4b97d28"
              },
              "note": "Karta #2",
              "customerId": "3a0537ea-ce28-5636-85ea-a33b27f9958c"
          }
      ],
      "creditRate": 0.350000,
      "discountRate": 22.50,
      "meta": {
          "Portos.Features:NineDigit.EKasaCloud:Local:Version": "i:6"
      }
    }';

    $customer = $serializer->deserialize($json, $type);

    $this->assertInstanceOf(Customer::class, $customer);
    $this->assertEquals("3a0537ea-ce28-5636-85ea-a33b27f9958c", $customer->id);
    $this->assertEquals(DateTimeHelper::createUtc(2022, 7, 22, 11, 49, 42), $customer->creationTime);
    $this->assertEquals("3a053799-6dc4-20c5-9544-e4f8391f3f3a", $customer->creatorId);
    $this->assertEquals(DateTimeHelper::createUtc(2022, 7, 22, 13, 9, 48), $customer->lastModificationTime);
    $this->assertEquals("3a053799-6dc4-20c5-9544-e4f8391f3f3a", $customer->lastModifierId);
    $this->assertEquals("ad6c3d54d87044dbb55ccc77a9791b5a", $customer->concurrencyStamp);
    $this->assertEquals("3a053799-6da6-6458-c289-8dcfd9de42cc", $customer->tenantId);
    $this->assertEquals(true, $customer->isActive);
    $this->assertEquals("Valid", $customer->status);
    $this->assertEquals("1:Petovskys-iMac:62d5542c9c104378d6db9a79:", $customer->externalId);
    $this->assertEquals(true, $customer->isCompany);

    $this->assertInstanceOf(CustomerCompanyDto::class, $customer->company);
    $this->assertEquals("Company, s.r.o.", $customer->company->name);
    $this->assertEquals("1234567890", $customer->company->crn);
    $this->assertEquals("SK9876543210", $customer->company->vatId);
    $this->assertEquals("9876543210", $customer->company->taxId);

    $this->assertInstanceOf(CreditDto::class, $customer->creditBalance);
    $this->assertEquals(2.20, $customer->creditBalance->amount);
    $this->assertEquals("EUR", $customer->creditBalance->currency);

    $this->assertIsArray($customer->creditBalanceTransactions);
    $this->assertCount(1, $customer->creditBalanceTransactions);

    // Transaction
    $transaction = $customer->creditBalanceTransactions[0];
    $this->assertEquals("3a05321e-8003-dfc6-f2bd-e100a5a55c7c", $transaction->id);
    $this->assertEquals(DateTimeHelper::createUtc(2022, 7, 22, 11, 49, 42), $transaction->creationTime);
    $this->assertEquals("3a053799-6dc4-20c5-9544-e4f8391f3f3a", $transaction->creatorId);
    $this->assertEquals("1:Petovskys-iMac:1:", $transaction->externalId);

    $this->assertInstanceOf(CreditDto::class, $transaction->amount);
    $this->assertEquals(2.20, $transaction->amount->amount);
    $this->assertEquals("EUR", $transaction->amount->currency);

    $this->assertEquals("Correction", $transaction->type);

    $this->assertInstanceOf(CreditDto::class, $transaction->endingCreditBalance);
    $this->assertEquals(2.20, $transaction->endingCreditBalance->amount);
    $this->assertEquals("EUR", $transaction->endingCreditBalance->currency);

    $this->assertIsArray($transaction->meta);
    $this->assertCount(1, $transaction->meta);
    
    $this->assertArrayHasKey("Portos.Features:NineDigit.EKasaCloud:Remote:Id", $transaction->meta);
    $this->assertEquals("s:3a05321e-8003-dfc6-f2bd-e100a5a55c7c", $transaction->meta["Portos.Features:NineDigit.EKasaCloud:Remote:Id"]);

    $this->assertEquals("Transakcia #498503871", $transaction->note);
    $this->assertEquals("3a0537ea-ce28-5636-85ea-a33b27f9958c", $transaction->customerId);

    $this->assertIsArray($customer->cards);
    $this->assertCount(2, $customer->cards);

    // Card #1
    $card1 = $customer->cards[0];

    $this->assertEquals("3a05321e-7ffd-9089-f57b-fa48f6c08d65", $card1->id);
    $this->assertEquals(DateTimeHelper::createUtc(2022, 7, 22, 11, 49, 42), $card1->creationTime);
    $this->assertEquals("3a053799-6dc4-20c5-9544-e4f8391f3f3a", $card1->creatorId);
    // $this->assertEquals(DateTimeHelper::createUtc(2022, 7, 22, 13, 9, 48), $card1->lastModificationTime);
    // $this->assertEquals("3a053799-6dc4-20c5-9544-e4f8391f3f3a", $card1->lastModifierId);
    $this->assertEquals("3a053799-6da6-6458-c289-8dcfd9de42cc", $card1->tenantId);
    $this->assertEquals("1:Petovskys-iMac:0179000000015140:", $card1->externalId);
    $this->assertEquals("3536485aadb0472f8a27127ea9bb2f66", $card1->concurrencyStamp);
    $this->assertEquals(true, $card1->isActive);
    $this->assertEquals(true, $card1->isVirtual);
    $this->assertEquals("0179000000015140", $card1->serialNumber);
    $this->assertEquals("G", $card1->processor);
    $this->assertEquals("Valid", $card1->status);
    $this->assertEquals(DateTimeHelper::createUtc(2022, 7, 22, 11, 49, 53), $card1->statusTime);
    $this->assertEquals(DateTimeHelper::createUtc(2022, 6, 1, 0, 0, 0), $card1->activationTime);
    $this->assertEquals(DateTimeHelper::createUtc(2022, 12, 1, 0, 0, 0), $card1->expirationTime);
    
    $this->assertIsArray($card1->meta);
    $this->assertCount(1, $card1->meta);
    
    $this->assertArrayHasKey("Portos.Features:NineDigit.EKasaCloud:Remote:Id", $card1->meta);
    $this->assertEquals("s:3a05321e-7ffd-9089-f57b-fa48f6c08d65", $card1->meta["Portos.Features:NineDigit.EKasaCloud:Remote:Id"]);
    
    $this->assertEquals("Karta #1", $card1->note);
    $this->assertEquals("3a0537ea-ce28-5636-85ea-a33b27f9958c", $card1->customerId);

    // Card #2
    $card2 = $customer->cards[1];

    $this->assertEquals("3a05321e-8069-042c-ca14-4704f4b97d28", $card2->id);
    $this->assertEquals(DateTimeHelper::createUtc(2022, 7, 22, 11, 49, 42), $card2->creationTime);
    $this->assertEquals("3a053799-6dc4-20c5-9544-e4f8391f3f3a", $card2->creatorId);
    $this->assertEquals(DateTimeHelper::createUtc(2022, 7, 22, 13, 9, 48), $card2->lastModificationTime);
    $this->assertEquals("3a053799-6dc4-20c5-9544-e4f8391f3f3a", $card2->lastModifierId);
    $this->assertEquals("3a053799-6da6-6458-c289-8dcfd9de42cc", $card2->tenantId);
    $this->assertEquals("1:Petovskys-iMac:0179000000017039:", $card2->externalId);
    $this->assertEquals("b8bbbb3ef3ea4c20a5600827637e251d", $card2->concurrencyStamp);
    $this->assertEquals(true, $card2->isActive);
    $this->assertEquals(false, $card2->isVirtual);
    $this->assertEquals("0179000000017039", $card2->serialNumber);
    $this->assertEquals("P", $card2->processor);
    $this->assertEquals("Valid", $card2->status);
    $this->assertEquals(DateTimeHelper::createUtc(2022, 7, 22, 11, 49, 59), $card2->statusTime);
    $this->assertEquals(DateTimeHelper::createUtc(2022, 6, 1, 0, 0, 0), $card2->activationTime);
    $this->assertEquals(DateTimeHelper::createUtc(2022, 12, 1, 0, 0, 0), $card2->expirationTime);
    
    $this->assertIsArray($card2->meta);
    $this->assertCount(1, $card2->meta);
    
    $this->assertArrayHasKey("Portos.Features:NineDigit.EKasaCloud:Remote:Id", $card2->meta);
    $this->assertEquals("s:3a05321e-8069-042c-ca14-4704f4b97d28", $card2->meta["Portos.Features:NineDigit.EKasaCloud:Remote:Id"]);
    
    $this->assertEquals("Karta #2", $card2->note);
    $this->assertEquals("3a0537ea-ce28-5636-85ea-a33b27f9958c", $card2->customerId);

    $this->assertEquals(0.350000, $customer->creditRate);
    $this->assertEquals(22.50, $customer->discountRate);

    $this->assertIsArray($customer->meta);
    $this->assertCount(1, $customer->meta);
    
    $this->assertArrayHasKey("Portos.Features:NineDigit.EKasaCloud:Local:Version", $customer->meta);
    $this->assertEquals("i:6", $customer->meta["Portos.Features:NineDigit.EKasaCloud:Local:Version"]);
  }

  public function testValidationProblemDetailsDeserialization() {
    $serializer = new SymfonyJsonSerializer();
    $type = ValidationProblemDetails::class;

    $json = '{
      "errors": {
          "Request.Items": [
              "\'Items\' must not be empty."
          ]
      },
      "type": "https://tools.ietf.org/html/rfc7231#section-6.5.1",
      "title": "One or more validation errors occurred.",
      "status": 400,
      "traceId": "00-3883c3382a81f24ca6ac58a375d6de64-d99c7a32e359d24f-00"
    }';
    
    $details = $serializer->deserialize($json, $type);

    $this->assertInstanceOf(ValidationProblemDetails::class, $details);

    $this->assertIsArray($details->errors);
    $this->assertCount(1, $details->errors);
    $this->assertArrayHasKey("Request.Items", $details->errors);
    $this->assertIsArray($details->errors["Request.Items"]);
    $this->assertCount(1, $details->errors["Request.Items"]);
    $this->assertEquals("'Items' must not be empty.", $details->errors["Request.Items"][0]);

    $this->assertEquals("https://tools.ietf.org/html/rfc7231#section-6.5.1", $details->type);
    $this->assertEquals("One or more validation errors occurred.", $details->title);
    $this->assertEquals(400, $details->status);
    $this->assertEquals("00-3883c3382a81f24ca6ac58a375d6de64-d99c7a32e359d24f-00", $details->traceId);
  }

  public function testProblemDetailsDeserialization() {
    $serializer = new SymfonyJsonSerializer();
    $type = ProblemDetails::class;

    $json = '{
      "title": "Tenant not found!",
      "status": 403,
      "instance": "/api/v1/registrations/receipts",
      "code": -101,
      "traceId": "0HMCTVDF5NB0B:00000002"
    }';

    $details = $serializer->deserialize($json, $type);

    $this->assertInstanceOf(ProblemDetails::class, $details);

    $this->assertEquals("Tenant not found!", $details->title);
    $this->assertEquals(403, $details->status);
    $this->assertEquals("/api/v1/registrations/receipts", $details->instance);
    $this->assertEquals(ApiErrorCode::TENANT_NOT_FOUND, $details->code);
    $this->assertEquals("0HMCTVDF5NB0B:00000002", $details->traceId);
  }
}

?>