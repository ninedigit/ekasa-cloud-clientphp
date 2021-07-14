<?php

namespace NineDigit\eKasa\Cloud\Client;

use \DateTimeZone;
use NineDigit\eKasa\Cloud\Client\Models\CustomerDto;
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
    $this->assertEquals($this->createUtcDateTime(2021, 7, 14, 8, 19, 49, 643213), $receiptRegistration->creationDate);
    $this->assertIsString("39fd0e35-c06a-7c3b-3bf7-acd229d31764", $receiptRegistration->createdBy);
    $this->assertEquals($this->createUtcDateTime(2021, 7, 14, 8, 20, 3, 801665), $receiptRegistration->notificationDate);
    $this->assertEquals(3600000, $receiptRegistration->validityTimeSpan);
    $this->assertEquals($this->createUtcDateTime(2021, 7, 14, 8, 20, 3, 801665), $receiptRegistration->acceptationDate);
    $this->assertEquals(1000, $receiptRegistration->completionTimeSpan);
    $this->assertEquals($this->createUtcDateTime(2021, 7, 14, 8, 20, 3, 801665), $receiptRegistration->completionDate);
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
    $this->assertEquals($this->createUtcDateTime(2021, 7, 14, 8, 20, 3, 801665), $receiptRegistration->request->issueDate);
    $this->assertEquals($this->createUtcDateTime(2021, 7, 14, 8, 20, 3, 801665), $receiptRegistration->request->orpCreateDate);
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
    $this->assertEquals($this->createUtcDateTime(2021, 7, 9, 12, 42, 48, 540872), $receiptRegistration->request->requestDate);
    $this->assertEquals(1, $receiptRegistration->request->sendingCount);
    $this->assertEquals("O-7DBCDA8A56EE426DBCDA8A56EE426D1A", $receiptRegistration->request->receiptId);
    $this->assertEquals($this->createUtcDateTime(2021, 7, 9, 12, 42, 49), $receiptRegistration->request->orpProcessDate);

    $this->assertInstanceOf(EKasaErrorDto::class, $receiptRegistration->request->eKasaError);
    $this->assertEquals("Chyba v podpise dátovej správy.", $receiptRegistration->request->eKasaError->message);
    $this->assertEquals(-10, $receiptRegistration->request->eKasaError->code);

    // Printer
    $this->assertInstanceOf(EmailReceiptPrinterDto::class, $receiptRegistration->printer);
    $this->assertEquals(ReceiptPrinterName::EMAIL, $receiptRegistration->printer->name);
    $this->assertInstanceOf(EmailReceiptPrinterOptions::class, $receiptRegistration->printer->options);
    $this->assertEquals("mail@example.com", $receiptRegistration->printer->options->to);
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

  private function createUtcDateTime(int $year, int $month, int $day, int $hour, int $minute, int $second = 0, int $microsecond = 0): \DateTime {
    $date = new \DateTime("now", new \DateTimeZone("UTC"));
    $date = $date->setDate($year, $month, $day);
    $date = $date->setTime($hour, $minute, $second, $microsecond);

    return $date;
  }
}

?>