<?php

namespace NineDigit\eKasa\Cloud\ApiClient;

//use NineDigit\eKasa\Cloud\ApiClient;
use PHPUnit\Framework\TestCase;
use NineDigit\eKasa\Cloud\ApiClient\Authentication\NWS4ApiRequestMessageSigner;

class StaticDateTimeService implements IDateTimeService {
    private $dateTime;

    public function __construct(\DateTime $dateTime) {
        $this->dateTime = $dateTime;
    }

    public function getNowUtc(): \DateTime {
        return $this->dateTime;
    }
}

final class NWS4ApiRequestMessageSignerTest extends TestCase {
    const API_URL = "";
    const PUBLIC_KEY = "8248d4058e36840bea23ebbe3e602f6e";
    const PRIVATE_KEY = "388e98f5c56728266991583a6f8fcd1b9279cdc00b5c371bffc0ea402b14d954";
    const TENANT_ID = "39fd0386-1c7b-5fb0-201f-36725cbfcacc";

    public function testSignature() {
        $now = $this->createUtcDateTime(2021, 06, 24, 15, 47, 57, 213000);
        $dateTimeService = new StaticDateTimeService($now);
        $signer = new NWS4ApiRequestMessageSigner(self::PUBLIC_KEY, self::PRIVATE_KEY, $dateTimeService);
        $headers = array(
            "__tenant" => self::TENANT_ID
        );
        $requestMessage = new ApiRequestMessage("GET", "http://localhost:5000/api/v1/registrations/receipts/processable/first?cashRegisterCode=88812345678900001", $headers);
        
        $signer->sign($requestMessage);

        $this->assertSame("GET", $requestMessage->method);
        $this->assertSame("http://localhost:5000/api/v1/registrations/receipts/processable/first?cashRegisterCode=88812345678900001", $requestMessage->url);
        $this->assertSame("", $requestMessage->body);
        $this->assertCount(5, $requestMessage->headers);

        $this->arrayHasKey("__tenant", $requestMessage->headers);
        $this->assertSame(self::TENANT_ID, $requestMessage->headers["__tenant"]);

        $this->arrayHasKey("x-nd-date", $requestMessage->headers);
        $this->assertSame("2021-06-24T15:47:57.213Z", $requestMessage->headers["x-nd-date"]);

        $this->arrayHasKey("x-nd-content-sha256", $requestMessage->headers);
        $this->assertSame("e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855", $requestMessage->headers["x-nd-content-sha256"]);

        $this->arrayHasKey("host", $requestMessage->headers);
        $this->assertSame("localhost:5000", $requestMessage->headers["host"]);

        $this->arrayHasKey("Authorization", $requestMessage->headers);
        $this->assertSame("NWS4-HMAC-SHA256 Credential%3D8248d4058e36840bea23ebbe3e602f6e%2CSignedHeaders%3Dhost%253Bx-nd-content-sha256%253Bx-nd-date%253B__tenant%2CTimestamp%3D2021-06-24T15%253A47%253A57.213Z%2CSignature%3D510cfbf80d0f27e78a51a0e06407cdc6f01e2758dd6aea655fb64387cf252e6f", $requestMessage->headers["Authorization"]);
    }

    private function createUtcDateTime(int $year, int $month, int $day, int $hour, int $minute, int $second = 0, int $microsecond = 0): \DateTime {
        $date = new \DateTime("now", new \DateTimeZone("UTC"));
        $date = $date->setDate($year, $month, $day);
        $date = $date->setTime($hour, $minute, $second, $microsecond);

        return $date;
    }
}

?>