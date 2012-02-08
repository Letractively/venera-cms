<?php
/**
 * Отправка сообщений электронной почты
 * 
 * @category   Email
 * @package    Email
 * @author     Ildar Usmanov <wajox@mail.ru>
 * @copyright  Copyright (c) 2009-2012 Wajox Software (http://wajox.myglonet.com)
 * 
 */

/**
 * Класс для отправки сообщений электронной почты
 */
class email{
	private $encoding;
	private $type;
	private $to;
	private $from;
	private $reply;
	
	/**
	* Конструктор класса
	*
	* @param mixed $to получатель или получатели в виде массива адресов эл.почты
	* @param string $from отправитель
	* @param string $reply получатель ответа
	* @param string $encoding кодировка
	* @param string $type MIME тип сообщения
	* @method __construct() __construct(mixed $to,string $from,string $reply,string $encoding='utf-8',string $type='text/html')
	*/
	public function __construct($to,$from,$reply,$encoding='utf-8',$type='text/html'){
		$this->encoding=$encoding;
		$this->type=$type;
		$this->to=$to;
		$this->from=$from;
		$this->reply=$reply;
	}

	/**
	* Отправка сообщения
	*
	* @param string $subject тема сообщений
	* @param string $message текст сообщения
	* @method send() send($subject,$message)
	*/
	public function send($subject,$message){
		$tolst=$this->to;
		if(!is_array($tolst)) $tolst=array($tolst);
		foreach($tolst as $i=>$to)
			if(!mail($to,$subject,$message,$this->headers())) throw new MessageException(lt('emailsenderror'),MT_ERROR);
	}
	private function headers(){
		$headers="MIME-Version: 1.0"."\r\n";
		$headers.="From: ".$this->from."\r\n";		
		$headers.="Content-type: ".$this->type."; charset=".$this->encoding."\r\n";
		return $headers;
	}
}
?>