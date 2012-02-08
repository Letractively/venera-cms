<?php
/**
 * Библиотека работы с формами
 *
 * @category   Forms
 * @package    Forms
 * @author     Ildar Usmanov <wajox@mail.ru>
 * @copyright  Copyright (c) 2009-2012 Wajox Software (http://wajox.myglonet.com)
 */
 
/**
 * Идентификатор текстового поля формы
 */
define('TEXT_FIELD_TYPE',1);
/**
 * Идентификатор многострочного текстового поля формы
 */
define('TEXTAREA_FIELD_TYPE',2);
/**
 * Идентификатор многострочного текстового поля с wysiwyg формы
 */
define('HTML_TEXTAREA_FIELD_TYPE',3);
/**
 * Идентификатор поля формы для загрузки файлов
 */
define('FILE_FIELD_TYPE',4);
/**
 * Идентификатор поля формы выбора select
 */
define('SELECT_FIELD_TYPE',5);
/**
 * Идентификатор поля формы чекбокса
 */
define('CHECKBOX_FIELD_TYPE',6);
/**
 * Идентификатор поля формы группы чекбоксов
 */
define('CHECKBOXGROUP_FIELD_TYPE',6);
/**
 * Идентификатор поля формы для ввода даты
 */
define('DATE_FIELD_TYPE',7);
/**
 * Идентификатор поля формы radio
 */
define('RADIOCOLLECTION_FIELD_TYPE',8);
/**
 * Идентификатор поля формы для rfgxb
 */
define('CAPTCHA_FIELD_TYPE',9);
/**
 * Идентификатор скрытого поля формы
 */
define('HIDDEN_FIELD_TYPE',10);
/**
 * Идентификатор поля формы для ввода пароля
 */
define('PASSWORD_FIELD_TYPE',11);
/**
 * Идентификатор поля формы для загрузки файлов изображения
 */
define('IMAGE_FILE_FIELD_TYPE',12);
/**
 * Идентификатор поля формы для выбора города
 */
define('SELECTCITY_FIELD_TYPE',13);


/**
 * Идентификатор валидации текста без html
 */
define('TEXT_TYPE',1);
/**
 * Идентификатор валидации url
 */
define('URL_TYPE',2);
/**
 * Идентификатор валидации html
 */
define('HTML_TYPE',3);
/**
 * Идентификатор валидации e-mail
 */
define('EMAIL_TYPE',4);
/**
 * Идентификатор валидации изображения
 */
define('IMAGE_TYPE',5);
/**
 * Идентификатор валидации файла
 */
define('FILE_TYPE',6);
/**
 * Идентификатор валидации даты
 */
define('DATE_TYPE',7);
/**
 * Идентификатор валидации капчи
 */
define('CAPTCHA_TYPE',8);
/**
 * Идентификатор валидации чисел
 */
define('NUMERIC_TYPE',9);
/**
 * Идентификатор валидации bool
 */
define('BOOL_TYPE',10);
/**
 * Идентификатор валидации дроби
 */
define('FLOAT_TYPE',11);
/**
 * Идентификатор валидации целых чисел
 */
define('INT_TYPE',12);
/**
 * Идентификатор валидации файла изображения
 */
define('IMAGE_FILE_TYPE',13);
/**
 * Идентификатор валидации поля выбора города
 */
define('CITY_TYPE',14);


/**
 * Получение html кода текстового поля
 */
function get_text_field_html($field){
		$attr='';
		if(is_array($field->attr))
				foreach($field->attr as $n=>$v)
							$attr.=' '.$n.'="'.$v.'"';
		return '<input name="'.$field->name.'" type="text" id="'.$field->name.'" value="'.$field->value.'"'.$attr.'/>';
	}
/**
 * Получение html кода поля для ввода пароля
 */
function get_password_field_html($field){
		$attr='';
		if(is_array($field->attr))
				foreach($field->attr as $n=>$v)
							$attr.=' '.$n.'="'.$v.'"';
		return '<input name="'.$field->name.'" id="'.$field->name.'" type="password" value="'.$field->value.'"'.$attr.'/>';
	}
/**
 * Получение html кода поля для многострочного текста
 */
function get_textarea_field_html($field){
		$attr='';
		if(is_array($field->attr))
				foreach($field->attr as $n=>$v)
							$attr.=' '.$n.'="'.$v.'"';
		return '<textarea name="'.$field->name.'" id="'.$field->name.'"'.(isset($field->options['cols'])?' cols="'.$field->options['cols'].'" ':'').(isset($field->options['rows'])?' rows="'.$field->options['rows'].'" ':'').' '.$attr.'>'.$field->value.'</textarea>';
	}
/**
 * Получение html кода поля для многострочного текста с HTML WYSIWYG
 */
function get_html_textarea_field_html($field){
		venus_head_part(array('type'=>'js','src'=>BASEURL.'app/js/jquery/jquery.js'));
		venus_head_part(array('type'=>'js','src'=>BASEURL.'app/js/jquery/jqueryui.js'));
		venus_head_part(array('type'=>'css','src'=>BASEURL.'app/js/jquery/custom.css'));
		venus_head_part(array('type'=>'js','src'=>BASEURL.'app/js/elrte/js/elrte.min.js'));	
		venus_head_part(array('type'=>'js','src'=>BASEURL.'app/js/elrte/js/i18n/elrte.ru.js'));
		venus_head_part(array('type'=>'css','src'=>BASEURL.'app/js/elrte/css/elrte.min.css'));
		$script='
			$().ready(function() {
			var opts = {
				cssClass : "el-rte",
				// lang     : "ru",
				height   : 450,
				toolbar  : "complete",
				cssfiles : ["'.BASEURL.'app/js/elrte/css/elrte-inner.css"]
			}
			$(".venus_wysiwyg_area").elrte(opts);
			$(".el-rte .toolbar .panel-save").hide();
			})';
		venus_head_part(array('type'=>'js','text'=>$script));
		$attr='';
		if(is_array($field->attr))
				foreach($field->attr as $n=>$v)
							$attr.=' '.$n.'="'.$v.'"';
		return '<textarea class="venus_wysiwyg_area" id="'.$field->name.'" cols="'.$field->options['cols'].'" rows="'.$field->options['rows'].'" name="'.$field->name.'"'.$attr.'>'.$field->value.'</textarea>';
	}
