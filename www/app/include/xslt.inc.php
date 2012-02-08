<?php
/**
 * Функции XSLT шаблонизации
 * 
 * @category   XSLT
 * @package    XSLT
 * @author     Ildar Usmanov <wajox@mail.ru>
 * @copyright  Copyright (c) 2009-2012 Wajox Software (http://wajox.myglonet.com)
 * 
 */
 
/**
 * Функция парсинга XSLT шаблона
 * @param string $xml данные в виде XML
 * @param string $tpl файл XSL-шаблона
 * @return string
 */
function venus_xsltemplate($xml,$tpl){
		$doc = new DOMDocument();
		$doc->   loadXML($xml);
		$xsl = new DomDocument();
		$xsl->   load($tpl);
		$proc = new XsltProcessor();
		$xsl = $proc->   importStylesheet($xsl);
		return $proc->   transformToXML($doc);
	}
?>