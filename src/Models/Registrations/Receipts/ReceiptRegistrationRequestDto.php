<?php

namespace NineDigit\eKasa\Cloud\Client\Models\Registrations\Receipts;
use NineDigit\eKasa\Cloud\Client\Models;
use NineDigit\eKasa\Cloud\Client\Models\Registrations\EKasaErrorDto;

final class ReceiptRegistrationRequestDto {
    /**
     * Externý unikátny identifikátor požiadavky.
     */
    public string $externalId;
    /**
     * Kód on-line registračnej pokladne.
     * @example 88812345678900001
     */
    public string $cashRegisterCode;
    /**
     * Typ pokladničného dokladu.
     * @see ReceiptType
     * @example CashRegister
     */
    public string $receiptType;
    /**
     * Dátum a čas vyhotovenia dokladu alebo paragónu podnikateľom.
     * V prípade paragónu je to dátum a čas vyhotovenia paragónu.
     * Vo väčšine prípadov je tento dátum rovnaký ako dátum vytvorenia 
     * dokladu v ORP.
     */
    public ?\DateTime $issueDate;
    /**
     * Dátum a čas vytvorenia dokladu v ORP.
     * V prípade evidovania paragónu v ORP sa očakáva tento dátum neskorší 
     * ako dátum vyhotovenia paragónu.
     */
    public ?\DateTime $orpCreateDate;
    /**
     * Poradové číslo dokladu.
     * Pri požiadavke aj odpovedi k registrácií dokladu nadobúda rovnakú 
     * hodnotu.
     */
    public ?int $receiptNumber;
    /**
     * Poradové číslo faktúry, ak ide o úhradu faktúry alebo jej časti.
     */
    public ?string $invoiceNumber;
    /**
     * Príznak, či ide o zaevidovanie paragónu do ORP.
     */
    public bool $paragon;
    /**
     * Poradové číslo paragónu.
     */
    public ?int $paragonNumber;
    /**
     * Daňové identifikačné číslo.
     */
    public ?string $dic;
    /**
     * Identifikačné číslo pre daň z pridanej hodnoty, ak podnikateľ 
     * je platiteľom dane z pridanej hodnoty.
     */
    public ?string $icDph;
    /**
     * Identifikačné číslo organizácie podnikateľa.
     */
    public ?string $ico;
    /**
     * Celková suma dokladu.
     */
    public ?float $amount;
    /**
     * Identifikácia kupujúceho.
     */
    public ?Models\CustomerDto $customer;
    /**
     * Celková suma DPH pre základnú sadzbu dane podľa zákona 
     * č. 222/2004 Z.z.
     */
    public ?float $basicVatAmount;
    /**
     * Celková suma DPH pre zníženú sadzbu dane podľa zákona 
     * č. 222/2004 Z.z.
     */
    public ?float $reducedVatAmount;
    /**
     * Celková suma oslobodená od DPH.
     */
    public ?float $taxFreeAmount;
    /**
     * Celková suma základu DPH pre základnú sadzbu dane podľa 
     * zákona č. 222/2004 Z.z.
     */
    public ?float $taxBaseBasic;
    /**
     * Celková suma základu DPH pre zníženú sadzbu dane podľa 
     * zákona č. 222/2004 Z.z.
     */
    public ?float $taxBaseReduced;
    /**
     * Položky dokladu.
     * @var ?ReceiptRegistrationItemDto[]
     */
    public ?array $items;
    /**
     * Platidlá.
     * @var ?ReceiptRegistrationPaymentDto[]
     */
    public ?array $payments;
    /**
     * Overovací kód podnikateľa.
     */
    public ?string $okp;
    /**
     * Podpisový kód podnikateľa.
     */
    public ?string $pkp;
    
    /**
     * Textová hlavička dokladu.
     */
    public ?string $headerText;
    /**
     * Textová pätička dokladu.
     */
    public ?string $footerText;
    /**
     * Unikátný identifikátor požiadavky.
     * @example e52ff4d1-f2ed-4493-9e9a-a73739b1ba23
     */
    public ?string $requestId;
    /**
     * Dátum a čas odoslania požiadavky e-kasa klientom.
     * Pri opakovaných pokusoch o odoslanie môže byť neskorší,
     * ako dátum vytvorenia dátovej správy.
     */
    public ?\DateTime $requestDate;
    /**
     * Poradové číslo pokusu o odoslanie požiadavky do systému e-Kasa.
     */
    public ?int $sendingCount;
    /**
     * Unikátny identifikátor dokladu priradený systémom e-Kasa.
     * @example O-7DBCDA8A56EE426DBCDA8A56EE426D1A
     */
    public ?string $receiptId;
    /**
     * Dátum a čas, kedy bola požiadavka úspešne spracovaná on-line 
     * systémom e-Kasa.
     */
    public ?\DateTime $orpProcessDate;
    /**
     * Chybová správa zo systému e-Kasa.
     */
    public ?EKasaErrorDto $eKasaError;
}

?>