# 09. Lennupiletite broneerimine

## Projekti ülesanne aines Võrgurakendused I

### Ülesande kirjeldus

Ülesandeks on luua lihtne lennupiletite broneerimise süsteem, kus registreeritud kasutaja saab vaadata olemasolevaid lende ning broneerida endale pileti

### Lisatingimused

  * Kasutaja saab registreerida endale uue konto
  * Kasutaja saab end sisse logida
  * Lennud sisestatakse otse andmebaasi, selle jaoks ei ole liidest vaja

### Lahendus

  * Registreeritud kasutaja saab näha kõiki lende ühe nimekirjana
  * Lennu kirjel klikkides avaneb lennu info
  * Lennu info vaates näeb teiste piletiostjate nimekirja (kasutajanimi)
  * Samas on ka broneeringu tegemise vorm: nupp broneeringu kinnitamiseks. Broneering kinnitatakse kui lend ei ole veel alanud ning on vabu kohti
  * lendude nimekirjas võiks näidata ka vabade kohtade arvu

### Märkused

Andmebaasis võiks olla järgmised tabelid:

  1. Kasutajate tabel: `kasutaja_id`, `kasutajanimi`, `parool`
  1. Lendude tabel: `lennu_id`, `lennu_nimi`, `lennu_algus`, `kohti_kokku` (siia tabelisse võib lisada andmed käsitsi)
  1. Broneeringute tabel: `bronni_id`, `lennu_id`, `kasutaja_id`

> Vabade kohtade arvu saab leida kui summeerida vastava `lennu_id` väärtusega broneeringute arvu ning lahutades selle väärtuse `kohti_kokku` väärtusest.

### Näide

#### 1. Etenduste nimekiri

| Lennu nimetus | Lennu aeg | Vabu kohti | |
|----|----|----|----|
| Tallinn - Milano | 2016-03-12 17:00 | 45 | [Broneerima...](.) |
| Tallinn - Helsinki | 2016-04-06 18:00 | 23 | [Broneerima...](.) |
| Helsinki - Milano | 2016-05-22 17:30 | 127 | [Broneerima...](.) |

#### 2. Lennu detailvaade

|  * |  |
|--- | --- |
| Lennu nimetus | **Tallinn - Milano** |
| Lennu aeg | **2016-03-12 17:00** |
| Vabu kohti | **2016-03-12 17:00** |

**Lisa oma broneering:**
```
[broneeri endale pilet]
```

**Olemasolevad broneeringud:**

| Kasutaja |
|----| ----|
| juulius |
| maarika |
| peeter |

#### 3. Broneeringu ebaõnnestumine

```
Broneerimine ebaõnnestus: kohad on juba kõik broneeritud
[tagasi etenduse lehele]
```
