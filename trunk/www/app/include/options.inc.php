<?php
/**
 * Функции для управления настройками
 *
 * @category   Options
 * @package    Options
 * @author     Ildar Usmanov <wajox@mail.ru>
 * @copyright  Copyright (c) 2009-2012 Wajox Software (http://wajox.myglonet.com)
 */
function venus_options_load($name,$value_format='text'){
				$query='SELECT * FROM '.db::table('options').' WHERE name=?;';
				$r=db::query($query,array($name));
				if(db::num_rows($r)!=1) return FALSE;
            	$r=db::fetch_array($r);
            	switch($value_format){
            			case 'json':$r['value']=json_decode($r['value']);break;
            			default:break;
            		}
            	return $r;
			}
function venus_options_create($name,$value){
				$query='INSERT INTO '.db::table('options').'(name,value)VALUES(?,?);';
            	db::query($query,array($name,$value));
			}
function venus_options_update($name,$value){
				$query='UPDATE '.db::table('options').' SET value=? WHERE name=?;';
            	db::query($query,array($value,$name));
			}
function venus_options_drop($name){
				$query='DELETE FROM '.db::table('options').' WHERE name=?;';
            	db::query($query,array($name));
			}

?>