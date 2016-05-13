# Laorakendus

Järgmised SQL tabelid on vajalikud rakenduse tööks. Lause käivitamisel MySQL baasis asenda lausetes `{PREFIX}` enda kasutajanime vms. unikaalse väärtusega, st. et lauses peaks `{PREFIX}__kaubad` asemel olema `kasutajanimi__kaubad`.

## Kaupade tabel

```SQL
CREATE TABLE IF NOT EXISTS `{PREFIX}__kaubad` (
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

## Kategooriate tabel

```SQL
CREATE TABLE IF NOT EXISTS `{PREFIX}__kategooriad` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Nimetus` varchar(100) COLLATE utf8_estonian_ci NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Nimetus` (`Nimetus`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_estonian_ci
```

## Kasutajate tabel

```SQL
CREATE TABLE IF NOT EXISTS `{PREFIX}__kasutajad` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Kasutajanimi` varchar(100) COLLATE utf8_estonian_ci NOT NULL,
  `Parool` varchar(100) COLLATE utf8_estonian_ci NOT NULL,
  `Lisatud` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Kasutajanimi` (`Kasutajanimi`),
  KEY `Lisatud` (`Lisatud`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_estonian_ci;
```
