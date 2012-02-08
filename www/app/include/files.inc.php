<?php
/**
 * Набор функций для работы с файлами
 * @static
 * @category   Files
 * @package    Files
 * @author     Ildar Usmanov <wajox@mail.ru>
 * @copyright  Copyright (c) 2009-2012 Wajox Software (http://wajox.myglonet.com)
 */

/**
 * Функция для получения расширения файла по его имени
 * @param string $name
 * @param bool $lowcase
 * @param string $encoding
 * @return string
 */
function venus_filegetext($name,$lowcase=true,$encoding='UTF-8'){
		if(!$lowcase) return '.'.substr(strrchr($name, '.'), 1);
		return mb_convert_case('.'.substr(strrchr($name, '.'), 1), MB_CASE_LOWER, $encoding);
	}
?>