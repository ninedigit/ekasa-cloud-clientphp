<?php

namespace NineDigit\eKasa\Cloud\Client;

use PHPUnit\Framework\TestCase;
use NineDigit\eKasa\Cloud\Client\ApiClientOptions;
use NineDigit\eKasa\Cloud\Client\Exceptions\ApiException;
use NineDigit\eKasa\Cloud\Client\Models\Customers\CustomerDto;
use NineDigit\eKasa\Cloud\Client\Models\Customers\CustomerFilterDto;
use NineDigit\eKasa\Cloud\Client\Models\Customers\GetCustomerListResultDto;


final class ApiClientIntegrationTest extends TestCase {
    
    private function getProductionDemoAccountOptions() {
        return ApiClientOptions::load(dirname(__FILE__) . '/ApiClientOptions.json');
    }

    public function testGetCustomersWithFilter() {
        $apiClientOptions = $this->getProductionDemoAccountOptions();
        $apiClient = new ApiClient($apiClientOptions);

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
        $apiClientOptions = $this->getProductionDemoAccountOptions();
        $apiClient = new ApiClient($apiClientOptions);
        $customerId = "3a0537ea-cfb2-2b4b-d521-02db003b276c";

        $customer = $apiClient->getCustomer($customerId);

        $this->assertInstanceOf(CustomerDto::class, $customer);
    }

    public function testFindCustomer() {
        $apiClientOptions = $this->getProductionDemoAccountOptions();
        $apiClient = new ApiClient($apiClientOptions);
        $customerId = "3a0537ea-cfb2-2b4b-d521-02db003b276c";

        $customer = $apiClient->getCustomer($customerId);

        $this->assertInstanceOf(CustomerDto::class, $customer);
    }

    public function testGetNonExistingCustomer() {
        $apiClientOptions = $this->getProductionDemoAccountOptions();
        $apiClient = new ApiClient($apiClientOptions);

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
        $apiClientOptions = $this->getProductionDemoAccountOptions();
        $apiClient = new ApiClient($apiClientOptions);
        $customerId = "00000000-0000-0000-0000-000000000000";

        $customer = $apiClient->findCustomer($customerId);

        $this->assertNull($customer);
    }
}

?>