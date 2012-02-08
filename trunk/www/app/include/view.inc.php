<?php
/**
 * Функции управления видом
 * 
 * @category   View
 * @package    View
 * @author     Ildar Usmanov <wajox@mail.ru>
 * @copyright  Copyright (c) 2009-2012 Wajox Software (http://wajox.myglonet.com)
 * 
 */
 
/**
 * Печать контента страницы
 */
function venus_content(){
				echo core::$content;
			}
/**
 * Парсинг внутреннего шаблона и загрузка контента страницы
 */
function venus_content_load(){		
				$f=venus_ctpl();	
				if($f=='notuse') return;
				if(!file_exists($f)) throw new NotFoundException();
				foreach(core::$vars as $k=>&$v) $$k=$v;
				ob_start();	
				include($f);
				core::$content.=ob_get_clean();
			}
/**
 * Функция отображения вида страницы
 */
function venus_view(){
				switch(venus_output()){
						case 'direct':
							break;
						case 'phptpl': 
						case 'ajax': 
						case 'print':
						case 'xml':
							venus_content_load();		
							foreach(core::$vars as $k=>&$v) $$k=$v;
							include(venus_tpl());
							break;						
						case 'xslt':
							echo venus_xsltemplate(core::$xml,venus_tpl());
							break;
						case 'smarty':
							require(ADIR.'include/smarty/Smarty.class.php');
							$smarty = new Smarty;
							//$smarty->force_compile = true;
							$smarty->debugging = true;
							$smarty->caching = false;
							$smarty->cache_lifetime = 0;
							$smarty->compile_dir  = 'tmp/smarty_compiled';
							$smarty->config_dir   = 'app/settings/smarty';
							$smarty->cache_dir    = 'tmp/smarty_cache';
							$smarty->php_handling = Smarty::PHP_REMOVE;
							
							$smarty->assign('lang',language::$la);
							$smarty->assign('user',core::$user);
							$smarty->assign('access',core::$actable);
							$smarty->assign('error',core::$errors);
							ob_start();
							venus_head();						
							$smarty->assign('head',ob_get_clean());
							$smarty->assign('query',core::$query);
							
							foreach(core::$vars as $k=>&$v) $smarty->assign($k,$v);
							
							$f=venus_ctpl();				
							if(!file_exists($f)) throw new NotFoundException();
							foreach(core::$vars as $k=>&$v) $$k=$v;
							ob_start();	
							$smarty->display($f);
							core::$content.=ob_get_clean();
							$smarty->assign('content',core::$content);
							$smarty->display(venus_tpl());
							
							break;
						default: throw new NotFoundException();
					}

			}
?>