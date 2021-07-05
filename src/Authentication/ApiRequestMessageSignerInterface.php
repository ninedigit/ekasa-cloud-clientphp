<?php

namespace NineDigit\eKasa\Cloud\Client\Authentication;

use NineDigit\eKasa\Cloud\Client\ApiRequestMessage;

interface ApiRequestMessageSignerInterface {
    public function sign(ApiRequestMessage $message);
}

?>