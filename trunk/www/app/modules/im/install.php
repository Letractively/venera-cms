<?php
db::query("CREATE TABLE IF NOT EXISTS `".db::table('im')."` (
  `mID` bigint(20) NOT NULL AUTO_INCREMENT,
  `fromID` int(11) NOT NULL,
  `toID` int(11) NOT NULL,
  `theme` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `datetime` int(11) NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT '0',
  `status_out` int(11) NOT NULL,
  `readed` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`mID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
?>