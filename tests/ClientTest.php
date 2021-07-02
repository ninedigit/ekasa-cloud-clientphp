<?php

namespace NineDigit\eKasa\Cloud\ApiClient;

//use NineDigit\eKasa\Cloud\ApiClient;

use NineDigit\eKasa\Cloud\ApiClient\Exceptions\ProblemDetailsException;
use NineDigit\eKasa\Cloud\ApiClient\Models\CustomerDto;
use NineDigit\eKasa\Cloud\ApiClient\Models\CustomerIdType;
use NineDigit\eKasa\Cloud\ApiClient\Models\QuantityDto;
use NineDigit\eKasa\Cloud\ApiClient\Models\Registrations\Receipts\CreateReceiptRegistrationDto;
use NineDigit\eKasa\Cloud\ApiClient\Models\Registrations\Receipts\CreateReceiptRegistrationRequestDto;
use NineDigit\eKasa\Cloud\ApiClient\Models\Registrations\Receipts\EmailReceiptPrinterOptions;
use NineDigit\eKasa\Cloud\ApiClient\Models\Registrations\Receipts\ReceiptItemType;
use NineDigit\eKasa\Cloud\ApiClient\Models\Registrations\Receipts\ReceiptPrinterDto;
use NineDigit\eKasa\Cloud\ApiClient\Models\Registrations\Receipts\ReceiptPrinterName;
use NineDigit\eKasa\Cloud\ApiClient\Models\Registrations\Receipts\ReceiptRegistrationItemDto;
use NineDigit\eKasa\Cloud\ApiClient\Models\Registrations\Receipts\ReceiptRegistrationPaymentDto;
use NineDigit\eKasa\Cloud\ApiClient\Models\Registrations\Receipts\ReceiptType;
use PHPUnit\Framework\TestCase;

final class ClientTest extends TestCase {

    public function testReceiptRegistration() {
        $url = "http://localhost:5000/api";
        $publicKey = "8248d4058e36840bea23ebbe3e602f6e";
        $privateKey = "388e98f5c56728266991583a6f8fcd1b9279cdc00b5c371bffc0ea402b14d954";
        $tenantId = "39fd0386-1c7b-5fb0-201f-36725cbfcacc";

        $clientOptions = new ClientOptions($publicKey, $privateKey, $tenantId);
        $clientOptions->url = $url;

        $client = new Client($clientOptions);

        // Register receipt

        $printerOptions = new EmailReceiptPrinterOptions("mail@example.com");
        $receiptPrinter = new ReceiptPrinterDto(ReceiptPrinterName::EMAIL, $printerOptions);
        
        $receiptItem = new ReceiptRegistrationItemDto(
            ReceiptItemType::POSITIVE,
            "Coca Cola 0.25l",
            1.29,
            20.00,
            new QuantityDto(2.0000, "ks"),
            2.58);
        
        $payment = new ReceiptRegistrationPaymentDto(2.58, "Hotovosť");
        $receiptRegistrationRequest = new CreateReceiptRegistrationRequestDto();
        $receiptRegistrationRequest->externalId = "e52ff4d1-f2ed-4493-9e9a-a73739b1ba17";
        $receiptRegistrationRequest->receiptType = ReceiptType::CASH_REGISTER;
        $receiptRegistrationRequest->cashRegisterCode = "88812345678900001";
        $receiptRegistrationRequest->headerText = "Nine Digit, s.r.o.";
        $receiptRegistrationRequest->footerText = "Otvorené non-stop.";
        $receiptRegistrationRequest->customer = new CustomerDto("2004567890", CustomerIdType::DIC);
        $receiptRegistrationRequest->items = array($receiptItem);
        $receiptRegistrationRequest->payments = array($payment);
        

        $validityTimeSpan = 10000; // 10 sekúnd
        $createReceiptRegistration = new CreateReceiptRegistrationDto($receiptPrinter, $receiptRegistrationRequest, $validityTimeSpan);

        try {
            $receiptRegistration = $client->registerReceipt($createReceiptRegistration);
            var_dump($receiptRegistration);
        }
        catch (ValidationProblemDetailsException $ex) {
            echo $ex->__toString();
        }
        catch (ProblemDetailsException $ex) {
            echo $ex->__toString();
        }
    }

}

?>