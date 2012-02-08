<?php
/**
 * Функции управления пользователями
 * 
 * @category   Users
 * @package    Users
 * @author     Ildar Usmanov <wajox@mail.ru>
 * @copyright  Copyright (c) 2009-2012 Wajox Software (http://wajox.myglonet.com)
 * 
 */

/**
 * Идентификатор группы гостей
 */
define('UT_GUEST',0);
/**
 * Идентификатор группы зарегистрированных пользователей
 */
define('UT_USER',1);
/**
 * Идентификатор группы модераторов
 */
define('UT_MODERATOR',2);
/**
 * Идентификатор группы администраторов
 */
define('UT_ADMIN',3);


/**
 * Функция выхода пользователя из системы
 */
function venus_user_logout(){
				setcookie('securecode','',time()+3600*24*365,'/');
				$_SESSION['root']=$_SESSION['securecode']='';
				unset($_SESSION['root']);
				unset($_SESSION['securecode']);
	}

/**
 * Функция авторизации root пользователя
 */
function venus_root_login(){
		if(!isset($_POST['system_login']) and !isset($_SESSION['root'])) return venus_user_guest_login();
		include(SDIR.'root.php');
		if(isset($_SESSION['root']) and $_SESSION['root']!=md5(ROOTLOGIN.ROOTPWD)) return venus_user_guest_login(); 
		if(isset($_POST['system_login']) and (!isset($_POST['login']) or !isset($_POST['password'])) and (ROOTLOGIN!=$_POST['email'] or ROOTPWD!=$_POST['password'])) return venus_user_guest_login();		
		core::$user['login']=ROOTLOGIN;
		core::$user['name']='Root';
		core::$user['uID']=1;
		core::$user['gID']=UT_ADMIN;
		core::$user['active']=1;
		$_SESSION['root']=md5(ROOTLOGIN.ROOTPWD);
		return TRUE;
	}

/**
 * Гостевая авторизация
 */
function venus_user_guest_login(){
		core::$user['login']='Guest';
		core::$user['name']='';
		core::$user['sername']='';
		core::$user['uID']=0;
		core::$user['gID']=UT_GUEST;	
		return TRUE;
	}

/**
 * Функция внешней авторизации
 */
function venus_trans_auth(){
		if(!isset($_SESSION['securecode']) and !isset($_COOKIE['securecode']) and !isset($_REQUEST['securecode'])) return venus_user_guest_login();
		if(isset($_REQUEST['securecode']))
			$scode=$_REQUEST['securecode'];
		elseif(isset($_COOKIE['securecode']) and !empty($_COOKIE['securecode'])) 
			$scode=$_COOKIE['securecode'];
		else 
			$scode=$_SESSION['securecode'];
		$data=file_get_contents(TRANS_AUTH_URL.'?sc='.$scode);
		$user=json_decode($data,TRUE);
		if(empty($user)) return venus_user_guest_login();
		core::$user=&$user;
		setcookie('securecode',$user['securecode'],(isset($_REQUEST['rememberme'])?time()+3600*24*360:time()+3600*24),'/');
		$_SESSION["securecode"]=$user['securecode'];
		
	}

/**
 * Функция авторизации пользователя
 */
function venus_user_login(){
		if(isset($_GET['logout']) or defined('SET_GUEST_AUTH')){ venus_user_logout();return venus_user_guest_login();}
		if(defined('TRANS_AUTH_URL')) return venus_trans_auth();
        if(isset($_POST['system_login'])){
        	if(!isset($_POST['email']) or !isset($_POST['password']))
        		return venus_user_guest_login();
        	$email=htmlspecialchars($_POST['email']);
        	$password=md5(htmlspecialchars($_POST['password']));
        	$user=db::select_array('SELECT * FROM '.db::table('users').' WHERE email=? and password=? and active=1 LIMIT 1;',array($email,$password));
        	if(!$user) return venus_user_guest_login();
			core::$user=$user;
        	venus_user_setcode();
        	return TRUE;
        }
        if((isset($_SESSION['securecode']) and !empty($_SESSION['securecode'])) or (isset($_COOKIE['securecode']) and !empty($_COOKIE['securecode']))){
			
        	if(isset($_SESSION['securecode']))
        		$scode=htmlspecialchars($_SESSION['securecode']);
        	else
				$scode=htmlspecialchars($_COOKIE['securecode']);
        		
        	core::$user['securecode']=$scode;
            if(venus_user_bycode()) return;			
        }
        return venus_user_guest_login();

	}
/**
 * Функция установки кода авторизации пользователя
 */
function venus_user_setcode(){
		srand((double) microtime()*1000000);
		$code=md5(core::$user['uID'].mktime().mt_rand(1000,9999));
		$sql='UPDATE '.db::table('users').' SET securecode=?,lvisit=? WHERE uID=?;';
		db::query($sql,array($code,time(),core::$user['uID']));	
		setcookie('securecode',$code,(isset($_POST['rememberme'])?time()+3600*24*365:3600*24),'/');
		$_SESSION['securecode']=$code;
		core::$user['securecode']=$code;
		return TRUE;

	}
/**
 * Загрузка пользователя по коду авторизации
 */
function venus_user_bycode(){
		if(empty(core::$user['securecode'])) return FALSE;
		$user=db::select_array('SELECT * FROM '.db::table('users').' WHERE securecode=?;',array(core::$user['securecode']));
		if(!$user) return FALSE;
		core::$user=$user;
		core::$user['lvisit']=time();
		db::query('UPDATE '.db::table('users').' SET lvisit=? WHERE uID=?;',array(core::$user['lvisit'],core::$user['uID']));		
		return TRUE;
	}
/**
 * Функция проверики аккаунта на принадлежность к группе администаторов
 * @return bool
 */
function isAdmin(){
 			return (core::$user['gID']==UT_ADMIN);
	}
/**
 * Функция проверики аккаунта на принадлежность к группе авторизованных пользователей
 * @return bool
 */
function isUser(){
			return (core::$user['gID']==UT_USER);
	}
/**
 * Функция проверики аккаунта на принадлежность к группе модераторов
 * @return bool
 */
function isModerator(){
			return (core::$user['gID']==UT_MODERATOR);
	}
/**
 * Функция проверики аккаунта на принадлежность к группе гостей
 * @return bool
 */
function isGuest(){
			return (core::$user['gID']==UT_GUEST);
	}
?>