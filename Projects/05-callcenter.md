# 05. Kõnekeskus

## Projekti ülesanne aines Võrgurakendused I

### Ülesande kirjeldus

Ülesandeks on luua lihtne probleemide haldamise süsteem, kus registreeritud kasutaja ehk kõnekeskuse töötaja, saab vaadata olemasolevaid probleeme ning sisestada uusi helistajatelt laekunud probleeme. Samuti saab märkida probleeme lahendatuks.

### Lisatingimused

  * Kasutaja saab registreerida endale uue konto
  * Kasutaja saab end sisse logida

### Lahendus

  * Registreeritud kasutaja saab näha kõiki probleeme ühe nimekirjana
  * Probleemi kirje taga on nupp "märgi lahendatuks"
  * Kasutaja saab filtreerida probleeme: kõik (vaikimisi), lahendamata, lahendatud

### Märkused

Andmebaasis võiks olla järgmised tabelid:

  1. Kasutajate tabel: `kasutaja_id`, `kasutajanimi`, `parool`
  1. Probleemide tabel: `probleemi_id`, `probleemi_kirjeldus`, `kas_on_lahendatud`

### Näide

#### 1. Probleemide nimekiri

**Filtreeri:**

  - [x] kõik probleemid
  - [ ] lahendamata probleemid
  - [ ] lahendatud probleemid

| Probleemi kirjeldus | |
|----|----|
| Kliendi modem ei tööta | [Märgi lahendatuks](.) |
| Klient tahab lepingut lõpetada | [Märgi lahendatuks](.) |
| Klient nõuab odavamat teenustasu | [Märgi lahendatuks](.) |

> Filtreerimist saab teha täiendava WHERE tingimusega. Näiteks kui lahendatud väärtus on `1` ning lahendamata on `0`, siis võib päring olla järgmine: `SELECT ... WHERE kas_on_lahendatud=1`
