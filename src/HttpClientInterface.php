<?php

namespace NineDigit\eKasa\Cloud\Client;

interface HttpClientInterface {
    public function send(ApiRequest $request, $sign = false): void;
    public function receive(ApiRequest $request, $type, $sign = false): mixed;
}

?>
