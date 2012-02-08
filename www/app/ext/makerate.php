<?php
define('EXTENSION',1);
function extension(){
		if(isGuest()){ echo 'error';return FALSE;}
		if(!is_numeric($_REQUEST['id'])){ echo 'error';return FALSE;}
		venus_output('direct');		
		$type=(isset($_REQUEST['type']) and is_numeric($_REQUEST['type']))?$_REQUEST['type']:1;
		$id=abs(intval($_REQUEST['id']));
		$value=intval($_REQUEST['value'])>0?1:-1;
		
		switch($type){
			default:
				$type=2;
				$rate=db::select_array('SELECT `eID` as `id`,`rateplus`,`rateminus` FROM `'.db::table('elements').'` WHERE `eID`="'.$id.'";');
				if($rate===null){ echo 'error';return FALSE;}
				$rate=db::select_array('SELECT `rateID`,`rate` FROM `'.db::table('rates').'` WHERE `uID`="'.core::$user['uID'].'" and `id`="'.$id.'" and `type`="'.$type.'";');
				if($rate!=null){
					db::query('UPDATE `'.db::table('rates').'` SET `rate`="'.$value.'" WHERE `rateID`="'.$rate['rateID'].'";');
					if($rate['rate']>0 and $value<0)
						db::query('UPDATE `'.db::table('elements').'` SET `rateminus`=`rateminus`+1,`rateplus`=`rateplus`-1 WHERE `eID`="'.$id.'";');
					elseif($rate['rate']<0 and $value>0)
						db::query('UPDATE `'.db::table('elements').'` SET `rateminus`=`rateminus`-1,`rateplus`=`rateplus`+1 WHERE `eID`="'.$id.'";');
					
				}else{
					db::query('INSERT INTO `'.db::table('rates').'` SET `rate`="'.$value.'",`uID`="'.core::$user['uID'].'",`id`="'.$id.'",`type`="'.$type.'";');
					if($value<0)
						db::query('UPDATE `'.db::table('elements').'` SET `rateminus`=`rateminus`+1 WHERE `eID`="'.$id.'";');
					elseif($value>0)
						db::query('UPDATE `'.db::table('elements').'` SET `rateplus`=`rateplus`+1 `eID`="'.$id.'";');
					
				}
				$rate=db::select_array('SELECT `eID` as `id`,`rateplus`,`rateminus` FROM `'.db::table('elements').'` WHERE `eID`="'.$id.'";');
			break;
		}
		echo json_encode($rate);
		
}
chdir('./../../');
define('ADIR','app/');
include(ADIR.'include/core.class.php');
core::run();
?>