/**
 * Получение html кода поля для чекбокса
 */
function get_checkbox_field_html($field){
		$attr='';
		if(is_array($field->attr))
				foreach($field->attr as $n=>$v)
							$attr.=' '.$n.'="'.$v.'"';
		return '<input type="checkbox" name="'.$field->name.'" id="'.$field->name.'" value="'.$field->value.'" '.((isset($field->options['checked']) and $field->options['checked'])?' checked="true" ':'').$attr.'/>';
	}
/**
 * Получение html кода поля для группы чекбоксов
 */
function get_checkboxgroup_field_html($field){
		$result='';
		foreach($field->options['items'] as $k=>$v){
				$v['checked']=(isset($v['checked']))?$v['checked']:FALSE;
				$result.='<input type="checkbox" value="'.$v['value'].'" name="'.$field->name.'[]" '.(($v['checked'] or $v['value']==$field->value)?' checked="true" ':'').'/><label>'.$v['caption'].'</label>';
			}
		return $result;
	}
/**
 * Получение html кода поля для radio
 */
function get_radio_field_html($field){
		$result='';
		$attr='';
		if(is_array($field->attr))
				foreach($field->attr as $n=>$v)
							$attr.=' '.$n.'="'.$v.'"';

		foreach($field->options['items'] as $k=>$v){
				$v['checked']=isset($v['checked'])?$v['checked']:FALSE;
				$result.=' <input type="radio"  name="'.$field->name.'" id="'.$field->name.'" value="'.$v['value'].'" '.(($v['checked'] or $field->value==$v['value'])?' checked="true" ':'').' '.$attr.'/>'.$v['caption'].'<br/>';
			}
		return $result;	
	}
/**
 * Получение html кода поля для скрытого поля
 */
function get_hidden_field_html($field){
		return '<input type="hidden" name="'.$field->name.'" id="'.$field->name.'"  value="'.$field->value.'"/>';
	}
/**
 * Получение html кода поля для select поля
 */
function get_select_field_html($field){
		$attr='';
		if(is_array($field->attr))
				foreach($field->attr as $n=>$v)
							$attr.=' '.$n.'="'.$v.'"';
		$field->options['size']=isset($field->options['size'])?$field->options['size']:1;
		$result='<select name="'.$field->name.'" id="'.$field->name.'" size="'.$field->options['size'].'"'.$attr.'>';
		foreach($field->options['items'] as $k=>$v){
				$v['disabled']=isset($v['disabled'])?$v['disabled']:FALSE;
				$v['selected']=(isset($v['selected']))?$v['selected']:FALSE;
				$result.='<option value="'.$v['value'].'" '.($v['disabled']?' disabled="true" ':'').(($v['selected'] or $field->value==$v['value'])?' selected="true" ':'').'>'.$v['caption'].'</option>';
			}
		$result.='</select>';
		return $result;
	}
/**
 * Получение html кода поля для даты
 */
function get_date_field_html($field){
		$field->options['start_year']=isset($field->options['start_year'])?$field->options['start_year']:intval(date('Y'));
		$field->options['end_year']=isset($field->options['end_year'])?$field->options['end_year']:intval(date('Y'));
		if(isset($field->options['end_date'])){
				$enddate=explode('.',$field->options['end_date']);//date must be have dd.mm.yyyy format           
		}
		$field->options['day']=isset($field->options['day'])?$field->options['day']:0;
		$field->options['month']=isset($field->options['month'])?$field->options['month']:0;
		$result='<select name="'.$field->name.'[]" >';
		for($i=1;$i<32;$i++){
				$result.='<option value="'.$i.'" '.($field->options['day']==$i?' selected="true" ':'').'>'.$i.'</option>';
			}
		$result.='</select>';
		$result.='<select name="'.$field->name.'[]">';
		$endmonth=($field->options['start_year']==$field->options['end_year'] and isset($field->options['end_month']))?$field->options['end_month']:12;
		$startmonth=($field->options['start_year']==$field->options['end_year'] and isset($field->options['start_month']))?$field->options['start_month']:1;
		for($i=$startmonth;$i<=$endmonth;$i++){
				$result.='<option value="'.$i.'" '.($field->options['month']==$i?' selected="true" ':'').'>'.$i.'</option>';
			}
		$result.='</select>';
		$result.='<select name="'.$field->name.'[]" >';
		for($i=$field->options['end_year'];$i>=$field->options['start_year'];$i--){
				$result.='<option value="'.$i.'" '.($field->options['year']==$i?' selected="true" ':'').'>'.$i.'</option>';
			}
		$result.='</select>';
		return $result;
	}
/**
 * Получение html кода поля для загруузки файла
 */
function get_file_field_html($field){
		$file=($field->value!='' and file_exists($field->value))?'<br/>'.basename($field->value).'('.round(filesize($field->value)/1024,2).' kb)':'';
		$delete=($field->value!='' and file_exists($field->value) and $field->minsize==0)?'<input type="checkbox" name="'.$field->name.'_delete" value="true"/>'.lt('delete'):'';
	 	return '<input name="'.$field->name.'" id="'.$field->name.'" type="file"/>'.$file.$delete.'';
	}
