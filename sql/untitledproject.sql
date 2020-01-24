-- Adminer 4.7.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `chat`;
CREATE TABLE `chat` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `message` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `device` varchar(20) NOT NULL DEFAULT '0',
  `IP` varchar(45) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `items`;
CREATE TABLE `items` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `category` int(11) NOT NULL DEFAULT '0',
  `itemname` varchar(50) NOT NULL DEFAULT 'ERR_NO_NAME',
  `itemdesc` varchar(500) NOT NULL DEFAULT 'ERR_NO_DESC',
  `statstype` varchar(7) NOT NULL DEFAULT 'mmaaaaa',
  `sHP` smallint(6) NOT NULL DEFAULT '100',
  `sMP` smallint(6) NOT NULL DEFAULT '100',
  `attack` smallint(6) NOT NULL DEFAULT '0',
  `defense` smallint(6) NOT NULL DEFAULT '0',
  `speed` smallint(6) NOT NULL DEFAULT '0',
  `intelligence` smallint(6) NOT NULL DEFAULT '0',
  `luck` smallint(6) NOT NULL DEFAULT '0',
  `coins` int(11) NOT NULL DEFAULT '0',
  `stars` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `items` (`ID`, `category`, `itemname`, `itemdesc`, `statstype`, `sHP`, `sMP`, `attack`, `defense`, `speed`, `intelligence`, `luck`, `coins`, `stars`) VALUES
(1,	1,	'Nothing',	'Are you seriously going to use your fist?',	'mmaaaaa',	100,	100,	0,	0,	0,	0,	0,	0,	0),
(2,	1,	'Generic Sword',	'Generic sword for a generic player.',	'maaaaaa',	90,	0,	15,	8,	0,	0,	0,	50,	0);

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `nickname` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `password` varchar(50) NOT NULL,
  `powerlevel` int(1) NOT NULL DEFAULT '1',
  `lastview` int(11) NOT NULL,
  `country` varchar(2) NOT NULL DEFAULT '??',
  `bantime` int(11) NOT NULL,
  `coins` double NOT NULL DEFAULT '100',
  `stars` bigint(20) NOT NULL DEFAULT '25',
  `HP` int(11) NOT NULL DEFAULT '25',
  `HPmax` int(11) NOT NULL DEFAULT '25',
  `MP` int(11) NOT NULL DEFAULT '10',
  `MPmax` int(11) NOT NULL DEFAULT '10',
  `attack` int(11) NOT NULL DEFAULT '50',
  `defense` int(11) NOT NULL DEFAULT '50',
  `speed` int(11) NOT NULL DEFAULT '50',
  `intelligence` int(11) NOT NULL DEFAULT '50',
  `luck` int(11) NOT NULL DEFAULT '50',
  `coinsperhour` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- 2020-01-23 17:41:05
