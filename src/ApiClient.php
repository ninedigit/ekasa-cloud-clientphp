<?php

namespace NineDigit\eKasa\Cloud\Client;

use NineDigit\eKasa\Cloud\Client\Authentication\NWS4ApiRequestMessageSigner;

use NineDigit\eKasa\Cloud\Client\Exceptions\ValidationProblemDetailsException;
use \GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;
use NineDigit\eKasa\Cloud\Client\Models\ProblemDetails;
use NineDigit\eKasa\Cloud\Client\Models\ValidationProblemDetails;
use NineDigit\eKasa\Cloud\Client\Models\Customers\CustomerDto;
use NineDigit\eKasa\Cloud\Client\Models\Customers\CustomerFilterDto;
use NineDigit\eKasa\Cloud\Client\Models\Customers\GetCustomerListResultDto;
use NineDigit\eKasa\Cloud\Client\Models\Registrations\Receipts\CreateReceiptRegistrationDto;
use NineDigit\eKasa\Cloud\Client\Models\Registrations\Receipts\ReceiptRegistrationDto;
use NineDigit\eKasa\Cloud\Client\Models\Registrations\Receipts\ReceiptRegistrationStateChangeResultDto;
use NineDigit\eKasa\Cloud\Client\Serialization\SymfonyJsonSerializer;


final class ApiClient {
  private HttpClientInterface $httpClient;

  /**
   * @param mixed $httpClientOrOptions akceptuje ApiClientOptions alebo HttpClientInterface.
   * Preťaženie s HttpClientInterface sa využíva iba na testovacie účely. Využívajte preťaženie
   * akceptujúce ApiClientOptions.
   */
  public function __construct(mixed $optionsOrClient) {
    if ($optionsOrClient instanceof ApiClientOptions) {
      $this->httpClient = new HttpClient($optionsOrClient);
    } else if (is_subclass_of($optionsOrClient, HttpClientInterface::class)) {
      $this->httpClient = $optionsOrClient;
    } else {
      throw new \InvalidArgumentException("Expecting ". ApiClientOptions::class ." or ". HttpClientInterface::class . " type as an argument.");
    }
  }

  // Registrations

  /**
   * Zadá požiadavku na zaregistrovanie dokladu.
   * @throws ValidationProblemDetailsException ak nie je požiadavka valídna
   * @throws ProblemDetailsException
   */
  public function registerReceipt(CreateReceiptRegistrationDto $receipt): ReceiptRegistrationDto {
    $apiRequest = ApiRequestBuilder::createPost("/v1/registrations/receipts", $this->defaultHttpHeaders)
      ->withPayload($receipt)
      ->build();
    
    $result = $this->httpClient->receive($apiRequest, type: ReceiptRegistrationDto::class, sign: true);

    return $result;
  }

  /**
   * Zruší zadanú požidavku na zaregistrovanie dokladu.
   * Požiadavku je možné zrušiť iba ak je v stave Created alebo Notified
   * a teda ešte pred samotným akceptovaním registračnou pokladňou.
   * @throws ProblemDetailsException
   */
  public function cancelReceipt(string $cashRegisterCode, string $externalId): ReceiptRegistrationStateChangeResultDto {
    $url = "/v1/registrations/receipts/cancel?cashRegisterCode=${cashRegisterCode}&externalId=${externalId}";
    $apiRequest = ApiRequestBuilder::createPost($url)->build();
    $result = $this->httpClient->receive($apiRequest, type: ReceiptRegistrationStateChangeResultDto::class, sign: true);

    return $result;
  }

  // Customers

  public function getCustomers(?CustomerFilterDto $filter = null): GetCustomerListResultDto {
    $url = "/v1/customers";

    if ($filter !== null) {
      $urlQuery = $filter->toQueryString();
      $url .= "?${urlQuery}";
    }

    $apiRequest = ApiRequestBuilder::createGet($url)->build();
    $result = $this->httpClient->receive($apiRequest, type: GetCustomerListResultDto::class, sign: true);

    return $result;
  }

  public function getCustomer(string $id): CustomerDto {
    $url = "/v1/customers/".urlencode($id);
    $apiRequest = ApiRequestBuilder::createGet($url)->build();
    $result = $this->httpClient->receive($apiRequest, type: CustomerDto::class, sign: true);

    return $result;
  }
}