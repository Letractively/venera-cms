<?php
define('EXTENSION',1);
function extension(){
		$url=htmlspecialchars($_REQUEST['url']);
		if(mb_strlen($url)>1024) $url=mb_substr($url,0,1024);
		venus_set('url',$url);
		venus_ctpl('notuse');
		venus_tpl(TDIR.'redirect.php');
}
chdir('./../../');
define('ADIR','app/');
include(ADIR.'include/core.class.php');
core::run();
?>