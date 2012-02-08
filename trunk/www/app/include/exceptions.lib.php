<?php
/**
 * Библиотека исключений
 * 
 * @category   Exceptions
 * @package    Exceptions
 * @author     Ildar Usmanov <wajox@mail.ru>
 * @copyright  Copyright (c) 2009-2012 Wajox Software (http://wajox.myglonet.com)
 * 
 */
 
/**
 * Класс исключения возникающего если элемент не найден
 */
 class NotFoundException extends Exception{

    	public function __construct($message='[Null]'){
      			$message='<b>Не найдено!</b><br />'
      			.'Сообщение: '.$message.'<br/>'
      			.'Страница: '.$this->file.'<br/>'
      			.'Строка: '.$this->line.'<br/>';
      			parent::__construct($message);
    		}
		public function get_message(){
    			return $this->message;
    		}
  }
 /**
 * Класс исключения возникающего при ошибке шаблонизации
 */
 class TemplateException extends Exception{

    	public function __construct($template,$message='[Null]'){
      			$message='<b>Ошибка шаблонизации!</b><br />'
      			.'Шаблон: '.$template.'<br/>'
      			.'Сообщение: '.$message.'<br/>'
      			.'Страница: '.$this->file.'<br/>'
      			.'Строка: '.$this->line.'<br/>';
      			parent::__construct($message);
    		}
		public function get_message(){
    			return $this->message;
    		}
  }
/**
 * Класс исключения возникающего при работе с БД
 */
  class DBException extends Exception{

    	public function __construct($query,$message='[Null]'){
      			$message='<b>Ошибка базы данных!</b><br />'
      			.'Запрос: '.$query.'<br/>'
      			.'Сообщение: '.$message.'<br/>'
      			.'Страница: '.$this->file.'<br/>'
      			.'Строка: '.$this->line.'<br/>';
      			parent::__construct($message);
    		}
		public function get_message(){
    			return $this->message;
    		}
  }
/**
 * Класс исключения возникающго при закрытом доступе
 */
 class AccessException extends Exception{

    	public function __construct($message='[Null]'){
      			$message='<b>Ошибка прав доступа!</b><br />'
      			.'Сообщение: '.$message.'<br/>'
      			.'Страница: '.$this->file.'<br/>'
      			.'Строка: '.$this->line.'<br/>';
      			parent::__construct($message);
    		}
		public function get_message(){
    			return $this->message;
    		}
  }
/**
 * Класс исключения возникающего если требуется авторизация
 */
 class NotAuthException extends Exception{

    	public function __construct($message='[Null]'){
      			$message='<b>Вы не авторизованы! Ошибка прав доступа!</b><br />'
      			.'Сообщение: '.$message.'<br/>'
      			.'Страница: '.$this->file.'<br/>'
      			.'Строка: '.$this->line.'<br/>';
      			parent::__construct($message);
    		}
		public function get_message(){
    			return $this->message;
    		}
  }
/**
 * Класс исключения для создания сообщения
 */
 class MessageException extends Exception{
        public $type=MT_ERROR;
    	public function __construct($message='[Null]',$type=MT_ERROR){
      			parent::__construct($message);
    		}
		public function get_message(){
    			return $this->message;
    		}
  }
/**
 * Класс исключения загрузки кэша
 */
 class CacheLoadException extends Exception{
		public function get_message(){
    			return $this->message;
    		}
  }
?>