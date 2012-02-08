<?php
/**
 * Библиотека для работы с базами данных
 * 
 * файл содержит классы для работы с БД, для работы с БД используется PDO
 * 
 * @category   Database
 * @package    Database
 * @author     Ildar Usmanov <wajox@mail.ru>
 * @copyright  Copyright (c) 2009-2012 Wajox Software (http://wajox.myglonet.com)
 * 
 */
 
/**
 * Дочерний класс PDO для работы с БД
 *
 * Данный класс наследник класса PDO. Изменены функции для работы с транзакциями для PHP<5.3.0
 */
class DbPDO extends PDO{
	public $mytrasnsopen=false;
	public function beginTransaction(){
		$this->mytrasnsopen=true;
		parent::beginTransaction();
	}
	public function commit(){
		$this->mytrasnsopen=false;
		parent::commit();
	}
	public function rollback(){
		$this->mytrasnsopen=false;
		parent::rollback();
	}
	public function inTransaction(){
		return $this->mytrasnsopen;
	}
}

/**
 * Статический класс для работы с БД
 *
 * Класс db представляет доступ к БД. Используется для выполнения запросов к БД и их обработки.
 * @static
 */
class db{
		/**
		* Массив с объектами DbPDO для каждой БД
		* @var array
		*/
		static public $links;
		
		/**
		* Индекс активной базы данных
		* @var string
		*/
		static public $activeDB;
		
		/**
		* Драйвер PDO активной базы данных используемый для подключения
		* @var string
		*/
		static public $driver;
		
		/**
		* Адрес сервера активной базы данных используемый для подключения
		* @var string
		*/
		static public $server;
		
		/**
		* Имя активной базы данных используемый для подключения
		* @var string
		*/
		static public $name;
		
		/**
		* Имя пользователя активной базы данных  используемое для подключения
		* @var string
		*/
		static public $username;

		/**
		* Пароль пользователя активной базы данных  используемый для подключения
		* @var string
		*/
		static public $password;
		
		/**
		* Префикс таблиц в БД используемый в активной базе данных
		* @var string
		*/		
		static public $prefix;
		
		/**
		* Кодировка используемая для работы с БД
		* @var string
		*/	
		static public $encoding;

		/**
		* Флаг подключения с БД
		* @var bool
		*/		
		static public $connected=FALSE;

		/**
		* Массив запросов для выполнения при подключении к базе
		* @var array
		*/
		static public $init_query=null;
		
		/**
		* Массив выполненных запросов
		* @var array
		*/
		static public $q;
/*		
		static public $cache=array();
		static public $cachepath='';
		static public $cachelive=0;
		static public $cachestarted=FALSE;*/
		
		/**
		* Метод загрузки конфигурации для подключения к БД
		*
		* @param string $db индекс базы данных в конфигурации
		*/		
		static public function load_settings($db='default'){
				self::$driver=core::$settings['dbset']['databases'][$db]['driver'];
				self::$server=core::$settings['dbset']['databases'][$db]['server'];
				self::$name=core::$settings['dbset']['databases'][$db]['name'];
				self::$username=core::$settings['dbset']['databases'][$db]['username'];
				self::$password=core::$settings['dbset']['databases'][$db]['password'];
				self::$prefix=core::$settings['dbset']['databases'][$db]['prefix'];
				self::$encoding=core::$settings['dbset']['databases'][$db]['encoding'];
				self::$init_query=core::$settings['dbset']['databases'][$db]['init_query'];
				/*self::$cachepath=core::$settings['dbset']['databases'][$db]['cachepath'];
				self::$cachelive=core::$settings['dbset']['databases'][$db]['cachelive'];*/
				self::$activeDB=$db;
			}

		/**
		* Метод подключения к БД 
		*/	
        public function connect(){
        		if(!isset(self::$links[self::$activeDB])){
        				$dsn=self::$driver.':host='.self::$server.';dbname='.self::$name.';charset='.self::$encoding;
						try{
							self::$links[self::$activeDB]=new DbPDO($dsn,self::$username,self::$password);
							if(self::$init_query!=null and is_array(self::$init_query) and count(self::$init_query)>0){
								foreach(self::$init_query as $i=>$query)
									self::$links[self::$activeDB]->exec($query);
							}
						}catch(PDOException $e){
							throw new DBException($e->getMessage());
						}
					}
        		self::$connected=TRUE;
        		return TRUE;
        	}
		/**
		* Метод для открытия транзакции
		*
		* @param bool $all флаг указывает открыть ли транзакцию для всех БД, по умолчанию true
		*/	
		public function start_ta($all=true){			
				if(!$all){
					if(!self::$links[self::$activeDB]->inTransaction())  
						return self::$links[self::$activeDB]->beginTransaction();
				}
				foreach(self::$links as $k=>$i)
					if(!self::$links[$k]->inTransaction()) 
						self::$links[$k]->beginTransaction();
				
			}
		/**
		* Метод для выполнения транзакции
		*
		* @param bool $all флаг указывает выполнить ли транзакцию для всех БД, по умолчанию true
		*/
		public function commit_ta($all=true){
				if(!$all){
					if(self::$links[self::$activeDB]->inTransaction())  
						return self::$links[self::$activeDB]->commit();
				}
				foreach(self::$links  as $k=>$i)
					if(self::$links[$k]->inTransaction()) 
						self::$links[$k]->commit();
			}
		/**
		* Метод для отката транзакции
		*
		* @param bool $all флаг указывает выполнить ли откат транзакции для всех БД, по умолчанию true
		*/
		public function rollback_ta($all=true){
				if(!$all){
					if(self::$links[self::$activeDB]->inTransaction())  
						return self::$links[self::$activeDB]->rollback();
				}
				foreach(self::$links as $k=>$i)
					if(self::$links[$k]->inTransaction()) 
						self::$links[$k]->rollback();
			}
		/**
		* Выполнение запроса к активной БД
		*
		* @param string $query запрос
		* @return int 
		*/
		public function exec($query){
				return self::$links[self::$activeDB]->exec($query);
			}	
		/**
		* Подготовка запроса к БД перед выполнением
		*
		* @param string $query запрос
		* @return PDOStatement
		* @method PDOStatement prepare() prepare(string $query)
		*/			
		public function prepare($query){
				return self::$links[self::$activeDB]->prepare($query);
			}