/**
 * Получение html кода поля для загруузки файла изображения
 */
function get_imagefile_field_html($field){
		$img='';
		if($field->value!='' and file_exists($field->value)){
			$improp=getimagesize($field->value);
			$size='';
			if(isset($field->options['form_width']) and $improp[0]>$field->options['form_width']){
				$size.=' width="'.$field->options['form_width'].'" ';
			}
			if(isset($field->options['form_height']) and $improp[1]>$field->options['form_height']){
				$size.=' height="'.$field->options['form_height'].'" ';
			}
			$img='Image size:'.$improp[0].'x'.$improp[1].'<br/><a href="'.BASEURL.$field->value.'" target="_blank"><img src="'.BASEURL.$field->value.'" '.$size.' border="0"/></a><br/>';
		}
		$delete=($field->value!='' and file_exists($field->value) and $field->minsize==0)?'<br/><input type="checkbox" name="'.$field->name.'_delete" value="true"/>'.lt('delete'):'';
	 	return $img.'<input name="'.$field->name.'" id="'.$field->name.'" type="file"/>'.$delete.'';
	}
/**
 * Получение html кода поля для капчи
 */
function get_captcha_field_html($field){
		return '<img src="'.$field->options['src'].'"  width="'.$field->options['width'].'"  height="'.$field->options['height'].'" id="'.$field->name.'_src" OnClick="this.src=\''.$field->options['src'].'\';" alt="Click to reload" title="Click to reload"/><br/><input id="'.$field->name.'" name="'.$field->name.'" type="text"/>';
	}
/**
 * Получение html кода поля для выбора города
 */
function get_selectcity_field_html($field){
		$html_cities=$html_regions='';
		venus_head_part(array('type'=>'js','src'=>BASEURL.'app/js/ajax.js'));
		venus_head_part(array('type'=>'js','src'=>BASEURL.'app/js/cityselect.js'));
		$html='<div id="'.$field->name.'_city_select">';
		$selected=array('country'=>0,'region'=>0,'city'=>0);
		if($field->value!=0){
			$r=db::query('SELECT * FROM `'.db::table('cities').'` WHERE `cityID`='.intval($field->value).' ORDER BY `city_pos`, `city_title`;');
			if(db::num_rows($r)>0){
				$city=db::fetch_array_assoc($r);
				$selected['city']=$city['cityID'];
				$selected['region']=$city['city_region'];
				$selected['country']=$city['city_country'];
				$r=db::query('SELECT * FROM `'.db::table('regions').'` WHERE `region_country`='.$city['city_country'].' ORDER BY `region_pos`, `region_title`;');
				if(db::num_rows($r)>0){
					$html_regions='<div id="'.$field->name.'_city_region" style="display:inline;"><select id="'.$field->name.'_city_region_id" name="'.$field->name.'_city_region" onChange="venus_select_city(\''.$field->name.'\');">';
					$html_regions.='<option value="0">...</option>';
					while($rgn=db::fetch_array_assoc($r)) $html_regions.='<option value="'.$rgn['regionID'].'"'.($selected['region']==$rgn['regionID']?' selected="true" ':'').'>'.$rgn['region_title'].'</option>';
					$html_regions.='</select></div>';
				}
			}
		}
		$r=db::query('SELECT * FROM `'.db::table('countries').'` ORDER BY `country_pos`, `country_title`;');
		if(db::num_rows($r)>0){
				$html.='<select id="'.$field->name.'_city_country_id" name="'.$field->name.'_city_country" onChange="venus_select_city(\''.$field->name.'\');">';
				$html.='<option value="0">...</option>';
				while($cnt=db::fetch_array_assoc($r))$html.='<option value="'.$cnt['countryID'].'"'.($selected['country']==$cnt['countryID']?' selected="true" ':'').'>'.$cnt['country_title'].'</option>';
				$html.='</select>';
				
			}
		if($selected['country']!=0){
			if($selected['country']!=0 or $selected['region']!=0){
				$where='`city_country`='.$selected['country'].' AND `city_region`=0';
				if($selected['region']!=0){
					$where='(`city_country`='.$selected['country'].' AND `city_region`=0)OR(`city_country`='.$selected['country'].' AND `city_region`='.$selected['region'].')';
				}
				$r=db::query('SELECT * FROM `'.db::table('cities').'` WHERE '.$where.' ORDER BY `city_pos`, `city_title`;');
				$html_cities='';
				if(db::num_rows($r)>0){
						$html_cities.='<div id="'.$field->name.'" style="display:inline;"><select name="'.$field->name.'">';
						$html_cities.='<option value="0">...</option>';
						while($ct=db::fetch_array_assoc($r))$html_cities.='<option value="'.$ct['cityID'].'"'.($selected['city']==$ct['cityID']?' selected="true" ':'').'>'.$ct['city_title'].'</option>';
						$html_cities.='</select></div>';
					}
			}
		}
		$html_regions=$html_regions==''?'<div id="'.$field->name.'_city_region"  style="display:none;"></div>':$html_regions;
		$html_cities=$html_cities==''?'<div id="'.$field->name.'"  style="display:none;"></div>':$html_cities;
		$html.=$html_regions.$html_cities.'</div>';
		return $html;
	}

	

/**
 * Валидация текста без html
 */
function validate_text($field){
		if(empty($field->value) and $field->options['minsize']==0) return TRUE;
    	return ( strlen(strip_tags($field->value))<strlen($field->value)) ? FALSE : TRUE;
	}
/**
 * Валидация html
 */
function validate_html($field){
    	return TRUE;
	}
/**
 * Валидация даты
 */
