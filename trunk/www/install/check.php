<?php
error_reporting(0);
if(!file_exists('./../install.txt')) die('');
function clen($t,$mn,$mx){
if(strlen($t)<$mn or strlen($t)>$mx) return FALSE;
return TRUE;
}
sleep(1);
header('Content-Type: text/html; charset=utf-8');
$error=0;
$message='Ok';

if(isset($_REQUEST['dbhost'])){
	@$link = mysql_connect($_REQUEST['dbhost'], $_REQUEST['dbuser'], $_REQUEST['dbpassword']);
	if (!$link){
		$error=1;
		$message='Не удалось подключится к серверу базы данных!';
	}elseif(!@mysql_select_db($_REQUEST['dbname'])){
		$error=1;
		$message='Не удалось подключится к базе данных с именем \''.$_REQUEST['dbname'].'\'!';
	}
}else{
		foreach($_REQUEST as $k=>$v)
			$_REQUEST[$k]=trim(htmlspecialchars($v));
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
}
echo '{"error":"'.$error.'", "message":"'.$message.'"}';
?>