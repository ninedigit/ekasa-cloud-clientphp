<?php

namespace NineDigit\eKasa\Cloud\Client;

use \DateTimeZone;
use NineDigit\eKasa\Cloud\Client\Models\Registrations\EKasaErrorDto;
use NineDigit\eKasa\Cloud\Client\Models\Registrations\Receipts\EmailReceiptPrinterDto;
use NineDigit\eKasa\Cloud\Client\Models\Registrations\Receipts\EmailReceiptPrinterOptions;
use PHPUnit\Framework\TestCase;
use NineDigit\eKasa\Cloud\Client\Models\Registrations\Receipts\ReceiptRegistrationDto;
use NineDigit\eKasa\Cloud\Client\Models\Registrations\RegistrationState;
use NineDigit\eKasa\Cloud\Client\Serialization\SymfonyJsonSerializer;

final class SymfonyJsonSerializerTest extends TestCase {

  public function testReceiptRegistrationDtoDeserialization() {
    $serializer = new SymfonyJsonSerializer();
    $json = '{"request":{"externalId":"e52ff4d1-f2ed-4493-9e9a-a73739b1ba68","receiptType":"CashRegister","amount":null,"issueDate":null,"orpCreateDate":"2021-07-09T12:42:48.540872","receiptNumber":1,"paragonNumber":null,"invoiceNumber":null,"dic":"1234567890","icDph":"SK1234567890","ico":"76543210","customer":{"id":"2004567890","type":"DIC"},"cashRegisterCode":"88812345678900001","paragon":false,"basicVatAmount":0.43,"reducedVatAmount":null,"taxFreeAmount":null,"taxBaseBasic":2.15,"taxBaseReduced":null,"items":[{"type":"Positive","name":"Coca Cola 0.25l","price":2.58,"unitPrice":1.29,"quantity":{"amount":2.0000,"unit":"ks"},"referenceReceiptId":null,"vatRate":20.00,"specialRegulation":null,"voucherNumber":null,"seller":null,"description":null}],"payments":[{"name":"Hotovosť","amount":2.58}],"okp":"32627337-07256af7-bb27ad9c-27a2cf6a-21292715","pkp":"T+ALV0Tfcvrpo6kHMJmof3mcJBFsl6cCYUym5RjoNT8lqpHHsOmXIwL9D/AUYblvfYLGa7IdMyk1gi1ycYNbGkATBnMF4VBCLdXELmCF0zGD2cdTIspE2irRKEtlOWwV5ixDnkXnt3NORHwjG5YWwS2X6rdN3TTx19qgAdLC4iD80keypTD9A7JBAEen6dH10pDQjU5fj4JSJfObJHbBuJXra880wDW1C29YNTq1bmrpjA/qG1P5khhiFNubUrKf2KQmbAuIRepHl3wxgWxMjPzg3pWWRG/dGTHmdC9OszT8MuMQlDgO+uGC6W6uY6qp7aDy1sGbkp4gCoi05cgCjg==","headerText":"NineDigit,s.r.o.","footerText":"Otvorenénon-stop.","requestId":"bf4e7cbb-fccb-4794-bb19-b31814265892","requestDate":"2021-07-09T12:42:48.540872","sendingCount":1,"receiptId":null,"orpProcessDate":"2021-07-09T12:42:49","eKasaError":{"message":"Chyba v podpise dátovej správy.","code":-10}},"printer":{"name":"email","options":{"to":"mail@example.com"}},"creationDate":"2021-07-09T12:42:48.157573","createdBy":"39fd0e35-c06a-7c3b-3bf7-acd229d31764","notificationDate":"2021-07-09T12:42:48.221826","validityTimeSpan":20000,"acceptationDate":"2021-07-09T12:42:48.423687","completionTimeSpan":60000,"completionDate":"2021-07-09T12:42:49.533928","state":"ProcessedFailed","error":null,orpCancelReason:null,"id":"39fd9d77-91e8-ba5d-5a7a-1da365bb4278"}';
    $type = ReceiptRegistrationDto::class;

    $receiptRegistration = $serializer->deserialize($json, $type);

    $this->assertInstanceOf(ReceiptRegistrationDto::class, $receiptRegistration);
    $this->assertInstanceOf(EmailReceiptPrinterDto::class, $receiptRegistration->printer);
    $this->assertInstanceOf(EmailReceiptPrinterOptions::class, $receiptRegistration->printer->options);
    $this->assertIsString(RegistrationState::PROCESS_FAILED, $receiptRegistration->state);
    $this->assertInstanceOf(EKasaErrorDto::class, $receiptRegistration->request->eKasaError);
    $this->assertEquals("UTC", $receiptRegistration->completionDate->getTimezone()->getName());
  }
}

?>