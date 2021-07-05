<?php

namespace NineDigit\eKasa\Cloud\Client;

use NineDigit\eKasa\Cloud\Client\Models\Registrations\Receipts\EmailReceiptPrinterDto;
use NineDigit\eKasa\Cloud\Client\Models\Registrations\Receipts\EmailReceiptPrinterOptions;
use PHPUnit\Framework\TestCase;
use NineDigit\eKasa\Cloud\Client\Models\Registrations\Receipts\ReceiptRegistrationDto;
use NineDigit\eKasa\Cloud\Client\Serialization\SymfonyJsonSerializer;

final class SymfonyJsonSerializerTest extends TestCase {

    public function testReceiptRegistrationDtoDeserialization() {
        $serializer = new SymfonyJsonSerializer();
        $json = '{"request":{"externalId":"e52ff4d1-f2ed-4493-9e9a-a73739b1ba24","receiptType":"CashRegister","amount":null,"issueDate":null,"orpCreateDate":null,"receiptNumber":null,"paragonNumber":null,"invoiceNumber":null,"dic":null,"icDph":null,"ico":null,"customer":{"id":"2004567890","type":"DIC"},"cashRegisterCode":"88812345678900001","paragon":false,"basicVatAmount":null,"reducedVatAmount":null,"taxFreeAmount":null,"taxBaseBasic":null,"taxBaseReduced":null,"items":[{"type":"Positive","name":"Coca Cola 0.25l","price":2.58,"unitPrice":1.29,"quantity":{"amount":2.0000,"unit":"ks"},"referenceReceiptId":null,"vatRate":20.00,"specialRegulation":null,"voucherNumber":null,"seller":null,"description":null}],"payments":[{"name":"Hotovosť","amount":2.58}],"okp":null,"pkp":null,"headerText":"Nine Digit, s.r.o.","footerText":"Otvorené non-stop.","requestId":null,"requestDate":null,"sendingCount":null,"receiptId":null,"orpProcessDate":null},"response":{"error":null,"eKasaError":null,"eKasaErrorCode":null},"printer":{"name":"email","options":{"to":"mail@example.com"}},"creationDate":"2021-07-05T04:21:51.9535701Z","createdBy":"39fd8713-8c3d-699d-8e64-aab477b29530","notificationDate":"2021-07-05T04:21:54.8851503Z","validityTimeSpan":10000,"acceptationDate":null,"completionTimeSpan":null,"completionDate":"2021-07-05T04:22:04.4947625Z","state":"Expired","id":"39fd8713-8c3d-699d-8e64-aab477b29520"}';
        $type = ReceiptRegistrationDto::class;

        $receiptRegistration = $serializer->deserialize($json, $type);

        $this->assertInstanceOf(ReceiptRegistrationDto::class, $receiptRegistration);
        $this->assertInstanceOf(EmailReceiptPrinterDto::class, $receiptRegistration->printer);
        $this->assertInstanceOf(EmailReceiptPrinterOptions::class, $receiptRegistration->printer->options);
    }
  }

?>