function validate_date($field){
		if(intval($field->value[2])>$field->options['end_year'] or intval($field->value[2])<$field->options['start_year']) return FALSE;
    	return checkdate(intval($field->value[1]), intval($field->value[0]), intval($field->value[2]));
	}
/**
 * Валидация чисел
 */
function validate_numeric($field){
		if(empty($field->value) and $field->options['minsize']==0) return TRUE;
		return ( ! is_numeric($field->value)) ? FALSE : TRUE;
	}
/**
 * Валидация целых чисел
 */
function validate_int($field){
		if(empty($field->value) and $field->options['minsize']==0) return TRUE;
		return ( ! is_int($field->value) or ! validate_size($field)) ? FALSE : TRUE;
	}
/**
 * Валидация булева типа
 */
function validate_bool($field){
		if(empty($field->value) and $field->options['minsize']==0) return TRUE;
		return ( ! is_bool((boolean)$field->value)) ? FALSE : TRUE;
	}
/**
 * Валидация числа с плавающей точкой
 */
function validate_float($field){
		if(empty($field->value) and $field->options['minsize']==0) return TRUE;
		return ( ! is_float($field->value) or ! validate_size($field)) ? FALSE : TRUE;
	}
/**
 * Валидация адреса URL
 */
function validate_url($field){
		if(empty($field->value) and $field->options['minsize']==0) return TRUE;
		return ( ! preg_match("/^(ftp:\/\/|http:\/\/|http:\/\/www\.|www\.|.*?)([a-zA-Z0-9=%\+\&\#\?\_\-\.\/]*)$/ix", $field->value) or ! validate_size($field)) ? FALSE : TRUE;
	}
/**
 * Валидация email
 */
function validate_email($field){
		if(empty($field->value) and $field->options['minsize']==0) return TRUE;
		return ( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $field->value) or ! validate_size($field)) ? FALSE : TRUE;
	}
/**
 * Валидация капчи
 */
function validate_captcha($field){
		if(!isset($_SESSION[$field->name])) return FALSE;
		$value=$_SESSION[$field->name];
		$_SESSION[$field->name]=null;
		unset($_SESSION[$field->name]);
		return (($value!=md5($field->value)) ? FALSE : TRUE);
	}
/**
 * Валидация изображения
 */
function validate_image($field){
		return TRUE;
	}
/**
 * Валидация длины текста
 */
function validate_size($field){
		if($field->type==FILE_FIELD_TYPE or $field->type==DATE_FIELD_TYPE or $field->type==IMAGE_FILE_FIELD_TYPE or $field->type==SELECTCITY_FIELD_TYPE) return TRUE;
		if($field->maxsize==0 and $field->minsize==0)	return TRUE;
		if(mb_strlen($field->value)>$field->maxsize and $field->maxsize!=0)	return FALSE;
		if(mb_strlen($field->value)<$field->minsize  and $field->minsize!=0) return FALSE;
		return TRUE;
	}
/**
 * Валидация города
 */
function validate_city($field){
		if(empty($field->value) and $field->options['minsize']==0) return TRUE;
		if(!is_numeric($field->value)) return FALSE;
		$r=db::query('SELECT * FROM `'.db::table('cities').'` WHERE `cityID`='.intval($field->value).';');
		if(db::num_rows($r)==0 and $field->minsize!=0) return FALSE;
		return TRUE;
}


/**
 * Фильтр очистки крайних пробелов
 */
function filter_trim($field)
	{
			return trim($field->value);
	}
/**
 * Фильтр очистки пути
 */
function filter_dir($field)
    {
        return dirname((string) $field->value);
    }
/**
 * Фильтр целых чисел
 */
function filter_int($field)
    {
        return (int) ((string) $field->value);
    }
/**
 * Фильтр дробных чисел
 */
function filter_float($field)
    {
        return floatval($field->value);
    }
/**
 * Фильтр очистки переносов строки
 */
function filter_stripnewlines($field)
	{
		return str_replace(array("\n", "\r"), '', $field->value);	
	}
/**
 * Фильтр цифр
 */
function filter_digit($field)
    {
       if (extension_loaded('mbstring')) {
            // Filter for the value with mbstring
            $pattern = '/[^[:digit:]]/';
        } else {
            // Filter for the value without mbstring
            $pattern = '/[\p{^N}]/';
        }
        return preg_replace($pattern, '', (string) $field->value);
    }
/**
 * Фильтр тегов
 */
function filter_striptags($field)
	{
		return strip_tags($field->value,$field->options['striptags']);
	}
/**
 * Фильтр преборазования спец символов html
 */
function filter_htmlspecialchars($field)
	{
		return htmlspecialchars($field->value);
	}
/**
 * Фильтр очистки пробелов
 */
function filter_stripwhitespaces($field)
	{
		return str_replace("\s",'',$field->value);
	}
/**
 * Фильтр букв
 */
function filter_alpha($field)
	{
		$pattern = '/[^\p{L}' . $whiteSpace . ']/u';
		return preg_replace($pattern, '', (string) $field->value);
	}
/**
 * Фильтр длины
 */
function filter_size($field)
	{
		if($field->maxsize==0) return $field->value;
		return mb_substr($field->value,0,$field->maxsize);
	}
	
/**
 * Класс поля формы
 */
