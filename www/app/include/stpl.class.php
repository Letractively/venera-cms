<?php
/**
 * Простейший шаблонизатор
 * 
 * @category   Templates
 * @package    Templates
 * @author     Ildar Usmanov <wajox@mail.ru>
 * @copyright  Copyright (c) 2009-2012 Wajox Software (http://wajox.myglonet.com) 
 */
 
/**
 * Класс простейшего шаблонизатора
 */
class stpl{
		/**
		 * Ассоциативный массив хранящий переменные шаблона
		 *
		 * @var array
		 */
		public $vars;
		/**
		 * Парсинг файла шаблона
		 * @param string $file имя файла шаблона
		 * @return string
		 */
		public function parse($file){
			$r=file_get_contents($file);
			foreach($this->vars as $n=>$v) $r=str_replace('<%'.$n.'%>',$v,$r);
			return $r;
		}
		/**
		 * Установка переменной шаблона
		 * @param string $n имя переменной
		 * @param string $v значение переменной
		 */
		public function set($n,$v){
			$this->vars[$n]=$v;
		}
	}
?>