		/**
		* Отправка запроса к активной БД
		*
		* @param string $query запрос
		* @param array $params параметры запроса
		* @return PDOStatement
		* @method PDOStatement query() query(string $query, array $params)
		*/	
		public function query($query,$params=array()){
        		$q=self::$links[self::$activeDB]->prepare($query);
				$q->execute($params);
        		return $q;
        	}
			
		/**
		* Отправка массива запросов к активной БД
		*
		* @param array $arr массив запросов
		*/	
		public function query_array($arr){
				if(!is_array($arr)) return FALSE;
				foreach($sqlarr as $i=>$query) self::query($arr['query'],$arr['params']);
			}
		/**
		* Отправка запроса к активной БД и получение одной строки результата в виде массива
		*
		* @param string $query запрос
		* @param array $params параметры запроса
		* @return array
		* @method array select_array() select_array(string $query, array $params)
		*/	
		public function select_array($query,$params=array()){
				$q=self::query($query,$params);
				return $q->fetch();
			}
			
		/**
		* Отправка запроса к активной БД и получение всех строк результата
		*
		* @param string $query запрос
		* @param array $params параметры запроса
		* @return array
		* @method array select_array_collection() select_array_collection(string $query, array $params)
		*/	
		public function select_array_collection($query,$params=array()){
				$q=self::query($query,$params);
				return $q->fetchAll();
			}
			
		/**
		* Получение одной строки результата запроса 
		*
		* @param PDOStatement $q запрос
		* @return array
		* @method array fetch_array() fetch_array(PDOStatement $q)
		*/	
        public function fetch_array($q){
        		return $q->fetch();
        	}
		/**
		* Получение одной строки результата запроса в виде ассоциативного массива
		*
		* @param PDOStatement $q запрос
		* @return array
		* @method array fetch_array_assoc() fetch_array_assoc(PDOStatement $q)
		*/
        public function fetch_array_assoc($q){
        		return $q->fetch(PDO::FETCH_ASSOC);
        	}
		/**
		* Получение одной строки результата запроса в виде немерованного массива
		*
		* @param PDOStatement $q запрос
		* @return array
		* @method array fetch_array_num() fetch_array_num(PDOStatement $q)
		*/
        public function fetch_array_num($q){
        		return $q->fetch(PDO::FETCH_NUM);
        	}
		/**
		* Получение количества строк результата выполнения запроса
		*
		* @param PDOStatement $q запрос
		* @return int
		* @method int num_rows() num_rows(PDOStatement $q) количество строк результата запроса
		*/
        public function num_rows($q){
        		return $q->rowCount();
        	}
		/**
		* Получение количества строк изменённых запросом
		*
		* @param PDOStatement $q запрос
		* @return int
		* @method int affected_rows() affected_rows(PDOStatement $q) количество строк затронутых запросом
		*/
		public function affected_rows($q){
				return $q->rowCount();
			}
		/**
		* Получение последнего идентификатора добавленной в таблицу записи
		*
		* @return int
		*/
		public function insert_id(){
				return self::$links[self::$activeDB]->lastInsertId();
			}
		/**
		* Получение информации об ошибке БД
		*
		* @return string
		*/
        public function error(){
				if(self::$links[self::$activeDB]->errorCode()==null) return;
        		return self::$links[self::$activeDB]->errorCode().':'.self::$links[self::$activeDB]->errorInfo();
        	}
		/**
		* Смена активной БД
		* @param $newdb индекс БД в конфигурации
		* @return string 
		* @method bool chdb() chdb(string $newdb) смена активной БД
		*/
        private function chdb($newdb){
        		if(self::$activeDB==$newdb) return FALSE;
        		self::load_settings($newdb);
        		self::connect();
        		return TRUE;
        	}

		/**
		* Установка настроек для БД для использования таблицы $table. Возвращает полное имя таблицы.
		* 
		* @param string table
		* @return string 
		* @method string table() table(string $table) смена талбицы и получение её полного имени
		*/
        public function table($table){
        		if(isset(core::$settings['dbset']['tables'][$table]))
						self::chdb(core::$settings['dbset']['tables'][$table]);
        		else
        				self::chdb('default');
        		return self::$prefix.$table;
        	}
			/*
		public function cache_start($unickey){
			if(self::$cachelive==0) return FALSE;
			self::$cachestarted=TRUE;
		}
		private function cache_update($sql,$data){
			if(self::$cachelive==0) return FALSE;
			$f=fopen(self::$cachepath.'/'.md5($sql),'w+');
			fwrite($f,serialize($data));
			fclose($f);
		}
		private function cache_get($sql){
			if(self::$cachelive==0) return FALSE;
			if(!file_exists(self::$cachepath.'/'.md5($sql))) return FALSE;
			if(time()-filemtime(self::$cachepath.'/'.md5($sql))>self::$cachelive) return FALSE;
			return unserialize(file_get_contents(self::$cachepath.'/'.md5($sql)));
		}
		public function cache_end(){
			if(self::$cachelive==0) return FALSE;
			self::$cache=array();
			self::$cachestarted=TRUE;
		}*/
	}
?>