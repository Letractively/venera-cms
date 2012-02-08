<?php
/**
 * Функции работы с распределением прав доступа
 * 
 * @category   Access
 * @package    Access
 * @author     Ildar Usmanov <wajox@mail.ru>
 * @copyright  Copyright (c) 2009-2012 Wajox Software (http://wajox.myglonet.com)
 * 
 */

/**
 * Функция для упаковки в строку информации о доступах
 *
 * @param string $rq_data
 * @param array $items
 * @param int $groupscount 
 * @return string
 */ 
function venus_ac_bydata($rq_data,$items,$groupscount=3){
                $result=array();
				foreach($items as $item=>$index){
						$result[$index]=(intval($rq_data[$item])>=0 and intval($rq_data[$item])<$groupscount)?intval($rq_data[$item]):$groupscount;
					}
				return implode('',$result);
			}

/**
 * Функция для получения группы доступа
 *
 * @param string $item
 * @param array $acval
 * @param array $items 
 * @return int
 */
function venus_ac_byitem($item,$acval,$items){
				return $acval[$items[$item]];
			}

/**
 * Функция для получения флага доступа
 *
 * @param array $acval
 * @param string $item
 * @param int $gID
 * @param array $items 
 * @return bool
 */
function venus_ac_access($acval,$item,$gID=-1,$items){
				$gID=($gID==-1)?core::$user['gID']:$gID;
				return (intval($gID)>=intval($acval[$items[$item]]));
			}

/**
 * Функция для устиановки таблицы прав доступа по значениям групп доступа
 *
 * @param array $acval
 * @param array $items
 * @param int $gID 
 */
function venus_ac_table($acval,$items,$gID=-1){
				$gID=($gID==-1)?core::$user['gID']:$gID;
				foreach($items as $item=>&$v) core::$actable[$item]=(intval($gID)>=intval($acval[$v]));
			}

/**
 * Функция для устиановки таблицы прав доступа
 *
 * @param array $actable
 */
function venus_set_ac_table($actable){
				core::$actable=$actable;
			}

/**
 * Функция для получения флага доступа элемента таблицы прав доступа
 *
 * @param string $item
 * @return bool
 */
function access($item){
				if(!isset(core::$actable[$item])) return FALSE;
				return core::$actable[$item];
			}
?>