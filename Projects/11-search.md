# 11. Otsingumootor

## Projekti ülesanne aines Võrgurakendused I

### Ülesande kirjeldus

Ülesandeks on luua lihtne otsingumootor keskkond, kus registreeritud kasutajad saavad teha otsinguid eelsisestatud andmete hulgast

### Lisatingimused

  * Kasutaja saab registreerida endale uue konto
  * Kasutaja saab end sisse logida
  * Otsimisel kasutatavad kirjed võib lisada käsitsi andmebaasi, ei pea tegema eraldi liidest

### Lahendus

  * Registreeritud kasutaja saab sooritada otsinguid andmebaasist
  * Otsingu sooritamisel kuvatakse lehel otsingule vastavaid tulemusi
  * Korraga näidatakse lehel kuni 10 tulemust
  * Juhul kui otsinguvasteid on rohkem kui 10, näidatakse ka lehekülje valikut

### Märkused

Andmebaasis võiks olla järgmised tabelid:

  1. Kasutajate tabel: `kasutaja_id`, `kasutajanimi`, `parool`
  1. Andmete tabel: `kirje_id`, `kirje_sisu` (siia tabelisse võib lisada andmed käsitsi)

Nummerduse genereerimiseks tuleks kõigepealt arvutada kokku, et mitu tulemust on

```SQL
SELECT COUNT(kirje_id) AS kokku FROM kirjed WHERE kirje_sisu LIKE '%otsing%'
```

### Näide

#### 1. Otsingu leht

**Otsingu vorm**

```
[ Otsisõna  ] [Otsi]
```

| * |
|----|
| Otsisõnale vastav kirje 1 ... |
| Otsisõnale vastav kirje 2 ... |
| Otsisõnale vastav kirje 3 ... |

```
Mine lehele: 1 | 2 | 3 | 4 | 5
```