class CFormField{
		/**
		 * Заголовок поля
		 */
		public $caption='Field';
		/**
		 * Имя поля
		 */
		public $name;
		/**
		 * Значение поля
		 */
		public $value='';
		/**
		 * Валидатор поля
		 */
		public $validation=1;
		/**
		 * По умолчанию
		 */
		public $default=null;
		/**
		 * Фильтры поля
		 */
		public $filters='';
		/**
		 * Тип поля
		 */
		public $type=1;
		/**
		 * Минимальный размер поля
		 */
		public $minsize=0;
		/**
		 * Максимальный размер поля
		 */
		public $maxsize=0;
		/**
		 * Подсказка
		 */
		public $help='';
		/**
		 * Опции поля
		 */
		public $options=array();
		/**
		 * Флаг валидации
		 */
		public $validated=TRUE;
		/**
		 * Атрибуты поля
		 */
		public $attr=array();
		/**
		 * Конструктор
		 * @param array $arr описание свойств поля
		 */
		function __construct($arr){
				foreach($arr as $k=>$v)
					if(property_exists($this,$k))
						$this->$k=$v;
				return TRUE;
			}
		/**
		 * Фильтрация поля
		 */
		public function filter(){
				if(empty($this->filters)) return FALSE;
				$filters=explode(',',$this->filters);
				if(!is_array($filters)) $filters=array($filters);
				foreach($filters as $i=>$filter){
					if(!function_exists('filter_'.$filter)) throw new MessageException('Filter not found!');
					$_GET[$this->name]=$_REQUEST[$this->name]=$_POST[$this->name]=$this->value=call_user_func('filter_'.$filter,$this);
				}
				
		}
		/**
		 * Валидация поля
		 */
		public function validate(){
				$this->validated=TRUE;
				$this->filter();
				if(validate_size(&$this)){
					switch($this->validation){
							case HTML_TYPE:$this->validated=validate_html(&$this);break;
                        	case TEXT_TYPE:$this->validated=validate_text(&$this);break;
                        	case URL_TYPE:$this->validated=validate_url(&$this);break;
                        	case EMAIL_TYPE:$this->validated=validate_email(&$this);break;
                        	case IMAGE_TYPE:$this->validated=validate_image(&$this);break;
							case CITY_TYPE:$this->validated=validate_city(&$this);break;
							case IMAGE_FILE_TYPE:
                  					if(isset($_POST[$this->name.'_delete']) and $this->minsize==0 and file_exists($this->value)){
											unlink($this->value);
											$_POST[$this->name]=$this->value='';
											$this->validated=TRUE;
											break;
										}
                        			$file=new CFormFieldImageFile(&$this);
									if(!$file->validate(&$this)) break;
									$this->validated=TRUE;
									if($file->upload()) $_POST[$this->name]=$this->value=$file->path;
									
                        		break;
                        	case FILE_TYPE:
                  					if(isset($_POST[$this->name.'_delete']) and $field->minsize==0 and file_exists($this->value)){
											unlink($this->value);
											$_POST[$this->name]=$this->value='';
											$this->validated=TRUE;
											break;
										}
                        			$file=new CFormFieldFile(&$this);
									if(!$file->validate(&$this)) break;
									$this->validated=TRUE;
									if($file->upload()) $_POST[$this->name]=$this->value=$file->path;

                        		break;
                        	case BOOL_TYPE:$this->validated=validate_bool(&$this);break;
                        	case DATE_TYPE:$this->validated=validate_date(&$this);break;
                        	case CAPTCHA_TYPE:$this->validated=validate_captcha(&$this);break;
                        	case NUMERIC_TYPE:$this->validated=validate_numeric(&$this);break;
                        	case FLOAT_TYPE:$this->validated=validate_float(&$this);break;
                        	case INT_TYPE:$this->validated=validate_int(&$this);break;
                        	default:$this->validated=TRUE;break;
						}
					}else{

						$this->validated=FALSE;
					}
				if(!$this->validated){
						$this->value='';
						return;
					}
				if($this->type==SELECT_FIELD_TYPE or $this->type==RADIOCOLLECTION_FIELD_TYPE){
						foreach($this->options['items'] as $i=>$item){
								if(isset($item['disabled']) and $item['disabled'] and $item['value']==$this->value){
										$this->validated=FALSE;
								}
								if($item['value']==$this->value) return;			
							}
						$this->validated=FALSE;
						$this->value='';
						return;
					}
				
			}
		/**
		 * Получение html кода поля
		 */
		public function get_html(){
				switch($this->type){
						case TEXT_FIELD_TYPE:return get_text_field_html(&$this);break;
						case TEXTAREA_FIELD_TYPE:return get_textarea_field_html(&$this);break;
						case HTML_TEXTAREA_FIELD_TYPE:return get_html_textarea_field_html(&$this);break;
                        case FILE_FIELD_TYPE:return get_file_field_html(&$this);break;
						case IMAGE_FILE_FIELD_TYPE:return get_imagefile_field_html(&$this);break;
                        case SELECT_FIELD_TYPE:return get_select_field_html(&$this);break;
                        case CHECKBOX_FIELD_TYPE:return get_checkbox_field_html(&$this);break;
						case CHECKBOXGROUP_FIELD_TYPE:return get_checkboxgroup_field_html(&$this);break;
                        case DATE_FIELD_TYPE:return get_date_field_html(&$this);break;
                        case RADIOCOLLECTION_FIELD_TYPE:return get_radio_field_html(&$this);break;
                        case CAPTCHA_FIELD_TYPE:return get_captcha_field_html(&$this);break;
                        case HIDDEN_FIELD_TYPE:return get_hidden_field_html(&$this);break;
                        case PASSWORD_FIELD_TYPE:return get_password_field_html(&$this);break;
						case SELECTCITY_FIELD_TYPE:return get_selectcity_field_html(&$this);break;
                        default:return '';break;
					}
			}
	}
/**
 * Класс поля формы для загрузки файлов
 */
