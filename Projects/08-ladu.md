# 08. Ladu

## Projekti ülesanne aines Võrgurakendused I

### Ülesande kirjeldus

Ülesandeks on luua lihtne laosüsteem, kus registreeritud kasutajad saavad lisada uusi kirjeid ning muuta olemasolevate kirjete kogust

### Lisatingimused

  * Kasutaja saab registreerida endale uue konto
  * Kasutaja saab end sisse logida

### Lahendus

  * Registreeritud kasutaja saab näha kõiki laos olevaid esemeid ühe nimekirjana
  * Kirje taga asub koguse muutmise vorm, kus vaikimisi väärtuseks on viimati salvestatud kogus

### Märkused

Andmebaasis võiks olla järgmised tabelid:

  1. Kasutajate tabel: `kasutaja_id`, `kasutajanimi`, `parool`
  1. Esemete tabel: `eseme_id`, `eseme_nimi`, `kogus`

### Näide

#### 1. Esemete nimekiri

| Ese | Kogus | |
|----|-----|----|----|
| Külmkapp | 5 | [ 5  ] [Muuda kogust] |
| Pesumasin | 8 | [ 8  ] [Muuda kogust] |
| Pesumasin | 3 | [ 3  ] [Muuda kogust] |

**Uue eseme lisamise vorm**

[ Uuem külmkapp  ] [ 8  ] [Lisa uus kirje]

#### 3. Muutmise ebaõnnestumine

```
Muutmine ebaõnnestus: uus kogus peab olema positiivne number või null
[tagasi laoseisu lehele]
```
