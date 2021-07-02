<?php

namespace NineDigit\eKasa\Cloud\ApiClient\Authentication;
use NineDigit\eKasa\Cloud\ApiClient\ApiRequestMessage;

interface IApiRequestMessageSigner {
    public function sign(ApiRequestMessage $message);
}

?>