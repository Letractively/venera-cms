<?php
/**
 * Библиотека управления кэшированием
 * 
 * @category   Cache
 * @package    Cache
 * @author     Ildar Usmanov <wajox@mail.ru>
 * @copyright  Copyright (c) 2009-2012 Wajox Software (http://wajox.myglonet.com)
 * 
 */
 

/**
 * Идентификатор кэширования вывода
 */
define('CACHE_TYPE_OUTPUT',0);
/**
 * Идентификатор кэширования переменных
 */
define('CACHE_TYPE_VARS',1);
/**
 * Класс для управления кэшированием
 */
class Cache{
	/**
	 * Активность кэширования
	 * @var bool
	 */
	public $active=FALSE;
	/**
	 * Время "жизни" кэша
	 * @var int
	 */
	public $lifetime=0;
	/**
	 * Управляющий объект кэширования
	 * @var mixed
	 */
	public $obj=null;
	/**
	 * Идентификаторы кэша
	 * @var string
	 */
	public $ids='';
	/**
	 * Идентификатор типа управляющего объекта кэширования
	 * @var int
	 */
	public $type=0;
	/**
	 * Префикс файла
	 * @var string
	 */
	public $prefix='';
	/**
	 * Путь к каталогу кэша
	 * @var string
	 */
	public $path='';
	/**
	 * Добавление идентификатора кэша
	 * @param string $v значение идентификатора
	 */
	public function id($v){
		$this->ids=$v;
	}
	/**
	 * Конструктор класса
	 * @param array options настройки кэширования
	 */
	public function __construct($options){
		foreach($options as $k=>$v)
			if(property_exists($this,$k))
				$this->$k=$v;
	}
	/**
	 * Запуск кэширования
	 * @param array options настройки кэширования
	 */
	public function start($options=false){	
		if($options!=false and is_array($options))
			foreach($options as $k=>$v)
				if(property_exists($this,$k))
					$this->$k=$v;
		switch($this->type){
			case CACHE_TYPE_OUTPUT:$this->obj=new CacheDataOutput();break;
			case CACHE_TYPE_VARS:$this->obj=new CacheDataVars();break;
			default: throw new NotFoundException('Cache type incorrect!');
		}
		if($this->exists()) throw new CacheLoadException();
		if(method_exists($this->obj,'start')) $this->obj->start();
	}
	/**
	 * Загрузка данных из кэша
	 */
	public function load(){
		$this->readfile();
		$this->obj->load();
	}
	/**
	 * Завершение кэширования
	 */
	public function end(){
		if(!$this->active or $this->obj==null) return; 	
		$this->obj->end();
		$this->writefile();
	}
	/**
	 * Проверка наличия готового кэша
	 */
	public function exists(){
		if(!$this->active or $this->obj==null) return FALSE; 	
		return $this->file_exist();
	}
	/**
	 * Поулчение имени файла кэша
	 * @return string
	 */
	public function fname(){
		if($this->ids=='') throw new NotFoundException('No have cache id');
		return $this->path.'/'.md5($this->prefix.$this->type.$this->ids).'.cache';
	}
	/**
	 * Проверка существования файла кэша
	 */
	public function file_exist(){
		$fname=$this->fname();
		if(file_exists($fname) and filemtime($fname)+$this->lifetime>time()) return TRUE;
		return FALSE;
	}
	/**
	 * Запись кэш файла
	 */
	public function writefile(){
		$f=fopen($this->fname(),'w+');
		fwrite($f, $this->obj->data);
		fclose($f);
		
	}
	/**
	 * Чтение кэш файла
	 */
	public function readfile(){
		$this->obj->data=file_get_contents($this->fname());	
	}
}
/**
 * Объект для кэширования вывода
 */
class CacheDataOutput
{
	/**
	 * Кэшируемые данный
	 */
	public $data=null;
	/**
	 * Метод начинающий кэширование вывода
	 */
	public function start(){
		ob_start();
	}
	/**
	 * Метод заканчивающий кэширование вывода
	 */
	public function end(){
		$this->data=ob_get_clean();
	}
	/**
	 * Метод загрузки данных из кэша
	 */
	public function load(){
		echo $this->data;
	}
}

/**
 * Класс кэширования переменных реестра
 */
class CacheDataVars{
	/**
	 * Данные кэша
	 */
	public $data=array();
	/**
	 * Метод начала кэширования
	 */
	public function start(){
			$this->data=array();
	}
	/**
	 * Метод завершения кэширования
	 */
	public function end(){
		$vars=array();
		foreach($this->vars as $k=>$v){
			$vars[$v]=core::$vars[$v];
		}
		$this->data=serialize($vars);
	}
	/**
	 * Метод загрузки данных из кэша
	 */
	public function load(){
		$this->data=unserialize($this->data);		
		foreach($this->data as $k=>$v){
			core::$vars[$k]=$v;
		}
	}
	/**
	 * Добавление переменной для кэширования
	 * @param $n имя переменной реестра
	 */
	public function set($n){
		if(!is_array($n)){
			$this->vars[]=$n;
			return;
		}
		foreach($n as $k=>$v)
			$this->vars[]=$v;
	}
}
?>