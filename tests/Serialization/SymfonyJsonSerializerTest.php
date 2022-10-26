<?php

namespace NineDigit\eKasa\Cloud\Client\Serialization;

use PHPUnit\Framework\TestCase;
use NineDigit\eKasa\Cloud\Client\Models\Registrations\Receipts\PosReceiptPrinterOptions;

final class SymfonyJsonSerializerTest extends TestCase {
    public function testSerializeForEmptyPosReceiptPrinterOptions() {
        $serializer = new SymfonyJsonSerializer();
        $opts = new PosReceiptPrinterOptions();

        $json = $serializer->serialize($opts);

        $this->assertEquals("{}", $json);
    }

    public function testSerializeForNonEmptyPosReceiptPrinterOptions() {
        $serializer = new SymfonyJsonSerializer();
        $opts = new PosReceiptPrinterOptions();
        $opts->openDrawer = true;

        $json = $serializer->serialize($opts);

        $this->assertEquals("{\"openDrawer\":true}", $json);
    }

    public function testSerializeFloatNumberIncorrectlyWhenFixtureIsDisabled() {
        $x = 0.1;
        $y = 0.2;
        $cls = new \stdClass();
        $cls->value = $x + $y;
        $serializer = new SymfonyJsonSerializer();

        $json = $serializer->serialize($cls);
        
        $this->assertNotEquals("{\"value\":0.3}", $json);
    }

    public function testSerializeFloatNumberCorrectlyWhenFixtureIsEnabled() {
        $x = 0.1;
        $y = 0.2;
        $cls = new \stdClass();
        $cls->value = $x + $y;
        $serializer = new SymfonyJsonSerializer(SymfonyJsonSerializerFlags::ENABLE_SERIALIZE_PRECISION_FIXTURE);

        $json = $serializer->serialize($cls);
        
        $this->assertEquals("{\"value\":0.3}", $json);
    }
}

?>