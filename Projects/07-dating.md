# 07. Kohtinguportaal

## Projekti ülesanne aines Võrgurakendused I

### Ülesande kirjeldus

Ülesandeks on luua lihtne kohtinguportaal, kus registreeritud kasutajad saavad märkida teisi kasutajaid meeldivaks või mittemeeldivaks ning portaal annab teada, kui kaks kasutajat on mõlemad üksteist meeldivaks lisanud

### Lisatingimused

  * Kasutaja saab registreerida endale uue konto
  * Kasutaja saab end sisse logida

### Lahendus

  * Registreeritud kasutaja saab näha ükshaaval teiste kasutajate profiile
  * Kasutaja profiili juures on nupud "meeldib" ja "ei meeldi"
  * Valitud nupul klikkides näitab:
    * juhul kui valija klikib "meeldib" ning valitud kasutaja on valija varem meeldivaks märkinud, näidatakse teadet et leiti positiivne match
    * kõikidel muudel juhtudel kuvatakse järgmine profiil

Kasutajate profiile võib näidata juhusliku valiku alusel

```SQL
    SELECT * FROM kasutajad WHERE kasutaja_id <> $sisseloginud_kasutaja_id ORDER BY RAND() LIMIT 1
```

### Märkused

Andmebaasis võiks olla järgmised tabelid:

  1. Kasutajate tabel: `kasutaja_id`, `kasutajanimi`, `parool`
  1. Valikute tabel: `valiku_id`, `valija_kasutaja_id`, `märgitava_kasutaja_id`, `kas_meeldib`

> Valiku tegemisel tuleks kõigepealt lisada valiku kirje baasi ja kui valik oli "meeldib", siis otsida baasist vastaskirjet

```SQL
SELECT FROM valikud WHERE valija_kasutaja_id = $märgitud_kasutaja_id AND
    märgitava_kasutaja_id = $sisseloginud_kasutaja_id AND kas_meeldib = 1
```

### Näide

#### 1. Kasutaja profiili vaade

|  * |  |
|--- | --- |
| Kasutaja nimi | **peeter** |

**Tee oma valik:**
```
[meeldib]  [ei meeldi]
```

#### 2. Leiti sobivus

```
Leiti sobiv vaste! Kasutaja **peeter** märkis sind meeldivaks.
[järgmise profiili juurde]
```
