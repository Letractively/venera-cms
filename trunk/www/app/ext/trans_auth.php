<?php
define('EXTENSION',1);
define('SET_GUEST_AUTH',1);
function extension(){
	venus_output('direct');
	if(isset($_REQUEST['email']) and isset($_REQUEST['password'])){
		$email=htmlspecialchars($_REQUEST['email']);
        $password=md5(htmlspecialchars($_REQUEST['password']));
		$user=db::select_array('SELECT `uID`,`securecode` FROM `'.db::table('users').'` WHERE `email`="'.$email.'" and `password`="'.md5($password).'" and `active`=1 LIMIT 1;');
		if($user!=null){
			srand((double) microtime()*1000000);
			$scode=md5($user['uID'].mktime().mt_rand(1000,9999));
			db::query('UPDATE `'.db::table('users').'` SET `securecode`="'.$scode.'" WHERE `uID`="'.$user['uID'].'";');
			$_SESSION['securecode']=$scode;
			setcookie('securecode',$scode,0,'/','.'.DOMAIN);
			echo $scode;
			return;			
		}
		echo '';
		return;
	}elseif(isset($_REQUEST['sc'])){
		$sc=htmlspecialchars($_REQUEST['sc']);
		$user=db::select_array('SELECT * FROM `'.db::table('users').'` WHERE `securecode`="'.$sc.'" LIMIT 1;');
		if($user!=null){
			$user['password']='';
			echo json_encode($user);
			return;
		}
	}
	$guest=array('name'=>'Guest','uID'=>0,'gID'=>UT_GUEST,'active'=>1);
	echo json_encode($guest);
	return;
}
chdir('./../../');
define('ADIR','app/');
include(ADIR.'include/core.class.php');
core::run();
?>