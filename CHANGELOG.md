# Changelog

Všetky významné zmeny v projekte budú uvedené v tomto dokumente.

Formát dokumentu vychádza z [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
a dodržiava [sémantické verzionovanie](https://semver.org/spec/v2.0.0.html).

## [0.9.16] - 2022-12-22

### Pridané

- nová vlastnosť `userMeta` pre triedy `CustomerDto`, `CustomerCreditBalanceTransactionDto` a `CustomerCardDto`

## [0.9.15] - 2022-11-18

- Chýbajúce informácie o vydaných verziách do CHANGELOG.md

### Zmenené

- Menný priestor pre testy

## [0.9.14] - 2022-11-16

### Pridané

- Informácie o zaokrúhľovaní do README.MD
- Pole `cashRegisterCode` do konfiguračného súboru integračných testov
- Inforácie o inštalácií Composer-a
- Podpora prijatia pola hodnôt ako argumentu pre metódu `load` triedy `NineDigit\eKasa\Cloud\Client\ApiClientOptions`

### Zmenené

- Názov konfiguračného súboru pre integračné testy z `ApiClientOptions.json` na `settings.json`
- Reflektované zmeny do README.MD


## [0.9.13] - 2022-10-20

- Opravená chyba, kedy prázdny objekt bol serializovaný ako prázdne pole (`[]`).
- Opravený príklad registrácie dokladu

### Pridané

- Integračné testy pre triedu `NineDigit\eKasa\Cloud\Client\ApiClient`
- Unit testy pre JSON serializér

## [0.9.12] - 2022-10-19

- Odstránené použitie jazykových súčastí nekompatibilných s verziu PHP 7.4
- Opravená chyba (Ticket #6696) kedy vyvolanie metódy `registerReceipt` triedy `NineDigit\eKasa\Cloud\Client\ApiClient` mohlo zlyhať

### Pridané

- Unit testy pre triedu `NineDigit\eKasa\Cloud\Client\ApiRequestBuilder`

## [0.9.11] - 2022-08-03

- Odstránené použitie menných parametrov, ktoré spôsobovalo nekompatibilitu s PHP 7.4

## [0.9.10] - 2022-08-02

### Pridané

- Opravená chyba, kedy sa neprenášal parameter `cardSerialNumbers` do dopytu zákazníkov
- Vylepšenie integračného testu `testGetCustomersWithFilter` triedy `NineDigit\eKasa\Cloud\Client\ApiClientTest`
- Unit testy pre triedu `NineDigit\eKasa\Cloud\Client\CustomerFilterDto`
- Pridaná možnosť overenia kompatibility s verziou PHP 7.4
- Oprava príkladov na vyčítanie zákanika/ov

### Zmenené

- Premenovaná trieda `NineDigit\eKasa\Cloud\Client\ApiClientTest` na `NineDigit\eKasa\Cloud\Client\ApiClientIntegrationTest`

## [0.9.9] - 2022-08-02

### Pridané

- Integračné testy
- Metóda `load` do triedy `ApiClientOptions` na vyčítanie konfigurácie zo súboru

## [0.9.8] - 2022-08-02

### Pridané

- Príklady volania na získanie zákazníckych účtov
- Metóda `findCustomer` do triedy `ApiClient` na vyhľadanie zákaníckeho účtu

## [0.9.7] - 2022-06-26

### Pridané

- Metódy do triedy `ApiClient` na získanie zákazníkov
- Pridané vlastnosti `serializer` a `requestMessageSigner` pre lepšiu testovateľnosť triedy `ApiClient`
- Pridaná metóda `isSuccessStatusCode` a `ensureSuccessStatusCode` do triedy `ApiResponseMessage` na overenie/zabezpečenie kladnej odpovede zo servera
- Pridaný parameter `url` do `ApiClientOptions`
- Testy triedy `ApiClient`

### Zmenené

- Metóda `withDefaultHeaders` triedy `ApiRequestBuilder` bola premenovaná na `withHeaders` a preberá buď asociatívne pole hlavičiek alebo volateľnú metódu na nastavenie hlavičiek
- Metóda `setDefault` triedy `ApiRequestHeadersBuilder` bola premenovaná na `set`
- Interne upravená trieda `ApiClient` pre lepšiu testovateľnosť

## [0.9.6] - 2021-11-09

### Pridané

- Zoznam vrátených chybových kódov z API - `ApiErrorCode`
- Pridaná vlastnosť `$code` do `ProblemDetails` nesúca chybový kód odpovede z API
- Zoznam dostupných prostredí - `CloudEnvironment`
- Test deserializácie `ProblemDetails` objektu

### Zmenené

- Konštanta `DEFAULT_URL` a vlastnosť `$tenantKey` triedy `ApiClientOptions` boli označené ako `@deprecated` a budú odstránené v nasledujúcej verzií
