# Changelog

Všetky významné zmeny v projekte budú uvedené v tomto dokumente.

Formát dokumentu vychádza z [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
a dodržiava [sémantické verzionovanie](https://semver.org/spec/v2.0.0.html).

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
