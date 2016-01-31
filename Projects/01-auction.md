# 01. Veebioksjon

## Projekti ülesanne aines Võrgurakendused I

### Ülesande kirjeldus

Ülesandeks on luua lihtne veebioksjoni keskkond, kus registreeritud kasutajad saavad teha oksjonil olevate kaupade ostuks pakkumisi kuni oksjoni lõppemiseni

### Lisatingimused

  * Kasutaja saab registreerida endale uue konto
  * Kasutaja saab end sisse logida
  * Oksjonil olevad kaubad sisestatakse otse andmebaasi, selle jaoks ei ole liidest vaja

### Lahendus

  * Registreeritud kasutaja saab näha kõiki oksjoneid ühe nimekirjana, sh. ka juba lõppenud oksjoneid
  * Oksjoni kirjel klikkides avaneb oksjoni detailvaade
  * Detailvaates näeb eseme kirjeldust ja sooritatud pakkumiste nimekirja (kasutajanimi, pakutud hind)
    * Aktiivse oksjoni puhul on samas ka pakkumise tegemise vorm: tekstilahter pakkumise hinnaga ja nupp pakkumise kinnitamiseks. Pakkumine võetakse vastu kui oksjon pole läbi ning pakutud summa on suurem, kui viimane pakkumine
    * Lõppenud oksjoni puhul on pakkumise vormi asemel kirjas pakkumise võitja nimi ning pakutud hind

### Märkused

Andmebaasis võiks olla järgmised tabelid:

  1. Kasutajate tabel: `kasutaja_id`, `kasutajanimi`, `parool`
  1. Oksjonite tabel: `oksjoni_id`, `eseme_nimi`, `lõpuaeg` (siia tabelisse võib lisada andmed käsitsi)
  1. Pakkumiste tabel: `pakkumise_id`, `oksjoni_id`, `kasutaja_id`, `pakkumise_hind`, `pakkumise_aeg`

> Viimase pakkumise ning ka võitja määramise teeks lihtsamaks kui oksjoni tabelisse lisada veel väljad `viimase_pakkumise_tegija_id` ning `viimase_pakkumise_hind`, mida uuendatakse iga kord uue pakkumise lisamisel.

### Näide

#### 1. Oksjonite nimekiri

| Oksjoni nimetus | Oksjoni lõpp | Viimane pakkumine | |
|----|-----|----|----|
| Külmkapp | 2016-06-11 13:34:00 | 16.45 € | [Mine pakkuma](.) |
| Pesumasin | 2016-06-11 14:34:00 | 42.15 € | [Mine pakkuma](.) |
| Pesumasin | lõppenud | 9.99 € | [Vaata tulemust](.) |

#### 2. Oksjoni detailvaade

|  * |  |
|--- | --- |
| Oksjoni nimetus | **Külmkapp** |
| Oksjoni lõpp | **2016-06-11 13:34:00** |
| Viimane pakkumine | **16.45 €** (juulius) |

**Lisa oma pakkumine:**
```
[ 0.00  ]  [tee pakkumine]
```

**Eelmised pakkumised:**

| Pakkumine | Pakkumise tegija |
|----|-----|
| 16.45 € | juulius |
| 12.12 € | peeter |
| 9.99 € | maarika |

#### 3. Pakkumise ebaõnnestumine

```
Pakkumine ebaõnnestus: oksjon on juba läbi
[tagasi oksjoni lehele]
```
