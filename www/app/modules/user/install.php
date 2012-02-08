<?php
db::query("INSERT INTO `".db::table('options')."` (`value`, `name`) VALUES ('{\"o\":\"11\",\"a\":\"0000\"}', 'user');");
db::query("CREATE TABLE IF NOT EXISTS `".db::table('users')."`(
  `uID` bigint(20) NOT NULL AUTO_INCREMENT,
  `gID` int(11) NOT NULL DEFAULT '1',
  `login` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `sername` varchar(255) NOT NULL,
  `gender` tinyint(4) NOT NULL DEFAULT '1',
  `birthday` int(11) NOT NULL,
  `birthmonth` int(11) NOT NULL,
  `birthyear` int(11) NOT NULL,
  `securecode` varchar(255) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `code` varchar(255) NOT NULL,
  `lvisit` int(11) NOT NULL DEFAULT '0',
  `about` text NOT NULL,
  `city` int(11) NOT NULL,
  `newmsg` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`uID`)) ENGINE=InnoDB  DEFAULT CHARSET=utf8;");
db::query("INSERT INTO `".db::table('users')."` (`uID`, `gID`, `login`, `password`, `email`, `securecode`, `active`, `code`, `lvisit`) VALUES(1, 3, 'root', '".md5('password123')."', 'root@mymail', '878a0e4e71fae8b9dab301018441214c', 1, '', 1297334505);");
db::query("CREATE TABLE IF NOT EXISTS `".db::table('whoonline')."` (`login` varchar(255) NOT NULL,`uID` bigint(20) NOT NULL,`gID` tinyint(4) NOT NULL,`time` int(11) NOT NULL,`ip` int(11) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
?>