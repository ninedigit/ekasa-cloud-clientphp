<?php

namespace NineDigit\eKasa\Cloud\Client;

use PHPUnit\Framework\TestCase;
use NineDigit\eKasa\Cloud\Client\Exceptions\ApiException;
use NineDigit\eKasa\Cloud\Client\Models\Customers\CustomerDto;
use NineDigit\eKasa\Cloud\Client\Models\Customers\CustomerFilterDto;
use NineDigit\eKasa\Cloud\Client\Models\Customers\GetCustomerListResultDto;

use \Error;
use NineDigit\eKasa\Cloud\Client\ApiClient;
use NineDigit\eKasa\Cloud\Client\ApiClientOptions;
use NineDigit\eKasa\Cloud\Client\Models\QuantityDto;
use NineDigit\eKasa\Cloud\Client\Models\Registrations\Receipts;
use NineDigit\eKasa\Cloud\Client\Models\Registrations\Receipts\PosReceiptPrinterOptions;
use NineDigit\eKasa\Cloud\Client\Models\Registrations\Receipts\PosReceiptPrinterDto;
use NineDigit\eKasa\Cloud\Client\Models\Registrations\Receipts\PdfReceiptPrinterOptions;
use NineDigit\eKasa\Cloud\Client\Models\Registrations\Receipts\PdfReceiptPrinterDto;
use NineDigit\eKasa\Cloud\Client\Models\Registrations\Receipts\EmailReceiptPrinterOptions;
use NineDigit\eKasa\Cloud\Client\Models\Registrations\Receipts\EmailReceiptPrinterDto;
use NineDigit\eKasa\Cloud\Client\Models\Registrations\Receipts\CreateReceiptRegistrationDto;
use NineDigit\eKasa\Cloud\Client\Models\Registrations\Receipts\ReceiptItemType;
use NineDigit\eKasa\Cloud\Client\Models\Registrations\Receipts\ReceiptRegistrationItemDto;
use NineDigit\eKasa\Cloud\Client\Models\Registrations\Receipts\ReceiptRegistrationPaymentDto;
use NineDigit\eKasa\Cloud\Client\Models\Registrations\Receipts\ReceiptType;
use NineDigit\eKasa\Cloud\Client\Models\Registrations\RegistrationState;


final class IntegrationTestsOptions {
    public ApiClientOptions $apiClientOptions;
    public string $cashRegisterCode;
    
    static function load(string $fileName): IntegrationTestsOptions {
        $contents = file_get_contents($fileName);
        $data = json_decode($contents, true, 512, JSON_THROW_ON_ERROR);

        $options = new IntegrationTestsOptions();
        $options->apiClientOptions = ApiClientOptions::load($data);

        $cashRegisterCode = $data['cashRegisterCode'];

        if (!is_string($cashRegisterCode) || strlen($cashRegisterCode) === 0) {
            $cashRegisterCode = "88812345678900001";
        }
        
        $options->cashRegisterCode = $cashRegisterCode;

        return $options;
    }
}

final class ApiClientIntegrationTest extends TestCase {
    
    private function getProductionDemoAccountSettings() {
        return IntegrationTestsOptions::load(dirname(__FILE__) . '/settings.json');
    }

    public function testGetCustomersWithFilter() {
        $settings = $this->getProductionDemoAccountSettings();
        $apiClient = new ApiClient($settings->apiClientOptions);

        $customerFilter = (new CustomerFilterDto())
            ->setIds(array("3a0537ea-cfb2-2b4b-d521-02db003b276c"))
            ->setExternalId("1:Petovskys-iMac:62d5542d9c104378d6db9ab6:")
            ->setIsActive(true)
            ->setCardId("3a05321e-8285-b22c-5a5f-e4d70833935f")
            ->setCardSerialNumbers(array("10000037"));

        $result = $apiClient->getCustomers($customerFilter);

        $this->assertInstanceOf(GetCustomerListResultDto::class, $result);
        $this->assertInstanceOf(\DateTime::class, $result->requestTime);
        $this->assertIsArray($result->items);

        $this->assertCount(1, $result->items);
        $this->assertInstanceOf(CustomerDto::class, $result->items[0]);
    }