class CFormFieldFile{
		/**
		 * название поля формы
		 * @var string
		 */	
		public $field;
		/**
		 * Размер файла в байтах
		 * @var int
		 */
		public $size;
		/**
		 * Расширение файла
		 * @var string
		 */
		public $ext;
		/**
		 * Путь к файлу
		 * @var string
		 */
		public $path;
		/**
		 * Имя файла
		 * @var string
		 */
		public $name;
		/**
		 * Тип файла
		 * @var string
		 */
		public $type;
		/**
		 * Каталог для загрузки файлов
		 * @var string
		 */
		public $upload_dir='uploads';
		/**
		 * Префикс используемый при генерации уникального имени файола
		 * @var string
		 */
		public $prefix='file_';
		/**
		 * Флаг генерации уникального имени файла
		 * @var string
		 */
		public $unique=TRUE;
		/**
		 * Разрешённые расширения файлов
		 * @var string
		 */
		public $allow_ext;
		/**
		 * Значение поля
		 * @var string
		 */
		public $value;
		/**
		 * Конструктор поля
		 * @param CFormField поле формы
		 */
		public function __construct($field){
				$this->field=$field->name;
				$this->upload_dir=$field->options['upload_dir'];
				$this->unique=$field->options['unique'];
				$this->allow_ext=$field->options['allow_ext'];
				$this->prefix=$field->options['prefix'];
				$this->value=$field->value;
			}
		/**
		 * Валидация файла
		 * @param CFormField поле формы
		 * @return bool
		 */			
		public function validate($field){
			$this->get_extbyname();
			if($field->minsize>0 and isset($_POST[$field->name.'_delete'])) return FALSE;
			if($_FILES[$this->field]['error']>0 and $_FILES[$this->field]['error']<4 and $field->minsize==0) return FALSE;
			if($field->minsize>0 and $_FILES[$this->field]['error']!=0) return FALSE;
			if(intval($field->maxsize)<intval($_FILES[$this->field]['size'])) return FALSE;
			if(!stristr($this->allow_ext,$this->ext)){ return FALSE;}
			return TRUE;
		}
		/**
		 * Метод загрузки файла
		 * @return bool
		 */
		public function upload(){
				if(!isset($_FILES[$this->field])) return FALSE;
				if($_FILES[$this->field]['error']!=0) return FALSE;
				$this->get_extbyname();
				if(empty($this->path)) $this->path=$this->upload_dir.'/'.(($this->unique)?basename(tempnam($this->upload_dir,$this->prefix),'.tmp').$this->ext:basename($_FILES[$this->field]['name']));
				$this->size=$_FILES[$this->field]['size'];
				$this->type=$_FILES[$this->field]['type'];
				$this->name=$_FILES[$this->field]['name'];
				if(file_exists($this->value)) unlink($this->value);
				return move_uploaded_file($_FILES[$this->field]['tmp_name'],$this->path);
			}
		/**
		 * Метод удаления файла
		 */
		public function delete_file(){
				return unlink($this->path);
			}
		/**
		 * Получение расширения загруженного файла
		 * @return string
		 */
		public function get_extbyname(){
		    	$this->ext='.'.substr(strrchr($_FILES[$this->field]['name'], '.'), 1);
			}
	}
/**
 * Класс поля формы для загрузки изображений
 */
