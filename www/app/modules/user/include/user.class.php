<?php

class user{
	public $login='';
	public $name='';
	public $sername='';
	public $password='';
	public $email='';
	public $uID=0;
	public $securecode='';
	public $gID=UT_GUEST;
	public $active=TRUE;
	public $code='';
	public $data;
	public function initFromArray($arr){//загрузка данных
//из массива
		foreach($arr as $name=>$value)
			if(property_exists($this,$name)){
					$this->$name=$value;
					unset($arr[$name]);
				}
		$this->data=$arr;
	}
	public function loadToArray(){//"выгрузка" данных
//пользователя в массив
		$arr["login"]=$this->login;
		$arr["name"]=$this->name;
		$arr["password"]=$this->password;
		$arr["email"]=$this->email;
		$arr["uID"]=$this->uID;
		$arr["securecode"]=$this->securecode;
		$arr["gID"]=$this->gID;
		$arr["active"]=$this->active;
		$arr["code"]=$this->code;
		$arr["sername"]=$this->sername;
		return $arr;
	}
	public function loadById(){
			$query='SELECT * FROM `'.db::table('users').'` WHERE `uID`="'.$this->uID.'" LIMIT 1;';
			$r=db::query($query);
			if(db::num_rows($r)!=1) return FALSE;
			$this->initFromArray(db::fetch_array($r));
			return TRUE;
		}
	public function isAdmin(){
 			return ($this->gID==UT_ADMIN);
	}

	public function isUser(){
			return ($this->gID==UT_USER);
	}
	public function isModerator(){
			return ($this->gID==UT_MODERATOR);
	}
	public function isGuest(){
			return ($this->gID==UT_GUEST);
	}
}
?>