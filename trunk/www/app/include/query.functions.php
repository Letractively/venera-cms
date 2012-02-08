<?php
/**
 * Функции для органиизации работы с веб-адресами и ссылками
 * 
 * @category   Query
 * @package    Query
 * @author     Ildar Usmanov <wajox@mail.ru>
 * @copyright  Copyright (c) 2009-2012 Wajox Software (http://wajox.myglonet.com)
 * 
 */

/**
 * Получение разобранного массива запроса
 *
 * @param string $q строка запроса
 * @return array
 */
	function get_query($q=''){
		if(trim($q)!='') $_GET['q']=$q;
		$query=(isset($_GET['q']) and !empty($_GET['q']))?htmlspecialchars(trim($_GET['q']),ENT_QUOTES):core::$settings['interface']['query'];
        $query=mb_convert_case($query, MB_CASE_LOWER, "UTF-8");
		if(file_exists(SDIR.'router.php')) include(SDIR.'router.php');
		return explode('/',$query);
	}

/**
 * Получение веб-адреса на страницу с заданным запросом и переменными GET
 *
 * @param string $l строка запроса
 * @param string $vars переменные GET
 * @return string
 */
	function l($l='',$vars=null){
			$link=BASEURL;
			if(trim($l=='')) return $link.(!empty($vars)?'?'.$vars:'');	
			if(!empty($vars)) return $link.'?q='.$l.'&'.$vars;	
			$link.=(FURL)?$l:'?q='.$l;
			return $link;
		}
		
/**
 * Получение ссылки на веб-адреса на страницу с заданным запросом и переменными GET
 *
 * @param string $l строка запроса
 * @param string $text текст ссылки HTML
 * @param string $target цель ссылки
 * @param string $vars переменные GET
 * @param bool $al флаг генерации сылки по запросу
 * @return string
 */
	function __l($l='',$text=null,$target='_self',$vars=null,$al=TRUE){
			$link='<a href="'.($al?l($l,$vars):$l).'" target="'.$target.'">'.($text==null?l($l,$vars):$text).'</a>';
			return $link;
		}
		
/**
 * Вывод на экран веб-адреса на страницу с заданным запросом и переменными GET
 *
 * @param string $l строка запроса
 * @param string $vars переменные GET
 * @return string
 */
	function _l($l='',$vars=null){
			echo l($l,$vars);
		}

/**
 * Получение веб-адреса расширения
 *
 * @param string $extfile файл расширения
 * @return string
 */
	function le($extfile){
			return BASEURL.EDIR.$extfile;
	}

/**
 * Получение веб-адреса субдомена на страницу с заданным запросом и переменными GET
 *
 * @param string $l строка запроса
 * @param string $subd имя субдомена
 * @param string $vars переменные GET
 * @return string
 */
	function lsubd($l,$subd=null,$vars=null){
			$subd=($subd==null and defined('SUBDOMAIN'))?SUBDOMAIN:$subd;
			$link='http://'.$subd.'.'.DOMAIN.'/';
			if(trim($l=='')) return $link.(!empty($vars)?'?'.$vars:'');	
			if(!empty($vars)) return $link.'?q='.$l.'&'.$vars;	
			$link.=(FURL)?$l:'?q='.$l;
			return $link;
	}

/**
 * Вывод веб-адреса субдомена на страницу с заданным запросом и переменными GET
 *
 * @param string $l строка запроса
 * @param string $subd имя субдомена
 * @param string $vars переменные GET
 * @return string
 */
	function _lsubd($l,$subd,$vars=null){
			echo lsubd($l,$subd,$vars);
	}

/**
 * Вывод ссылки веб-адреса на страницу с заданным запросом и переменными GET
 *
 * @param string $l строка запроса
 * @param string $text текст ссылки HTML
 * @param string $subd имя субдомена
 * @param string $target цель ссылки
 * @param string $vars переменные GET
 * @return string
 */
	function __lsubd($l,$text=null,$subd=null,$target='_self',$vars=null){
			return __l(lsubd($l,$subd,$vars),$text,$target,$vars,FALSE);
	}
?>