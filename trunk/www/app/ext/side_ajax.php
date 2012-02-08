<?php
define('EXTENSION',1);
function extension(){
	venus_output('direct');
//*------------------------------------------------------------------------*//
	$allowed_url=core::$settings['side_ajax']['allowed_url'];
	$items=core::$settings['side_ajax']['items'];
//*------------------------------------------------------------------------*//
	if(isset($_GET['id']) and !empty($_GET['id']) and isset($items[$_GET['id']])){
		$url=$items[$_GET['id']];
	}elseif(isset($_GET['url']) and !empty($_GET['url'])){
		foreach($allowed_url as $k=>$item)
			if(mb_substr($_GET['url'],0,mb_strlen($item)+2)==$item.'/*'){
				$url='http://'.htmlspecialchars($_GET['url']);
				break;
			}						
		return;
	}else{
		return;
	}
	echo file_get_contents($url);
	//
}
chdir('./../../');
define('ADIR','app/');
include(ADIR.'include/core.class.php');
core::run();
?>