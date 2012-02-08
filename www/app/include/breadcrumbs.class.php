<?php
/**
 * Класс для управления "хлебными крошками"
 * @static
 * @category   Navigation
 * @package    Breadcrumbs
 * @author     Ildar Usmanov <wajox@mail.ru>
 * @copyright  Copyright (c) 2009-2012 Wajox Software (http://wajox.myglonet.com)
 */
class breadcrumbs{
	/**
	* Массивы элементов крошек
	* @var array
	*/
	static public $items=array();
	/**
	* Добавление элемента в крошки
	* @param string $url
	* @param string $title
	* @method add() add($url,$title) добавляет в крошки ссылку с адресом $url и текстом $title
	*/
	public function add($url,$title){
			self::$items[count(self::$items)]=array('url'=>$url,'title'=>$title);
		}
}
?>