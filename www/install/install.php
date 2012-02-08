<?php
error_reporting(0);
if(!file_exists('./../install.txt')) die('');
header('Content-Type: text/html; charset=utf-8');

function clen($t,$mn,$mx){
if(strlen($t)<$mn or strlen($t)>$mx) return FALSE;
return TRUE;
}
function install(){
	foreach($_REQUEST as $k=>$v) $_REQUEST[$k]=trim(htmlspecialchars($v));
	if(file_exists('./../app/settings/sites/default/default.php') and !is_writeable('./../app/settings/sites/default/default.php')) return FALSE;
	if(file_exists('./../app/settings/sites/default/admin.php') and !is_writeable('./../app/settings/sites/default/admin.php')) return FALSE;
	if(file_exists('./../app/settings/sites/default/db.php') and !is_writeable('./../app/settings/sites/default/db.php')) return FALSE;
	$isql=explode("---",file_get_contents('data/dump.sql'));
	$idconfig=file_get_contents('data/default.php');
	$iaconfig=file_get_contents('data/admin.php');
	$idbconfig=file_get_contents('data/db.php');
	foreach($_REQUEST as $k=>$v){
		$isql=str_replace('<%'.$k.'%>',$v,$isql);
		$idconfig=str_replace('<%'.$k.'%>',$v,$idconfig);
		$iaconfig=str_replace('<%'.$k.'%>',$v,$iaconfig);
		$idbconfig=str_replace('<%'.$k.'%>',$v,$idbconfig);
	}
	if(!file_put_contents('./../app/settings/sites/default/default.php',$idconfig))  return FALSE;
	if(!file_put_contents('./../app/settings/sites/default/admin.php',$iaconfig))  return FALSE;
	if(!file_put_contents('./../app/settings/sites/default/db.php',$idbconfig))  return FALSE;
	mysql_set_charset('utf8');
	foreach($isql as $k=>$s){
		if(!mysql_query(trim($s)) or mysql_error()!=''){ file_put_contents('./errors_report.txt',$s."\n".mysql_error());return FALSE;}
	}
	return TRUE;
}


$error=0;
$message='Ok!';

if(!isset($_REQUEST['userpassword']) or !isset($_REQUEST['userlogin']) or !isset($_REQUEST['useremail']) or !isset($_REQUEST['dbhost']) or !isset($_REQUEST['dbuser']) or !isset($_REQUEST['dbpassword']) or !isset($_REQUEST['dbname']) or !isset($_REQUEST['dbprefix']))
die('{"error":"1","message":"Ошибка! Нет данных!"}');

$_REQUEST['userpassword']=md5($_REQUEST['userpassword']);

$baseurl=$_REQUEST['baseurl'];
@$link = mysql_connect($_REQUEST['dbhost'], $_REQUEST['dbuser'], $_REQUEST['dbpassword']);
if (!$link){
	$error=1;
	$message='Не удалось подключится к серверу базы данных!';
}elseif(!@mysql_select_db($_REQUEST['dbname'])){
	$error=1;
	$message='Не удалось подключится к базе данных с именем \''.$_REQUEST['dbname'].'\'!';
}

if(!clen($_REQUEST['userpassword'],6,255)){
	$error=1;
	$message='Пароль должен быть не короче 6 символов и не длиннее 255 символов!';
}
if(!clen($_REQUEST['userlogin'],1,255)){
	$error=1;
	$message='Пароль должен быть не короче 1 символа и не длиннее 255 символов!';
}
if(!clen($_REQUEST['username'],1,255)){
	$error=1;
	$message='Имя администратора должно быть не короче 1 символа и не длиннее 255 символов!';
}
if(!clen($_REQUEST['usersername'],1,255)){
	$error=1;
	$message='Фамилия алминистратора должна быть не короче 1 символа и не длиннее 255 символов!';
}
if(!clen($_REQUEST['useremail'],4,255)){
	$error=1;
	$message='Некорректный адрес электронной почты!!';
}
if(!clen($_REQUEST['baseurl'],2,255)){
		$error=1;
		$message='Некорректный адрес сайта!!';
	}
if(!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $_REQUEST['useremail'])){
	$error=1;
	$message='Некорректный адрес электронной почты!!';
}
if($error==0){
	if(!install()){
			$error=1;
			$message='Ошибка!';
	}else{
		unlink('./../install.txt');
	}
}
 
echo '{"error":"'.$error.'","message":"'.$message.'"}';
?>