    public function testGetCustomer() {
        $settings = $this->getProductionDemoAccountSettings();
        $apiClient = new ApiClient($settings->apiClientOptions);
        $customerId = "3a0537ea-cfb2-2b4b-d521-02db003b276c";

        $customer = $apiClient->getCustomer($customerId);

        $this->assertInstanceOf(CustomerDto::class, $customer);
    }

    public function testFindCustomer() {
        $settings = $this->getProductionDemoAccountSettings();
        $apiClient = new ApiClient($settings->apiClientOptions);
        $customerId = "3a0537ea-cfb2-2b4b-d521-02db003b276c";

        $customer = $apiClient->getCustomer($customerId);

        $this->assertInstanceOf(CustomerDto::class, $customer);
    }

    public function testGetNonExistingCustomer() {
        $settings = $this->getProductionDemoAccountSettings();
        $apiClient = new ApiClient($settings->apiClientOptions);

        $customerId = "00000000-0000-0000-0000-000000000000";

        try
        {
            $customer = $apiClient->getCustomer($customerId);
            $this->fail("ApiException not thrown.");
        }
        catch (ApiException $ex)
        {
            $this->assertEquals(404, $ex->statusCode);
        }
    }

    public function testFindNonExistingCustomer() {
        $settings = $this->getProductionDemoAccountSettings();
        $apiClient = new ApiClient($settings->apiClientOptions);
        $customerId = "00000000-0000-0000-0000-000000000000";

        $customer = $apiClient->findCustomer($customerId);

        $this->assertNull($customer);
    }

    public function testRegisterReceiptUsingPosPrinter() {
        $settings = $this->getProductionDemoAccountSettings();
        $apiClient = new ApiClient($settings->apiClientOptions);

        $posPrinterOptions = new PosReceiptPrinterOptions();
        $receiptPrinter = new PosReceiptPrinterDto($posPrinterOptions);

        $cashRegisterCode = $settings->cashRegisterCode;
        $externalId = "e52ff4d1-f2ed-4493-9e9a-a73739b1ba23";

        $item = new ReceiptRegistrationItemDto(
            ReceiptItemType::POSITIVE,
            "Coca Cola 0.25l",
            1.29,
            20.00,
            new QuantityDto(2, "ks"),
            2.58
        );

        $payment = new ReceiptRegistrationPaymentDto(2.58, "Hotovosť");

        $receiptRegistrationRequest = new Receipts\CreateReceiptRegistrationRequestDto(
            ReceiptType::CASH_REGISTER,
            $cashRegisterCode,
            $externalId,
            [$item],
            [$payment]
        );

        $receiptRegistrationRequest->headerText = "www.ninedigit.sk";
        $receiptRegistrationRequest->footerText = "Ďakujeme za váš nákup.";

        $validityTimeSpan = 1;

        $createReceiptRegistration = new CreateReceiptRegistrationDto(
            $receiptPrinter, $receiptRegistrationRequest, $validityTimeSpan);

        $receiptRegistration = $apiClient->registerReceipt($createReceiptRegistration);

        $this->assertNotEquals(RegistrationState::FAILED, $receiptRegistration->state);
    }

    public function testRegisterReceiptUsingPosPrinterWithNonEmptyOptions() {
        $settings = $this->getProductionDemoAccountSettings();
        $apiClient = new ApiClient($settings->apiClientOptions);

        $posPrinterOptions = new PosReceiptPrinterOptions();
        $posPrinterOptions->openDrawer = true;
        $receiptPrinter = new PosReceiptPrinterDto($posPrinterOptions);

        // $receiptPrinter = new PdfReceiptPrinterDto($pdfPrinterOptions);

        // $emailPrinterOptions = new EmailReceiptPrinterOptions("mail@example.com");
        // $emailPrinterOptions->subject = "Váš elektronický doklad";
        // $receiptPrinter = new EmailReceiptPrinterDto($emailPrinterOptions);

        $cashRegisterCode = $settings->cashRegisterCode;
        $externalId = "e52ff4d1-f2ed-4493-9e9a-a73739b1ba23";

        $item = new ReceiptRegistrationItemDto(
            ReceiptItemType::POSITIVE,
            "Coca Cola 0.25l",
            1.29,
            20.00,
            new QuantityDto(2, "ks"),
            2.58
        );

        $payment = new ReceiptRegistrationPaymentDto(2.58, "Hotovosť");

        $receiptRegistrationRequest = new Receipts\CreateReceiptRegistrationRequestDto(
            ReceiptType::CASH_REGISTER,
            $cashRegisterCode,
            $externalId,
            [$item],
            [$payment]
        );

        $receiptRegistrationRequest->headerText = "www.ninedigit.sk";
        $receiptRegistrationRequest->footerText = "Ďakujeme za váš nákup.";

        $validityTimeSpan = 0;

        $createReceiptRegistration = new CreateReceiptRegistrationDto(
            $receiptPrinter, $receiptRegistrationRequest, $validityTimeSpan);

        $receiptRegistration = $apiClient->registerReceipt($createReceiptRegistration);

        $this->assertNotEquals(RegistrationState::FAILED, $receiptRegistration->state);
    }

