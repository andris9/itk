# 13

## kasutajate tabel

```sql

CREATE TABLE IF NOT EXISTS `areinman__kasutajad` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Kasutajanimi` varchar(100) COLLATE utf8_estonian_ci NOT NULL,
  `Parool` varchar(100) COLLATE utf8_estonian_ci NOT NULL,
  `Lisatud` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Kasutajanimi` (`Kasutajanimi`),
  KEY `Lisatud` (`Lisatud`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_estonian_ci;
```
