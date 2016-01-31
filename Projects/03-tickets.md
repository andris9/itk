# 03. Piletite broneerimine

## Projekti ülesanne aines Võrgurakendused I

### Ülesande kirjeldus

Ülesandeks on luua lihtne piletite broneerimise süsteem, kus registreeritud kasutaja saab vaadata olemasolevaid etendusi ning broneerida pileteid

### Lisatingimused

  * Kasutaja saab registreerida endale uue konto
  * Kasutaja saab end sisse logida
  * Etendused sisestatakse otse andmebaasi, selle jaoks ei ole liidest vaja

### Lahendus

  * Registreeritud kasutaja saab näha kõiki etendusi ühe nimekirjana
  * Etenduse kirjel klikkides avaneb ruumi detailvaade
  * Detailvaates näeb etenduse kirjeldust ja piletiostjate nimekirja (kasutajanimi, piletite arv)
  * Samas on ka broneeringu tegemise vorm: tekstilahter soovitud piletite arvuga ning nupp broneeringu kinnitamiseks. Broneering kinnitatakse kui etendus ei ole juba läbi
  * Etenduste nimekirjas võiks näidata ka broneeritud piletite arvu

### Märkused

Andmebaasis võiks olla järgmised tabelid:

  1. Kasutajate tabel: `kasutaja_id`, `kasutajanimi`, `parool`
  1. Etenduste tabel: `etenduse_id`, `etenduse_nimi`, `etenduse_algus` (siia tabelisse võib lisada andmed käsitsi)
  1. Broneeringute tabel: `bronni_id`, `etenduse_id`, `kasutaja_id`, `piletite_hulk`

### Näide

#### 1. Etenduste nimekiri

| Etenduse nimetus | Etenduse aeg | Broneeritud pileteid | |
|----|----|----|----|
| Othello | 2016-03-12 17:00 | 45 | [Broneerima...](.) |
| Pähklipureja | 2016-04-06 18:00 | 23 | [Broneerima...](.) |
| Sevilla Habemeajaja | 2016-05-22 17:30 | 127 | [Broneerima...](.) |

#### 2. Etenduse detailvaade

|  * |  |
|--- | --- |
| Etenduse nimetus | **Othello** |
| Etenduse aeg | **2016-03-12 17:00** |

**Lisa oma broneering:**
```
[ 1  ] [broneeri piletid]
```

**Olemasolevad broneeringud:**

| Kasutaja | Piletite arv |
|----| ----|
| juulius | 6 |
| maarika | 24 |
| peeter | 15 |

#### 3. Broneeringu ebaõnnestumine

```
Broneerimine ebaõnnestus: valitud ajal on etendus juba läbi
[tagasi etenduse lehele]
```