    public function testRegisterReceiptUsingEmailPrinter() {
        $settings = $this->getProductionDemoAccountSettings();
        $apiClient = new ApiClient($settings->apiClientOptions);

        $emailPrinterOptions = new EmailReceiptPrinterOptions("mail@example.com");
        $emailPrinterOptions->subject = "Váš elektronický doklad";
        $receiptPrinter = new EmailReceiptPrinterDto($emailPrinterOptions);

        $cashRegisterCode = $settings->cashRegisterCode;
        $externalId = "e52ff4d1-f2ed-4493-9e9a-a73739b1ba23";

        $item = new ReceiptRegistrationItemDto(
            ReceiptItemType::POSITIVE,
            "Coca Cola 0.25l",
            1.29,
            20.00,
            new QuantityDto(2, "ks"),
            2.58
        );

        $payment = new ReceiptRegistrationPaymentDto(2.58, "Hotovosť");

        $receiptRegistrationRequest = new Receipts\CreateReceiptRegistrationRequestDto(
            ReceiptType::CASH_REGISTER,
            $cashRegisterCode,
            $externalId,
            [$item],
            [$payment]
        );

        $receiptRegistrationRequest->headerText = "www.ninedigit.sk";
        $receiptRegistrationRequest->footerText = "Ďakujeme za váš nákup.";

        $validityTimeSpan = 1;

        $createReceiptRegistration = new CreateReceiptRegistrationDto(
            $receiptPrinter, $receiptRegistrationRequest, $validityTimeSpan);

        $receiptRegistration = $apiClient->registerReceipt($createReceiptRegistration);

        $this->assertNotEquals(RegistrationState::FAILED, $receiptRegistration->state);
    }

    public function testRegisterReceiptUsingPdfPrinter() {
        $settings = $this->getProductionDemoAccountSettings();
        $apiClient = new ApiClient($settings->apiClientOptions);

        $pdfPrinterOptions = new PdfReceiptPrinterOptions();
        $receiptPrinter = new PdfReceiptPrinterDto($pdfPrinterOptions);

        $cashRegisterCode = $settings->cashRegisterCode;
        $externalId = "e52ff4d1-f2ed-4493-9e9a-a73739b1ba23";

        $item = new ReceiptRegistrationItemDto(
            ReceiptItemType::POSITIVE,
            "Coca Cola 0.25l",
            1.29,
            20.00,
            new QuantityDto(2, "ks"),
            2.58
        );

        $payment = new ReceiptRegistrationPaymentDto(2.58, "Hotovosť");

        $receiptRegistrationRequest = new Receipts\CreateReceiptRegistrationRequestDto(
            ReceiptType::CASH_REGISTER,
            $cashRegisterCode,
            $externalId,
            [$item],
            [$payment]
        );

        $receiptRegistrationRequest->headerText = "www.ninedigit.sk";
        $receiptRegistrationRequest->footerText = "Ďakujeme za váš nákup.";

        $validityTimeSpan = 1;

        $createReceiptRegistration = new CreateReceiptRegistrationDto(
            $receiptPrinter, $receiptRegistrationRequest, $validityTimeSpan);

        $receiptRegistration = $apiClient->registerReceipt($createReceiptRegistration);

        $this->assertNotEquals(RegistrationState::FAILED, $receiptRegistration->state);
    }
}

?>