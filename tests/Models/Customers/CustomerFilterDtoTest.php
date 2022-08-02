<?php

namespace NineDigit\eKasa\Cloud\Client;

use PHPUnit\Framework\TestCase;
use NineDigit\eKasa\Cloud\Client\DateTimeHelper;
use NineDigit\eKasa\Cloud\Client\Models\Customers\CustomerFilterDto;


final class CustomerFilterDtoTest extends TestCase {
    public function testToQueryString() {
        $now = DateTimeHelper::createUtc(2022, 8, 2, 16, 30, 19, 938000);

        $customerFilter = (new CustomerFilterDto())
            ->setIds(array("1", "2"))
            ->setExternalId("3")
            ->setIsActive(true)
            ->setModifiedAfter($now)
            ->setCardId("4")
            ->setCardSerialNumbers(array("5", "6"));

        $qs = $customerFilter->toQueryString();

        $params = explode("&", $qs);

        $this->assertCount(8, $params);
        $this->assertContains("ids=1", $params);
        $this->assertContains("ids=2", $params);
        $this->assertContains("externalId=3", $params);
        $this->assertContains("isActive=true", $params);
        $this->assertContains("modifiedAfter=2022-08-02T16%3A30%3A19.938000Z", $params);
        $this->assertContains("cardId=4", $params);
        $this->assertContains("cardSerialNumbers=5", $params);
        $this->assertContains("cardSerialNumbers=6", $params);
    }
}

?>