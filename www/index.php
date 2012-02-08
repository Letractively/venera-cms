<?php
/*/
Project code name: VENERA(M2010)
Source writed by Ildar Usmanov
E-mail: wajox@mail.ru
Web: http://wajox.myglonet.com
Project type: CMF/CMS
/*/
error_reporting(E_ALL);
/*
//
define('TRANS_AUTH_URL','http://project/app/ext/trans_auth.php');
//use this to authorize your users on one your web-site, to use this auth type you must use special js code, see app/js/trans_auth.js
*/
define('ADIR','app/');
include(ADIR.'include/core.class.php');
core::run();
?>