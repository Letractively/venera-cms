<?php
/**
 * Управление реестром, переменными и плагинами
 * 
 * @category   Registry
 * @package    Registry
 * @author     Ildar Usmanov <wajox@mail.ru>
 * @copyright  Copyright (c) 2009-2012 Wajox Software (http://wajox.myglonet.com)
 * 
 */
 
/**
 * Идентификатор сообщения успешного выполнения
 */
define('MT_OK',0);
/**
 * Идентификатор сообщения об ошибке
 */
define('MT_ERROR',1);
/**
 * Идентификатор сообщения с предупреждением
 */
define('MT_WARNING',2);


/**
 * Установка или получение типа вывода(шаблонизации)
 *
 * @param string $o тип
 * @return string
 */
function venus_output($o=''){
				if($o=='') return venus_get('view_output');
				venus_set('view_output',$o);
			}

/**
 * Установка или получение основного файла шаблона страницы
 *
 * @param string $tpl файл шаблона
 * @return string
 */
function venus_tpl($tpl=''){
				if($tpl=='') return venus_get('tpl');
				venus_set('tpl',$tpl);
			}

/**
 * Установка или получение внутреннего файла шаблона страницы
 *
 * @param string $tpl файл шаблона
 * @return string
 */
function venus_ctpl($tpl=''){
				if($tpl=='') return venus_get('content_tpl');
				venus_set('content_tpl',$tpl);
			}

/**
 * Добавление сообщения в реестр
 *
 * @param string $msg текст сообщения
 * @param int $status тип сообщения MT_OK, MT_ERROR, MT_WARNING
 */
function venus_message($msg,$status=0){
				venus_set('message',$msg);
				venus_set('message_status',$status);
			}
			
/**
 * Установка переменной в реестре
 *
 * @param string $varname имя переменной
 * @param string $varvalue значение
 */
function venus_set($varname,$varvalue){
				core::$vars[$varname]=$varvalue;
			}
			
/**
 * Получение переменной из реестра
 *
 * @param string $varname имя переменной
 * @return mixed
 */
function venus_get($varname){
				return core::$vars[$varname];
			}

/**
 * Удаление переменной из реестра
 *
 * @param string $varname имя переменной
 */
function venus_delete($varname){
				core::$vars[$varname]=NULL;
				unset(core::$vars[$varname]);
			}
/**
 * Добавление сообщения об ошибке
 *
 * @param string $error_msg текст сообщения
 */
function venus_error($error_msg){
				core::$errors[count(core::$errors)]=$error_msg;
			}

/**
 * Удаление всех сообщений об ошибке
 */
function venus_clear_errors(){
				core::$errors=array();
			}
			
/**
 * Получения флага существования ошибок
 *
 * @return bool
 */
function venus_have_errors(){
				return (count(core::$errors)>0); 
			}

/**
 * Подключение плагина
 * 
 * Функция подключения плагина. В функцию передаётся имя подключаемого плагина 
 * и параметры в виде массива, которые передаются в плагин. Функция возвращает результат
 * работы плагина.
 * <samp>
 * venus_plugin('tagscloud');//подключение плагина меню
 * </samp>
 *
 * @param string $name имя плагина
 * @param array $params массив параметров плагина
 * @return mixed
 */			
function venus_plugin($name,$params=array()){
				if(!file_exists(ADIR.'plugins/'.$name.'.plugin.php'))return;
				include(ADIR.'plugins/'.$name.'.plugin.php');
				if(!function_exists('venus_plugin_'.$name))return;
				return call_user_func_array('venus_plugin_'.$name,$params);
			}
?>