<?php
db::query('DELETE FROM `'.db::table('options').'` WHERE `name`="default";');
db::query("DROP TABLE IF EXISTS `".db::table('elements')."`");
db::query("DROP TABLE IF EXISTS `".db::table('elements_access')."`");
db::query("DROP TABLE IF EXISTS `".db::table('comments')."`");
db::query("DROP TABLE IF EXISTS `".db::table('tags')."`");
db::query("DROP TABLE IF EXISTS `".db::table('search')."`");
db::query("DROP TABLE IF EXISTS `".db::table('content_categories')."`");
db::query("DROP TABLE IF EXISTS `".db::table('content_pages')."`");
?>