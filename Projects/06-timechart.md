# 06. Tööaja arvestus

## Projekti ülesanne aines Võrgurakendused I

### Ülesande kirjeldus

Ülesandeks on luua lihtne tööaja arvestuse süsteem, kus registreeritud kasutaja saab lisada tehtud töö tunde ning saab vaadata erinevate kasutajate töötundide summat

### Lisatingimused

  * Kasutaja saab registreerida endale uue konto
  * Kasutaja saab end sisse logida

### Lahendus

  * Registreeritud kasutaja saab näha kõiki registreeritud kasutajaid ühe nimekirjana
  * Nimekirjas oleva kasutaja nime taga on tehtud töötundide arv
  * Kasutaja saab lisada töötunde kindla päeva kohta

### Märkused

Andmebaasis võiks olla järgmised tabelid:

  1. Kasutajate tabel: `kasutaja_id`, `kasutajanimi`, `parool`
  1. Töötundide tabel: `tundide_id`, `kasutaja_id`, `kuupäev`, `tundide_arv`

Tundide arvu kasutaja kohta saab leida `GROUP BY` käsuga

    SELECT kasutaja_id, SUM(tundide_arv) AS tunnid_kokku FROM töötunnid GROUP BY kasutaja_id

### Näide

#### 1. Kasutajate nimekiri

| Kasutajanimi | Töötunde |
|----|----|
| juulius | 34 |
| maarika | 42 |
| peeter | 6 |

**Lisa oma töötunnid:**
```
[ 2016-01-01  ] [ 8  ]  [sisesta tundide arv]
```