class CFormFieldImageFile{
		/**
		 * название поля формы
		 * @var string
		 */	
		public $field;
		/**
		 * Размер файла в байтах
		 * @var int
		 */
		public $size;
		/**
		 * Расширение файла
		 * @var string
		 */
		public $ext;
		/**
		 * Путь к файлу
		 * @var string
		 */
		public $path;
		/**
		 * Имя файла
		 * @var string
		 */
		public $name;
		/**
		 * Тип файла
		 * @var string
		 */
		public $type;
		/**
		 * Каталог для загрузки файлов
		 * @var string
		 */
		public $upload_dir='uploads';
		/**
		 * Префикс используемый при генерации уникального имени файола
		 * @var string
		 */
		public $prefix='file_';
		/**
		 * Флаг генерации уникального имени файла
		 * @var string
		 */
		public $unique=TRUE;
		/**
		 * Разрешённые расширения файлов
		 * @var string
		 */
		public $allow_ext=';.jpg;.gif;.png;.bmp;';
		/**
		 * Максимальный размер изображения по ширине
		 * @var int
		 */
		public $max_width=0;
		/**
		 * Максимальный размер изображения по высоте
		 * @var int
		 */
		public $max_height=0;
		/**
		 * Значение поля
		 * @var string
		 */
		public $value='';
		/**
		 * Имя файла
		 * @var string
		 */
		public $filename=null;
		/**
		 * Конструктор поля
		 * @param CFormField поле формы
		 */
		public function __construct($field){
				$this->value=$field->value;
				$this->field=$field->name;
				$this->upload_dir=isset($field->options['upload_dir'])?$field->options['upload_dir']:$this->upload_dir;
				$this->unique=isset($field->options['unique'])?$field->options['unique']:$this->unique;
				$this->allow_ext=isset($field->options['allow_ext'])?$field->options['allow_ext']:$this->allow_ext;
				$this->prefix=isset($field->options['prefix'])?$field->options['prefix']:$this->prefix;
				$this->max_width=isset($field->options['max_width'])?$field->options['max_width']:$this->max_width;
				$this->max_height=isset($field->options['max_height'])?$field->options['max_height']:$this->max_height;
				$this->filename=isset($field->options['filename'])?$field->options['filename']:$this->filename;			
			}
		/**
		 * Валидация поля формы
		 * @param CFormField
		 */
		public function validate($field){
			$this->get_extbyname();
			if($field->minsize>0 and isset($_POST[$field->name.'_delete'])) return FALSE;
			if($_FILES[$this->field]['error']>0 and $_FILES[$this->field]['error']<4 and $field->minsize==0) return FALSE;
			if($field->minsize>0 and $_FILES[$this->field]['error']!=0) return FALSE;
			if(intval($field->maxsize)<intval($_FILES[$this->field]['size'])) return FALSE;
			if(!stristr($this->allow_ext,$this->ext)) return FALSE;
			return TRUE;
		}
		/**
		 * Метод загрузки файла изображения
		 */
		public function upload(){
				if(!isset($_FILES[$this->field])) return FALSE;
				if($_FILES[$this->field]['error']!=0) return FALSE;
				$this->get_extbyname();
				if(empty($this->path)){
					if($this->unique)
						$this->path=$this->upload_dir.'/'.basename(tempnam($this->upload_dir,$this->prefix),'.tmp').'.jpg';
					else
						$this->path=$this->upload_dir.'/'.$this->filename;
				}
				$this->size=$_FILES[$this->field]['size'];
				$this->type=$_FILES[$this->field]['type'];
				$this->name=$_FILES[$this->field]['name'];
				$tmpname=$_FILES[$this->field]['tmp_name'];
				$improp=getimagesize($tmpname);
				if($this->max_width!=0 and $this->max_height!=0){
					if($improp[0]>$this->max_width or $improp[1]>$this->max_height){
						switch($improp[2]){
							case '1':$src=imagecreatefromgif($tmpname);//GIF
							break;
							case '2':$src=imagecreatefromjpeg($tmpname);//JPEG
							break;
							case '3':$src=imagecreatefrompng($tmpname);//PNG
							break;
							case '6':$src=imagecreatefrombmp($tmpname);//BMP
							break;
							case '15':$src=imagecreatefromwbmp($tmpname);//WBMP
							break;
							default: return FALSE;
						}
					
						if($improp[0]>$improp[1] and $improp[0]>$this->max_width){
							//if width biger than height
							$ratio=$improp[0]/$this->max_width;
							$w=$this->max_width;
							$h=round($improp[1]/$ratio);
							$dest = imagecreatetruecolor($w,$h); 
							imagecopyresized($dest, $src, 0, 0, 0, 0, $w, $h, $improp[0], $improp[1]);
							if($h>$this->max_height)$h=$this->max_height;
							$img = imagecreatetruecolor($w,$h); 
							imagecopy ($img , $dest , 0 , 0 , 0 , 0 , $w , $h);
						}elseif($improp[1]>$improp[0] and $improp[1]>$this->max_height){
							//if width not biger than height
							$ratio=$improp[1]/$this->max_height;
							$h=$this->max_height;
							$w=round($improp[0]/$ratio);
							$dest = imagecreatetruecolor($w,$h); 
							imagecopyresized($dest, $src, 0, 0, 0, 0, $w, $h, $improp[0], $improp[1]);
							if($w>$this->max_width)	$w=$this->max_width;
							$img = imagecreatetruecolor($w,$h); 
							imagecopy ($img , $dest , 0 , 0 , 0 , 0 , $w , $h);
						}else{
							$img = imagecreatetruecolor($this->max_width,$this->max_height); 
							imagecopy ($img , $dest , 0 , 0 , 0 , 0 , $this->max_width , $this->max_height);
						}
						if(file_exists($this->value)) unlink($this->value);
						$res=imagejpeg($img, $this->path);
						imagedestroy($img);
						imagedestroy($dest);
						imagedestroy($src);
						return $res;
					}
				}
				if(file_exists($this->value)) unlink($this->value);
				//echo $_FILES[$this->field]['tmp_name'].'-'.$this->path;
				return move_uploaded_file($_FILES[$this->field]['tmp_name'],$this->path);
			}
		/**
		 * Метод удаления файла изображения
		 */
		public function delete_file(){
				return unlink($this->path);
			}
		/**
		 * Метод расширения файла изображения
		 * @return string
		 */
		public function get_extbyname(){
		    	$this->ext='.'.substr(strrchr($_FILES[$this->field]['name'], '.'), 1);
			}
	}
/**
 * Класс для генерации ID форм
 *
 */	
class CFormID{
	/**
	 * id
	 * @var int
	 */
	static private $id;
	/**
	 * Получение id формы
	 * @return int
	 */	
	static public function get(){
		return self::$id++;
	}
}
/**
 * Класс для генерации и валидации форм
 *
 * @abstract
 */
