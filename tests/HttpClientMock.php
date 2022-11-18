<?php

namespace NineDigit\eKasa\Cloud\Client\Tests;

use NineDigit\eKasa\Cloud\Client\ApiRequest;
use NineDigit\eKasa\Cloud\Client\HttpClientInterface;


final class HttpClientMock implements HttpClientInterface {
    private $sendCallback;
    private $receiveCallback;

    public function __construct(
        ?callable $sendCallback = null,
        ?callable $receiveCallback = null) {
        $this->sendCallback = $sendCallback;
        $this->receiveCallback = $receiveCallback;
    }

    public function send(ApiRequest $request, $sign = false): void {
        if (is_callable($this->sendCallback)) {
            ($this->sendCallback)($request, $sign);
        }
    }

    public function receive(ApiRequest $request, $type, $sign = false) {
        if (is_callable($this->receiveCallback)) {
            return call_user_func($this->receiveCallback, $request, $type, $sign);
        }
    }
}

?>