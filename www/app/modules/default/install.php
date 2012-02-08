<?php
db::query("INSERT INTO `".db::table('options')."` (`value`, `name`) VALUES ('{\"o\":\"11\",\"a\":\"203333\"}', 'default');");
db::query("CREATE TABLE IF NOT EXISTS `".db::table('elements')."` (
  `eID` int(11) NOT NULL AUTO_INCREMENT,
  `ePID` int(11) NOT NULL DEFAULT '0',
  `ePTree` varchar(255) NOT NULL,
  `eAID` int(11) NOT NULL DEFAULT '0',
  `eCDate` int(11) DEFAULT NULL,
  `eUDate` int(11) DEFAULT NULL,
  `ePassword` varchar(255) NOT NULL,
  `eFurl` varchar(255) NOT NULL,
  `eTags` varchar(255) NOT NULL,
  `eType` varchar(255) NOT NULL,
  `eTitle` varchar(255) NOT NULL,
  `eMDescription` varchar(255) NOT NULL,
  `eMKeywords` varchar(255) NOT NULL,
  `eCCount` bigint(20) NOT NULL DEFAULT '0',
  `eActive` tinyint(4) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `rateplus` bigint(20) NOT NULL DEFAULT '0',
  `rateminus` bigint(20) NOT NULL DEFAULT '0',
  `eNoindex` tinyint(4) NOT NULL DEFAULT '0',
  `eViews` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`eID`),
  KEY `eType` (`eType`),
  KEY `eActive` (`eActive`),
  KEY `eFurl` (`eFurl`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;");
db::query("CREATE TABLE IF NOT EXISTS `".db::table('elements_access')."` (
  `aID` int(11) NOT NULL AUTO_INCREMENT,
  `eID` int(11) NOT NULL,
  `uID` int(11) NOT NULL,
  `gID` int(11) NOT NULL,
  `grant_read` tinyint(4) NOT NULL DEFAULT '0',
  `grant_edit` tinyint(4) NOT NULL DEFAULT '0',
  `grant_delete` tinyint(4) NOT NULL DEFAULT '0',
  `grant_add` tinyint(4) NOT NULL DEFAULT '0',
  `grant_comment` tinyint(4) NOT NULL DEFAULT '0',
  `grant_category` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`aID`),
  KEY `eID` (`eID`),
  KEY `gID` (`gID`),
  KEY `uID` (`uID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;");
db::query("CREATE TABLE IF NOT EXISTS `".db::table('comments')."` (
  `cID` bigint(20) NOT NULL AUTO_INCREMENT,
  `cEID` bigint(20) NOT NULL,
  `cAID` bigint(20) NOT NULL DEFAULT '0',
  `cAName` varchar(255) NOT NULL,
  `cCDate` bigint(20) NOT NULL,
  `cUDate` bigint(20) NOT NULL,
  `cAEmail` varchar(255) NOT NULL,
  `cText` text NOT NULL,
  `cActive` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;");
db::query("CREATE TABLE IF NOT EXISTS `".db::table('search')."` (
  `eID` int(11) NOT NULL AUTO_INCREMENT,
  `data` text NOT NULL,
  PRIMARY KEY (`eID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;");
db::query("CREATE TABLE IF NOT EXISTS `".db::table('tags')."` (
  `tID` bigint(20) NOT NULL AUTO_INCREMENT,
  `tag` varchar(255) NOT NULL,
  `count` bigint(20) NOT NULL DEFAULT '1',
  PRIMARY KEY (`tID`),
  UNIQUE KEY `tag` (`tag`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;");
db::query("CREATE TABLE IF NOT EXISTS `".db::table('content_categories')."` (
  `description` varchar(255) NOT NULL,
  `eID` bigint(20) NOT NULL,
  PRIMARY KEY (`eID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
db::query("CREATE TABLE IF NOT EXISTS `".db::table('content_pages')."` (
  `eID` bigint(20) NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`eID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
?>