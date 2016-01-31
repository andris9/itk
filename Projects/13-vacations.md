# 13. Puhkuste planeerimine

## Projekti ülesanne aines Võrgurakendused I

### Ülesande kirjeldus

Ülesandeks on luua lihtne puhkuste broneerimise süsteem, kus registreeritud kasutaja saab vaadata olemasolevaid puhkuseid ning sisestada uusi

### Lisatingimused

  * Kasutaja saab registreerida endale uue konto
  * Kasutaja saab end sisse logida

### Lahendus

  * Registreeritud kasutaja saab näha kõiki registreeritud puhkuseid ühe nimekirjana
  * Samas on ka broneeringu tegemise vorm: tekstilahter algusajaga, tekstilahter lõpuajaga ning nupp broneeringu kinnitamiseks. Broneering kinnitatakse kui see ei kattu ühegi teise puhkusega. Samuti ei saa kasutaja kohta lisada rohkem kui 28 puhkusepäeva (ei pea olema ühes osas)

> Väljade vormingu kontroll ei ole oluline, eeldame et broneeringu ajad sisestatakse alati kindlas formaadis (n. `YYYY-MM-DD`)

Aja võrdlemiseks võib kasutada nii vastavat SQL lauset, aga võib ka laadida baasist kõikide broneeringute andmed ja neid ükshaaval PHP skriptis soovitud aja vastu võrrelda - kui kasvõi üks aeg osaliselt kattub, siis ei saa puhkuse broneeringut kinnitada. Samuti tuleb kokku lugeda kasutaja puhkusepäevade summa ja mitte lubada broneeringut kui olemasolevad päevad + soovitud päevad on rohkem kui 28

### Märkused

Andmebaasis võiks olla järgmised tabelid:

  1. Kasutajate tabel: `kasutaja_id`, `kasutajanimi`, `parool`
  1. Puhkuste tabel: `puhkuse_id`, `kasutaja_id`, `puhkuse_algus`, `puhkuse_lõpp`

> Ajaväljad võiksid olla mõnes ajaformaadis (TIMESTAMP, DATETIME vms.), sellisel juhul on lihtsam aega võrrelda

### Näide

#### 1. Puhkuste nimekiri

| Kasutajanimi | Puhkuse algus | Puhkuse lõpp |
|----|----|----|
| peeter | 2016-03-01 | 2016-03-05 |
| maarika | 2016-03-06 | 2016-03-12 |
| juulius | 2016-03-20 | 2016-03-22 |

**Lisa oma puhkus:**
```
[ 2016-01-01  ] – [ 2016-01-01  ]  [lisa puhkus]
```

#### 2. Puhkuse lisamise ebaõnnestumine

```
Broneerimine ebaõnnestus: valitud ajal on juba kellelgi puhkus
[tagasi puhkuste lehele]
```
