# MySQL andmebaas

## Kategooriate tabel

Kategooriate tabel koosneb kahest veerust

| - | Id  | Nimetus |
| ------ | ------------- | ------------- |
| Tüüp | INT  | VARCHAR(100)  |
| Atribuudid | UNSIGNED  | -  |
| Vaikimisi | -  | -  |
| Index | PRIMARY  | UNIQUE  |
| Collation | -  | utf8_estonian_ci  |
| Auto increment | Jah  | Ei  |

**SQL lause tabeli tekitamiseks**

```SQL
CREATE TABLE IF NOT EXISTS `areinman__kategooriad` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Nimetus` varchar(100) COLLATE utf8_estonian_ci NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Nimetus` (`Nimetus`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_estonian_ci
```

## Kaupade tabel

Kaupade tabel koosneb kuuest veerust

| - | Id  | Nimetus | Kogus | Kategooria | Muudetud | Lisatud |
| ------ | ------ | ------ | ------ | ------ | ------ | ------ |
| Tüüp | INT  | VARCHAR(100)  | INT | INT | TIMESTAMP | TIMESTAMP |
| Atribuudid | UNSIGNED  | -  | - | UNSIGNED | `ON UPDATE CURRENT_TIMESTAMP` | - |
| Vaikimisi | -  | -  | 0 | - | - | - |
| Index | PRIMARY  | UNIQUE  | - | INDEX | INDEX | INDEX |
| Collation | -  | utf8_estonian_ci  | - | - | - | - |
| Auto increment | Jah  | Ei  | Ei  | Ei  | Ei  | Ei  |

**SQL lause tabeli tekitamiseks**

```SQL
CREATE TABLE IF NOT EXISTS `areinman__kaubad` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Nimetus` varchar(100) COLLATE utf8_estonian_ci NOT NULL,
  `Kogus` int(11) NOT NULL DEFAULT '0',
  `Kategooria` int(10) unsigned NOT NULL,
  `Muudetud` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `Lisatud` timestamp NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Nimetus` (`Nimetus`),
  KEY `Kategooria` (`Kategooria`,`Muudetud`,`Lisatud`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_estonian_ci
```

## Andmete lisamine

**Andmete lisamine kategooriate tabelisse**

```SQL
INSERT INTO `areinman__kategooriad` (`Nimetus`) VALUES
('Kodumasinad'),
('Kontoritarbed'),
('Tööriistad')
```

**Andmete lisamine kaupade tabelisse**

```SQL
INSERT INTO `areinman__kaubad` (`Nimetus`, `Kogus`, `Kategooria`, `Lisatud`) VALUES
('Kruvikeeraja', 10, 1, NOW()),
('Külmkapp', 5, 2, NOW()),
('Pliit', 7, 2, NOW())
```

## Andmepäringud

1. Kõik read kaupade tabelist, mille kategooriaks on 2 (kodumasinad). Sorteeri `Nimetus` välja alusel.

```SQL
SELECT * FROM `areinman__kaubad` WHERE Kategooria=2 ORDER BY Nimetus ASC
```

2. Kõik kaupade tabelist, kusjuures kategooria väärtus peaks olema selle kategooria nimetus, mitte Id.

```SQL
SELECT areinman__kaubad.Id AS Id, areinman__kaubad.Nimetus AS Nimetus, areinman__kaubad.Kogus AS Kogus, areinman__kategooriad.Nimetus AS Kategooria
FROM areinman__kaubad
LEFT JOIN areinman__kategooriad ON areinman__kaubad.Kategooria = areinman__kategooriad.Id
```

> `LEFT JOIN` tabelite sidumise korral lisatakse seotav tabel (`areinman__kategooriad`) päringut teostava tabeli (`areinman__kaubad`) ridade juurde. St. et kui kategooriate tabelis on selline kirje, millele kaupade tabelis viidatud pole, siis seda kirjet tulemustes ei näidata (vastupidiselt siis `RIGHT JOIN` päringule). Kui aga kaupade tabelis viidatakse kategooriale mida pole, või kategooriat pole määratud, siis see kirje on tulemustes olemas, kuid kategooria välja väärtuseks on `NULL`.

## Andmete muutmine

1. Muuda kirjet mille Id on 2 ning sea koguseks 20

```SQL
UPDATE areinman__kaubad SET Kogus=20 WHERE Id=2
```

1. Muuda kirjet mille Id on 2 ning suurenda koguse väärtust 6 võrra

```SQL
UPDATE areinman__kaubad SET Kogus=Kogus+6 WHERE Id=2
```

## Andmete kustutamine

Kustuta kirje, mille Id=2

```SQL
DELETE FROM areinman__kaubad WHERE Id=2
```
