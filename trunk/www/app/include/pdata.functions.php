<?php
/**
 * Функции для органиизации работы с элементами страниц
 * 
 * @category   Page
 * @package    Page
 * @author     Ildar Usmanov <wajox@mail.ru>
 * @copyright  Copyright (c) 2009-2012 Wajox Software (http://wajox.myglonet.com)
 * 
 */
 
/**
 * Добавление в <head> страницы стилей и скриптов
 * <samp>
 * venus_head_part(array('type'=>'js','src'=>BASEURL.'app/js/ajax.js'));
 * </samp>
 * @param array $data()
 * @return bool
 */
function venus_head_part($data)
{
	if(!isset($data['type'])) return FALSE;
	if(!isset($data['src']) and !isset($data['text'])) return FALSE;
	if(isset($data['src']) and isset($data['text'])) return FALSE;
	$index=isset($data['text'])?count(core::$head):md5($data['src']);
	$data['charset']=isset($data['charset'])?$data['charset']:core::$settings['interface']['encoding'];
	if(isset(core::$head[$index])) return TRUE;
	switch($data['type']){
		case 'js':
			$html="\n".'<script type="text/javascript"'.(isset($data['src'])?' src="'.$data['src'].'" ':'').' charset="'.$data['charset'].'">'."\n"
			.(isset($data['text'])?$data['text']:'')."\n".'</script>'."\n";
			break;
		case 'css':
			if(isset($data['text']))
				$html="\n".'<style type="text/css" charset="'.$data['charset'].'">'."\n".$data['text']."\n".'</style>'."\n";
			else
				$html="\n".'<link rel="stylesheet" type="text/css" href="'.$data['src'].'" charset="'.$data['charset'].'"/>'."\n";
		break;
		default:return FALSE;
	}
	core::$head[$index]=$html;
	return TRUE;
}

/**
 * Генерация данных <head> страницы
 *
 * Функция возвращает стили и скрипты страницы, добавленные при помощи функции venus_head_part() 
 *
 * @return string
 */
function venus_head()
{
	if(count(core::$head)>0) echo implode("\r\n",core::$head);
}

/**
 * Генерация ссылок для постраничной навигации
 *
 * Функция возвращает список ссылок для организации постраничной навигации
 *
 * @param string $linktpl шаблон ссылки
 * @param array $options опции
 * @param int $retype тип возвращаемого значения текст(0) или массив(1) 
 * @param string $vars GET-переменные ссылки
 * @param string $target цель ссылки(_slef,_blank)
 * @param bool $al флаг генерации полной ссылки
 * @return string
 */
function venus_nav_links($linktpl,$options=array(),$retype=0,$vars=null,$target='_self',$al=TRUE){
	$pagenow=(isset($options['pagenow']) and is_numeric($options['pagenow'])) ? $options['pagenow'] : 0 ;
	$maxpage=$options['maxpage'];
	$navsize=isset($options['navsize'])?$options['navsize']:2;
	if($maxpage<=0) return (($retype==1) ? array():'');
	$glue=isset($options['glue'])?$options['glue']:'&nbsp;&nbsp;';
	if($pagenow>0){
			$backlink=str_replace('{%page%}',$pagenow-1,__l($linktpl,lt('backlink'),$target,$vars,$al));
		}else{
			$backlink=lt('backlink');
		}
	if($pagenow<$maxpage){
			$nextlink=str_replace('{%page%}',$pagenow+1,__l($linktpl,lt('nextlink'),$target,$vars,$al));
		}else{
			$nextlink=lt('nextlink');
		}
	if($pagenow!=0){
			$beginlink=str_replace('{%page%}','0',__l($linktpl,lt('beginlink'),$target,$vars,$al));
		}else{
			$beginlink=lt('beginlink');
		}
	if($pagenow!=$maxpage){
			$endlink=str_replace('{%page%}',$maxpage,__l($linktpl,lt('endlink'),$target,$vars,$al));
		}else{
			$endlink=lt('endlink');
		}
	if($maxpage>$navsize*2){
		$beginpage=0;
		$endpage=$navsize*2;
		if($pagenow>$navsize and $maxpage>$pagenow+$navsize){
			$beginpage=$pagenow-$navsize;
			$endpage=$pagenow+$navsize;
		}elseif($pagenow>$navsize+1){
			$beginpage=$maxpage-$navsize*2;
			$endpage=$maxpage;
		}else{
			$beginpage=0;
		}
	}else{
		$beginpage=0;
		$endpage=$maxpage;
	}
	$links=array();
	for($i=$beginpage;$i<=$endpage;$i++)$links[]=($i==$pagenow)?'<b>'.($i+1).'</b>':str_replace('{%page%}',$i,__l($linktpl,$i+1,$target,$vars,$al));
	if($retype==1){
		return array('beginpage'=>$beginpage,'endpage'=>$endpage,'pagenow'=>$pagenow,
					'navsize'=>$navsize,'maxpage'=>$maxpage,'links'=>$links,'nextlink'=>$nextlink,
					'backlink'=>$backlink,'beginlink'=>$beginlink,'endlink'=>$endlink);
	}
	$links=implode($glue,$links);
	return $beginlink.$glue.$backlink.$glue.$links.$glue.$nextlink.$glue.$endlink;
}

/**
 * Преобразование веб-адресов в ссылки
 *
 * Функция преобразует все веб-адреса в кликабельные ссылки
 *
 * @param string $text
 * @return string
 */
function venus_hyperlink($text) {
	$text = mb_eregi_replace("[[:alpha:]]+://[^<>[:space:]]+[[:alnum:]/]", "<a href=\"\\0\" target=\"_blank\">\\0</a>", $text);
    return $text;
}
?>