# 12. Reklaamipindade planeerimine

## Projekti ülesanne aines Võrgurakendused I

### Ülesande kirjeldus

Ülesandeks on luua lihtne reklaampindade broneerimise süsteem, kus registreeritud kasutaja saab vaadata olemasolevaid broneeringuid ning sisestada uusi

### Lisatingimused

  * Kasutaja saab registreerida endale uue konto
  * Kasutaja saab end sisse logida
  * Reklaampinnad sisestatakse otse andmebaasi, selle jaoks ei ole liidest vaja

### Lahendus

  * Registreeritud kasutaja saab näha kõiki saadaval olevaid reklaampindu ühe nimekirjana
  * Reklaampinna kirjel klikkides avaneb pinna detailvaade
  * Detailvaates näeb pinna kirjeldust ja broneeringute nimekirja (algus, lõpp)
  * Samas on ka broneeringu tegemise vorm: tekstilahter algusajaga, tekstilahter lõpuajaga ning nupp broneeringu kinnitamiseks. Broneering kinnitatakse kui see ei kattu ühegi varasema broneeringuga

> Väljade vormingu kontroll ei ole oluline, eeldame et broneeringu ajad sisestatakse alati kindlas formaadis (n. `YYYY-MM-DD HH:mm`)

Aja võrdlemiseks võib kasutada nii vastavat SQL lauset, aga võib ka laadida baasist kõikide broneeringute andmed ja neid ükshaaval PHP skriptis soovitud aja vastu võrrelda - kui kasvõi üks aeg osaliselt kattub, siis ei saa broneeringut kinnitada.

### Märkused

Andmebaasis võiks olla järgmised tabelid:

  1. Kasutajate tabel: `kasutaja_id`, `kasutajanimi`, `parool`
  1. Ruumide tabel: `reklaampinna_id`, `reklaampinna_nimi` (siia tabelisse võib lisada andmed käsitsi)
  1. Broneeringute tabel: `bronni_id`, `reklaampinna_id`, `kasutaja_id`, `bronni_algus`, `bronni_lõpp`

> Ajaväljad võiksid olla mõnes ajaformaadis (TIMESTAMP, DATETIME vms.), sellisel juhul on lihtsam aeg võrrelda

### Näide

#### 1. Reklaampindade nimekiri

| Pinna nimetus | |
|----|----|
| Suur plakat Pärnu maantee ääres | [Broneerima...](.) |
| Väike plakatikoht supermarketi seinal | [Broneerima...](.) |
| 600x300 px bänneripind tuntud portaalis | [Broneerima...](.) |

#### 2. Reklaampinna detailvaade

|  * |  |
|--- | --- |
| Reklaampinna nimetus | **Suur plakat Pärnu maantee ääres** |

**Lisa oma broneering:**
```
[ 2016-01-01 00:00  ] – [ 2016-01-01 01:00  ]  [broneeri pind]
```

**Olemasolevad broneeringud:**

| Broneeringu algus | Broneeringu lõpp |
|----| ----|
| 2016-03-01 00:00 | 2016-03-01 01:00 |
| 2016-03-01 01:00 | 2016-03-01 02:00 |
| 2016-03-01 02:00 | 2016-03-01 03:00 |

#### 3. Broneeringu ebaõnnestumine

```
Broneerimine ebaõnnestus: valitud ajal on reklaampind juba broneeritud
[tagasi ruumide lehele]
```
