<?php

namespace NineDigit\eKasa\Cloud\Client\Tests;

use PHPUnit\Framework\TestCase;
use NineDigit\eKasa\Cloud\Client\ApiRequestBuilder;

final class ApiRequestBuilderTest extends TestCase {
    public function testBuildOfCreateGetCreatesCorrectRequest() {
        $url = "example.com/resource";
        $headers = array(
            "Accept" => "application/json"
        );

        $request = ApiRequestBuilder::createGet($url, $headers)->build();

        $this->assertEquals("GET", $request->method);
        $this->assertEquals($url, $request->url);
        $this->assertEquals($headers, $request->headers);
    }

    public function testBuildOfCreatePostCreatesCorrectRequest() {
        $url = "example.com/resource";
        $headers = array(
            "Accept" => "application/json"
        );

        $request = ApiRequestBuilder::createPost($url, $headers)->build();

        $this->assertEquals("POST", $request->method);
        $this->assertEquals($url, $request->url);
        $this->assertEquals($headers, $request->headers);
    }

    public function testBuildOfCreatePutCreatesCorrectRequest() {
        $url = "example.com/resource";
        $headers = array(
            "Accept" => "application/json"
        );

        $request = ApiRequestBuilder::createPut($url, $headers)->build();

        $this->assertEquals("PUT", $request->method);
        $this->assertEquals($url, $request->url);
        $this->assertEquals($headers, $request->headers);
    }

    public function testBuildOfCreateDeleteCreatesCorrectRequest() {
        $url = "example.com/resource";
        $headers = array(
            "Accept" => "application/json"
        );

        $request = ApiRequestBuilder::createDelete($url, $headers)->build();

        $this->assertEquals("DELETE", $request->method);
        $this->assertEquals($url, $request->url);
        $this->assertEquals($headers, $request->headers);
    }

    public function testBuildOfCreatePostWithDefaultHeadersAndPayloadCreatesCorrectRequest() {
        $url = "example.com/resource";
        $payload = new \stdClass();

        $headers = array(
            "Content-Type" => "application/json",
            "Accept" => "application/xml"
        );

        $request = ApiRequestBuilder::createPost($url, $headers)
            ->withHeaders(array(
                "Accept" => "application/json"
            ))
            ->withPayload($payload)
            ->build();

        $this->assertEquals("POST", $request->method);
        $this->assertEquals($url, $request->url);
        $this->assertEquals(array(
            "Content-Type" => "application/json",
            "Accept" => "application/json"
        ), $request->headers);
    }
}

?>