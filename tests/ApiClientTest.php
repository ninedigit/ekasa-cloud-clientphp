<?php

namespace NineDigit\eKasa\Cloud\Client;

use PHPUnit\Framework\TestCase;
use NineDigit\eKasa\Cloud\Client\Models\Customers\CustomerDto;
use NineDigit\eKasa\Cloud\Client\Models\Customers\CustomerFilterDto;
use NineDigit\eKasa\Cloud\Client\Models\Customers\GetCustomerListResultDto;


final class ApiClientTest extends TestCase {
    public function testCreateInstanceFromInvalidArgumentThrowsInvalidArgumentException() {
        $this->expectException(\InvalidArgumentException::class);
        $apiClient = new ApiClient("...");
    }

    public function testCreateInstanceFromOptions() {
        $publicKey = "1234567890";
        $privateKey = "98765432109876543210";
        $apiClientOptions = new ApiClientOptions($publicKey, $privateKey);
        $throws = false;

        try {
            $apiClient = new ApiClient($apiClientOptions);
        } catch (Exception | Error) {
            $throws = true;
        }

        $this->assertFalse($throws);
    }

    public function testGetCustomersCreatesValidApiRequest() {
        $httpClient = new HttpClientMock(
            receiveCallback: function ($r, $t, $s) {
                $this->assertInstanceOf(ApiRequest::class, $r);
                $this->assertEquals(HttpMethod::GET, $r->method);
                $this->assertEquals("/v1/customers?ids=%231&ids=%232&ids=%233&externalId=%234&modifiedAfter=2021-07-09T12%3A42%3A48.540872Z&isActive=true&cardId=%235&cardSerialNumbers=%236&cardSerialNumbers=%237&cardSerialNumbers=%238", $r->url);
                $this->assertIsArray($r->headers);
                $this->assertCount(0, $r->headers);
                $this->assertNull($r->payload);
                $this->assertEquals(GetCustomerListResultDto::class, $t);
                $this->assertTrue($s);
                
                return new GetCustomerListResultDto();
            }
        );

        $apiClient = new ApiClient($httpClient);

        $customerFilter = (new CustomerFilterDto())
            ->setIds(array("#1", "#2", "#3"))
            ->setExternalId("#4")
            ->setModifiedAfter(DateTimeHelper::createUtc(2021, 7, 9, 12, 42, 48, 540872))
            ->setIsActive(true)
            ->setCardId("#5")
            ->setCardSerialNumbers(array("#6", "#7", "#8"));

        $apiClient->getCustomers($customerFilter);
    }
}

?>