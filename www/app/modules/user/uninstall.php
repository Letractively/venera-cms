<?php
db::query('DELETE FROM `'.db::table('options').'` WHERE `name`="user";');
db::query('DROP TABLE IF EXISTS `'.db::table('users').'`;');
db::query('DROP TABLE IF EXISTS `'.db::table('whoonline').'`;');
?>