abstract class CForm{
		/**
		 * Шаблон формы
		 * @var string
		 */
		public $tpl='form.php';		
		/**
		 * Поля формы
		 * @var array
		 */
		public $fields=array();
		/**
		 * Скрытые поля формы
		 * @var array
		 */
		public $hiddens=array();
		/**
		 * Поля формы с именованными индексами
		 * @var array
		 */
		public $fieldsn=array();
		/**
		 * Метод отправки формы
		 * @var string
		 */
		public $method='POST';
		/**
		 * Имя формы
		 * @var string
		 */
		public $name='form_name';
		/**
		 * Способ кодирования данных формы при их отправке на сервер
		 * @var string
		 */
		public $enctype='application/x-www-form-urlencoded';
		/**
		 * Фрейм формы
		 * @var string
		 */		
	    public $target='_self';
		/**
		 * Адрес отправки формы
		 * @var string
		 */	
	    public $action='index.php';
		/**
		 * Флаг валидации формы
		 * @var bool
		 */	
	    public $validated=TRUE;
		/**
		 * Флаг отправки формы в автоматически сгенерированный фрейм
		 * @var bool
		 */	
	    public $autoframe=FALSE;
		/**
		 * Вкладки формы
		 * @var array
		 */	
	    public $tabs;
		/**
		 * Флаг зашиты формы от повторной отправки
		 * @var bool
		 */	
	    public $sec=TRUE;
		/**
		 * Флаг зашиты формы капчей
		 * @var bool
		 */	
		public $captcha=FALSE;
		/**
		 * Ключ для защиты от автоотправки
		 * @var string
		 */
	    public $sc;
		/**
		 * Имя ключа для защиты от автоотправки
		 * @var string
		 */
	    public $sfn;
		/**
		 * Генерация ключа для защиты от автоотправки и капчи
		 */
	    public function sec(){
				if($this->sec){
					srand(microtime()*77777);
					$this->sfn='sfn_'.rand();
					srand(microtime()*10000);
					$this->sc=rand();
					$_SESSION['form_sec'][$this->sfn]=$this->sc;
					$this->add_field(array('name'=>'sec_sfn','value'=>$this->sfn,'type'=>HIDDEN_FIELD_TYPE,'validation'=>TEXT_TYPE));
					$this->add_field(array('name'=>'sec_sc','value'=>$this->sc,'type'=>HIDDEN_FIELD_TYPE,'validation'=>TEXT_TYPE));
				}
				if($this->captcha) $this->add_field(array('caption'=>lt('captcha'),'name'=>'captcha_code','type'=>CAPTCHA_FIELD_TYPE,'validation'=>CAPTCHA_TYPE,'minsize'=>1,'options'=>array('src'=>le('captcha.php'),'width'=>220,'height'=>100),'help'=>lt('captchad')));
	    }
		/**
		 * Добавление поля в форму
		 * @param array $arr массив с поисание добавляемого в форму поля 
		 * @return bool
		 * @method bool add_field() add_field(array $farr)
		 */
	  	public function add_field($farr){
	  			if(isset($farr['type']) and $farr['type']==HIDDEN_FIELD_TYPE){
	  			    	$this->hiddens[count($this->hiddens)]=new CFormField($farr);
	  			    	return TRUE;
	  				}
	  			$i=count($this->fields);
	  			$farr['tab']=isset($farr['tab'])?$farr['tab']:'main';
	  			$this->fields[$i]=new CFormField($farr);
				$this->fieldsn[$farr['name']]=$i;
				if(!isset($this->tabs[$farr['tab']])) $this->tabs[$farr['tab']]=array();
	  			$this->tabs[$farr['tab']][count($this->tabs[$farr['tab']])]=$i;
	  			if(isset($farr['type']) and ($farr['type']==FILE_FIELD_TYPE or $farr['type']==IMAGE_FILE_FIELD_TYPE)) $this->enctype='multipart/form-data';
	  			return TRUE;
	  		}
		/**
		 * Валидация данных формы
		 * @param array $data
		 * @return bool
		 * @method bool validate() validate(array $data) проверяет массив данных $data
		 */ 
	 	public function validate($data){
				 $this->validated=TRUE;
	 			 if($this->sec){
	 			 		if(!isset($data['sec_sfn']) or !isset($data['sec_sc']) or !isset($_SESSION['form_sec'][$data['sec_sfn']]) or $_SESSION['form_sec'][$data['sec_sfn']]!=$data['sec_sc']){
							$data['sec_sfn']=$data['sec_sc']=$_SESSION[$data['sec_sfn']]=null;
							unset($_SESSION['form_sec'],$data['sec_sfn'],$data['sec_sc']);
	 			 			$this->validated=FALSE;
	 			 			return FALSE;
	 					}
	 					$data['sec_sfn']=$data['sec_sc']=$_SESSION[$data['sec_sfn']]=null;
	 					unset($_SESSION['form_sec'],$data['sec_sfn'],$data['sec_sc']);
	 			 	}
	 			 $this->validated=TRUE;
	 			 foreach($this->fields as $k=>$field){
						$field->options['minsize']=isset($field->options['minsize'])?$field->options['minsize']:0;
						$field->options['maxsize']=isset($field->options['maxsize'])?$field->options['maxsize']:0;
						if($field->type!=FILE_FIELD_TYPE AND $field->type!=IMAGE_FILE_FIELD_TYPE) $field->value=isset($data[$field->name])?$data[$field->name]:'';;
						$field->validate();
	 			 		if(!$field->validated){
							$this->validated=FALSE;
							$_GET[$field->name]=$_REQUEST[$field->name]=$_POST[$field->name]=$field->value='';
							venus_error(lt('incorrect_formfield').' "'.$field->caption.'"!');
						}else{
							$_GET[$field->name]=$_REQUEST[$field->name]=$_POST[$field->name]=$field->value;
						}
	 			 	}
	 			 foreach($this->hiddens as $k=>$field){
						$field->options['minsize']=isset($field->options['minsize'])?$field->options['minsize']:0;
						$field->options['maxsize']=isset($field->options['maxsize'])?$field->options['maxsize']:0;
						$field->value=isset($data[$field->name])?$data[$field->name]:'';
	 			 		$field->validate();
	 			 		if(!$field->validated){$this->validated=FALSE;}
	 			 	}
				return $this->validated;
	 		}
		/**
		 * Получение html кода скрытых полей
		 * @return string
		 */
		public function get_hidden(){
			if(!is_array($this->hiddens) or count($this->hiddens)==0) return '';
			$r='';
			foreach($this->hiddens as $i=>$field){
			    	$r.=$field->get_html();
				}
			return $r;
		}
		/**
		 * Получение или вывод html-кода формы
		 * @param bool $show флаг вывода формы на экран
		 * @return string
		 */
		public function html($show=true){
				if($show){ 
					include(TDIR.$this->tpl);
					return;
				}
				ob_start();
				include(TDIR.$this->tpl);
				return ob_get_clean();
			}
		/**
		 * Получение объекта поля формы по названию
		 * @param string $name имя поля
		 * @return mixed
		 */
		public function get_field($name){
				return $this->fields[$this->fieldsn[$name]];
			}
	}
?>