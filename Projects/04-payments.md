# 04. Internetipank

## Projekti ülesanne aines Võrgurakendused I

### Ülesande kirjeldus

Ülesandeks on luua lihtne internetipanga keskkond, kus üks kasutaja saab kanda raha oma kontolt teise kasutaja kontole

### Lisatingimused

  * Kasutaja saab registreerida endale uue konto
  * Kasutaja saab end sisse logida
  * Kontoseis määratakse registreerimisel (võib olla kõigil sama)

### Lahendus

  * Registreeritud kasutaja saab näha kõiki oma konto tehinguid ühe nimekirjana
  * Kasutaja saab algatada ja sooritada uue makse

### Märkused

Andmebaasis võiks olla järgmised tabelid:

  1. Kasutajate tabel: `kasutaja_id`, `kasutajanimi`, `parool`, `kontoseis`
  1. Tehingute tabel: `tehingu_id`, `maksja_kasutaja_id`, `saaja_kasutaja_id`, `makse_summa`

Tehingute tabelis oleva summa märk (kas pluss- või miinusmärgiga) sõltub vaatajast. Kui tehingut vaatab saaja, siis on see plussmärgiga, kui aga maksja, siis miinusmärgiga.

Iga makse tegemisel peaks arvutama ümber mõlema poole kontoseisud. Maksjalt vastav summa kontolt maha. Saajale vastav summa kontole juurde.

### Näide

#### 1. Tehingute nimekiri

|  * |  |
|--- | --- |
| Kasutajanimi | **jaanus** |
| Kontoseis | **100.45 €** |

**Soorita makse:**
```
[ peeter  ] [ 16.45  ]  [tee makse]
```

**Konto tehingud**

| Maksja | Saaja | Summa |
|----|-----|----|----|
| jaanus | maarika | -16.45 € |
| jaanus | peeter | -16.45 € |
| maarika | jaanus | +200.15 € |

#### 3. Makse ebaõnnestumine

```
Makse ebaõnnestus: kontol ei ole piisavalt vabu vahendeid
[tagasi tehingute lehele]
```
