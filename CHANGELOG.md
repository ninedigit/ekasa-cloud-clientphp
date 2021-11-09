# Changelog

Všetky významné zmeny v projekte budú uvedené v tomto dokumente.

Formát dokumentu vychádza z [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
a dodržiava [sémantické verzionovanie](https://semver.org/spec/v2.0.0.html).

## [0.9.6] - 2021-11-09

### Pridané

- Zoznam vrátených chybových kódov z API - `ApiErrorCode`
- Pridaná vlastnosť `$code` do `ProblemDetails` nesúca chybový kód odpovede z API
- Zoznam dostupných prostredí - `CloudEnvironment`
- Test deserializácie `ProblemDetails` objektu

### Zmenené

- Konštanta `DEFAULT_URL` a vlastnosť `$tenantKey` triedy `ApiClientOptions` boli označené ako `@deprecated` a budú odstránené v nasledujúcej verzií
