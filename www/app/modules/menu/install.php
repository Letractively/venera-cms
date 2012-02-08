<?php
db::query("CREATE TABLE IF NOT EXISTS `".db::table('menu')."` (
  `iID` bigint(20) NOT NULL AUTO_INCREMENT,
  `iTitle` varchar(255) NOT NULL,
  `iDescription` varchar(255) NOT NULL,
  `iUrl` varchar(255) NOT NULL,
  `iIndex` bigint(20) NOT NULL DEFAULT '0',
  `ipID` bigint(20) NOT NULL DEFAULT '0',
  `iName` varchar(255) NOT NULL,
  `iShowOn` varchar(255) NOT NULL,
  `iAG0` tinyint(4) NOT NULL,
  `iAG1` tinyint(4) NOT NULL,
  `iAG2` tinyint(4) NOT NULL,
  `iAG3` tinyint(4) NOT NULL,
  PRIMARY KEY (`iID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;");
db::query("INSERT INTO `".db::table('menu')."` (`iID`, `iTitle`, `iDescription`, `iUrl`, `iIndex`, `ipID`, `iName`, `iShowOn`, `iAG0`, `iAG1`, `iAG2`, `iAG3`) VALUES (1, 'Home', '', '?q=', 0, 0, 'main', '*', 1, 1, 1, 1),(2, 'Menu', '', '?q=menu', 2, 0, '', 'admin/*', 0, 0, 0, 1);");
?>