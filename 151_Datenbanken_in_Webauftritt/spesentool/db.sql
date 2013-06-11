delimiter $$

CREATE TABLE `gibb_mitarbeiter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` text NOT NULL,
  `Vorname` text NOT NULL,
  `Funktion` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8$$

delimiter $$

CREATE TABLE `gibb_spesenart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin$$

SELECT * FROM gibb.gibb_mitarbeiter;

delimiter $$

CREATE TABLE `gibb_spesen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mitarbeiterId` int(11) NOT NULL,
  `spesenArt` int(11) NOT NULL,
  `betrag` float NOT NULL,
  `waehrungskurs` float NOT NULL,
  `datumAbrechnung` date NOT NULL,
  `datumGenehmigung` date NOT NULL,
  `genehmigtDurch` int(11) NOT NULL,
  `datumAuszahlung` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `mitarbeiterId` (`mitarbeiterId`,`genehmigtDurch`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8$$


delimiter $$

CREATE TABLE `gibb_spesenart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin$$


delimiter $$

CREATE TABLE `gibb_waehrungskurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` text COLLATE utf8_bin NOT NULL,
  `waehrungskurs` float NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `date` (`date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='not yet in use'$$


