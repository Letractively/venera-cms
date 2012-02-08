<?php
/**
 * Библиотека работы с языковыми файлами
 *
 * @category   Language
 * @package    Language
 * @author     Ildar Usmanov <wajox@mail.ru>
 * @copyright  Copyright (c) 2009-2012 Wajox Software (http://wajox.myglonet.com)
 */

/**
 * Получение локализованного текста из таблицы языкового файла
 *
 * @param string $t индекс в таблице
 * @param array $args аргументы для замены в тексте
 * @return string
 */
function lt($t,$args=null){
		if($args!=null and is_array($args)) return vsprintf ( language::get($t) ,$args );
		return language::get($t);
	}

/**
 * Вывод локализованного текста из таблицы языкового файла
 *
 * @param string $t индекс в таблице
 * @param array $args аргументы для замены в тексте
 * @return string
 */	
function _lt($t,$args=null){
		echo language::get($t,$args);
	}

/**
 * Класс для работы сс файлами локализаций и организации мультиязыковой поддержки
 *
 * @static
 */
class language{
		/**
		 * Таблица локализации
		 *
		 * @var array
		 * @static
		 */
		static public $la;
		/**
		 * Загрузка таблицы языкового файла
		 *
		 * @param string $l названия подключаемого языка
		 * @method load() load($l) метод загрузки локализации
		 */
		public function load($l){
				if(!file_exists(ADIR.'lang/'.$l.'/lang.php') or MODE=='admin') 
					$lang=core::$settings['interface']['language'];
				else
					$lang=$l;
				if(file_exists(ADIR.'lang/'.$l.'/settings.php')) include(ADIR.'lang/'.$l.'/settings.php');
				include(ADIR.'lang/'.$lang.'/lang.php');
				self::$la=$_L;
			}
		/**
		 * Получение локализованного текста из таблицы языкового файла
		 *
		 * @param string $index индекс в таблице
		 * @return string
		 */
		public function get($index){
				if(!isset(self::$la[$index])) return $index;
				return self::$la[$index];
			}
			
		/**
		 * Вывод локализованного текста из таблицы языкового файла
		 *
		 * @param string $index индекс в таблице
		 */
		public function show($index){
				echo self::$la[$index];
			}
	}
//----------------------------------------------------------
?>