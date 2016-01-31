# 14. Sotsiaalvõrgustik

## Projekti ülesanne aines Võrgurakendused I

### Ülesande kirjeldus

Ülesandeks on luua lihtne sotsiaalvõrgustik, kus registreeritud kasutajad saavad märkida teisi kasutajaid enda sõpradeks. Kasutaja sõbralisti ilmuvad sõbrad siis, kui mõlemad on üksteist sõbraks märkinud

### Lisatingimused

  * Kasutaja saab registreerida endale uue konto
  * Kasutaja saab end sisse logida

### Lahendus

  * Registreeritud kasutaja saab vaatada kõikide kasutajate nimekirja
  * Kasutajanimel klikkides avaneb kasutaja profiil kasutaja andmetega ja sõbralistiga
  * Kasutaja profiili juures on nupp "lisa sõbraks"
  * Lihtsamas variandis ilmuvad kasutaja sõbralistis need kasutajad, keda ta on ise sõbraks märkinud
  * Keerulisemas variandis ilmuvad kasutajad üksteise sõbralistis, kui on mõlemad üksteist sõbraks märkinud

Võib teha nii lihtsamalt kui ka keerulisemalt.

### Märkused

Andmebaasis võiks olla järgmised tabelid:

  1. Kasutajate tabel: `kasutaja_id`, `kasutajanimi`, `parool`
  1. Sõprade tabel: `sõpruse_id`, `märkiva_kasutaja_id`, `märgitava_kasutaja_id`

```SQL
SELECT FROM sõbrad WHERE märkiva_kasutaja_id = $märgitud_kasutaja_id AND
    märgitava_kasutaja_id = $sisseloginud_kasutaja_id AND kas_meeldib = 1
```

### Näide

#### 1. Kasutajate nimekiri

|  Kasutajanimi |  |
|--- | --- |
| **peeter** | [Vaata profiili](.) |
| **maarika** | [Vaata profiili](.) |
| **juulius** | [Vaata profiili](.) |

#### 2. Kasutaja profiili vaade

|  * |  |
|--- | --- |
| Kasutaja nimi | **peeter** |

**Märgi sõbraks:**
```
[märgi kasutaja oma sõbraks]
```

|  Sõbralist |  |
|--- | --- |
| **maarika** | [Vaata profiili](.) |
| **juulius** | [Vaata profiili](.) |
