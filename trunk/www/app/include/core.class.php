<?php
/**
 * Ядро системы
 *
 * Ядро системы отвечает за каркас приложения. 
 * В нём производятся все основные функции по организации конфигурирования и работы системы. 
 *
 * @category   Core
 * @package    Core
 * @author     Ildar Usmanov <wajox@mail.ru>
 * @copyright  Copyright (c) 2009-2012 Wajox Software (http://wajox.myglonet.com)
 * @version 0.15
 */

/**
 * Класс ядра системы
 * @static
 */
class core{
		/**
		 * Пользователь системы
		 *
		 * Массив содержит информацию о текущем пользователе системы.
		 *
		 * @var array
		 */
		static public $user=array();
		/**
		 * Установки
		 *
		 * Массив со всеми установками системы
		 * @var array
		 */
		static public $settings;
		/**
		 * Версия системы
		 * @var float
		 */
		static public $version='0.15';
		/**
		 * Название типа системы
		 * @var string
		 */
		static public $version_type='Basis';
		/**
		 * Запрос страницы
		 * @var array
		 */		
		static public $query=array();
		/**
		 * HTTP-заголовки страницы
		 * @var array
		 */
		static private $HTTP_HEADERS=array();
		/**
		 * Переменные реестра системы
		 * 
		 * Через данный массив "проходят" все переменные системы
		 * установка переменной произвоится с помощью функции venus_set()
		 * получение переменной производится с помощью функции venus_get() 
		 *
		 * @var array
		 */
		static public $vars=array('page_title'=>'','page_meta_description'=>'','page_meta_keywords'=>'');
		/**
		 * Массив ошибок системы
		 * @var array
		 */
		static public $errors=array();
		/**
		 * Таблица прав доступа системы
		 * @var array
		 */
		static public $actable=array();
		/**
		 * Таблица опций системы
		 * @var array
		 */
		static public $options=array();
		/**
		 * Данные <head> страницы
		 * @var array
		 */
		static public $head=array();
		/**
		 * Контент страницы
		 * @var string
		 */
		static public $content='';
		/**
		 * XML данные страницы
		 * @var string
		 */		
		static public $xml='';
		/**
		 * Запуск ядра системы
		 *
		 * @param string $site имя сайта для которого запускается ядро, указывается в файле настроек
		 */
		public function run($site='default'){
				ob_start();
				self::include_system_files();
				try{
					self::init_settings($site);
					self::init_session();
                    self::init_headers();
					self::init_language();
					self::init_user();
					self::module();
					self::send_headers();
					venus_view();			
            	}catch(NotAuthException $e){
					if(isGuest()) self::add_header("Location: ".l('user/login'));
					self::send_headers();
					echo 'error';
				}catch(Exception $e){
            		self::send_headers();
					echo '<!--';
					print_r($e);
					echo '-->';
					exit('error');
				}
				ob_end_flush();
			}
		/**
		 * Подключение файлов системы
		 */
		private function include_system_files(){
				include(ADIR.'include/language.lib.php');
				include(ADIR.'include/forms.lib.php');
				include(ADIR.'include/database.lib.php');
				include(ADIR.'include/exceptions.lib.php');
				include(ADIR.'include/query.functions.php');
				include(ADIR.'include/registry.inc.php');
				include(ADIR.'include/view.inc.php');
				include(ADIR.'include/user.inc.php');
				include(ADIR.'include/ac.inc.php');
				include(ADIR.'include/options.inc.php');
				include(ADIR.'include/stpl.class.php');
				include(ADIR.'include/email.class.php');
				include(ADIR.'include/breadcrumbs.class.php');
				include(ADIR.'include/pdata.functions.php');
				include(ADIR.'include/rubric.inc.php');
				include(ADIR.'include/files.inc.php');
				include(ADIR.'include/cache.inc.php');
			}
		/**
		 * Установка сессии
		 */
		private function init_session(){
				session_set_cookie_params(time()+3600*24*365, '/'); 			
				session_start();
		}
		/**
		 * Загрузка и установка конфигураций
		 */
		private function init_settings($site){
				self::set_mode();
				include('settings.php');
				define('SDIR',ADIR.'settings/sites/'.$_SETTINGS['sites'][$site]['settings'].'/');
				include(SDIR.'db.php');
				include(SDIR.MODE.'.php');
				include(SDIR.'etypes.php');
				self::$settings=$_SETTINGS;
				define('DOMAIN',core::$settings['interface']['domain']);
				define('BASEURL','http://'.DOMAIN.'/');
				define('FURL',core::$settings['interface']['furl']);
				define('EDIR',ADIR.'ext/');
				define('ENCODING',core::$settings['interface']['encoding']);
				$o=isset($_GET['output'])?$_GET['output']:'phptpl';
				switch($o){
		            	case 'phptpl': 	
								define('THEME',BASEURL.'app/themes/'.core::$settings['interface']['theme'].'/');
								define('TDIR',ADIR.'themes/'.self::$settings['interface']['theme'].'/');
							break;
						case 'ajax':
								define('THEME',BASEURL.'app/themes/'.core::$settings['interface']['theme'].'/ajax/');
								define('TDIR',ADIR.'themes/'.self::$settings['interface']['theme'].'/ajax/');
							break;
						case 'print':
								define('THEME',BASEURL.'app/themes/'.core::$settings['interface']['theme'].'/print/');
								define('TDIR',ADIR.'themes/'.self::$settings['interface']['theme'].'/print/');
							break;
						case 'xml':
								define('THEME',BASEURL.'app/themes/'.core::$settings['interface']['theme'].'/xml/');
								define('TDIR',ADIR.'themes/'.self::$settings['interface']['theme'].'/xml/');
							break;						
						case 'direct':break;
						default: throw new NotFoundException();
				}
				venus_tpl(TDIR.'index.php');
				venus_ctpl(TDIR.'content.php');
				venus_output($o);
			}
		/**
		 * Подключение локализаций
		 */
		private function init_language(){
				if(isset($_GET['l'])){
					$_SESSION['user_lang']=$l=preg_replace('/[^a-zA-Z0-9 -]/','',$_GET['l']);
				}elseif(isset($_SESSION['user_lang'])){
					$l=$_SESSION['user_lang'];
				}else{
					$l=self::$settings['interface']['language'];
				}
				define('LANG',$l);
				language::load($l);
			}
		/**
		 * Инициализация и авторизация пользователя
		 */
		public function init_user(){
				try{
					venus_user_login();
				}catch(DBException $e){
					venus_root_login();
				}
				if(MODE=='admin' and isGuest()){
						self::add_header("Location: ".l('user/login'));
						throw new AccessException();
					}
			}
		/**
		 * Подключение модуля системы
		 */
		private function module(){
				if(defined('EXTENSION')) return extension();				
				self::$query=get_query();
				$mname=preg_replace('/[^a-zA-Z0-9 -]/','',self::$query[0]);
				if(file_exists('app/modules/'.$mname.'/module.php')){
					define('MDIR','app/modules/'.$mname.'/');
    				include(MDIR.'module.php');
					if(function_exists('init_module')) init_module();
    				if(isset(self::$query[1]) and function_exists('module_'.self::$query[1])) call_user_func('module_'.self::$query[1]);
    				elseif(function_exists('module_index')) module_index();
    				else
    					throw new NotFoundException();
    			}else
	    			throw new NotFoundException();
			}
		/**
		 * Инициализации HTTP-заголовков страницы
		 */
		private function init_headers(){
				self::add_header('Content-Type: text/html; charset='.self::$settings['interface']['encoding']);
			}
		/**
		 * Добавление HTTP-заголовков страницы
		 * @param string $header строка заголовка
		 */
        public function add_header($header){
        		self::$HTTP_HEADERS[count(self::$HTTP_HEADERS)]=$header;
        	}
		/**
		 * Отправка HTTP-заголовков страницы
		 */
		public function send_headers(){
				 foreach(self::$HTTP_HEADERS as $i=>$header)
				 	header($header);
			}
		/**
		 * Установкаа режима системы
		 */
		public function set_mode(){
				if(!isset($_GET['q']) or substr($_GET['q'],0,5)!='admin') return define('MODE','default');
				$_GET['q']=substr($_GET['q'],6);
		    	define('MODE','admin');
			}
	}
?>