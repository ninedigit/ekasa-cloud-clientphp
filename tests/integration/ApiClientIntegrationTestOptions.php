<?php

namespace NineDigit\eKasa\Cloud\Client\Tests\Integration;

use NineDigit\eKasa\Cloud\Client\ApiClientOptions;


function tryGetValue($array, $key) {
    return (array_key_exists($key, $array)) ? $array[$key] : NULL;
}

final class ApiClientIntegrationTestOptions {
    public ApiClientOptions $apiClientOptions;
    public string $cashRegisterCode;
    public int $validityTimeSpan;
    
    static function load(string $fileName): ApiClientIntegrationTestOptions {
        $contents = file_get_contents($fileName);
        $data = json_decode($contents, true, 512, JSON_THROW_ON_ERROR);

        $options = new ApiClientIntegrationTestOptions();
        $options->apiClientOptions = ApiClientOptions::load($data);

        $cashRegisterCode = tryGetValue($data, 'cashRegisterCode');
        $validityTimeSpan = tryGetValue($data, 'validityTimeSpan');

        if (!is_string($cashRegisterCode) || strlen($cashRegisterCode) === 0) {
            $cashRegisterCode = "88812345678900001";
        }

        if (!is_int($validityTimeSpan)) {
            $validityTimeSpan = 10000;
        }
        
        $options->cashRegisterCode = $cashRegisterCode;
        $options->validityTimeSpan = $validityTimeSpan;

        return $options;
    }
}

?>