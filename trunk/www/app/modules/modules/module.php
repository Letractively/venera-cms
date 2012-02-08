<?php
function init_module(){
			if(!isAdmin() or MODE!='admin') throw new AccessException();
		}
function module_index(){
			venus_ctpl(ADIR.'themes/'.core::$settings['interface']['theme'].'/views/modules/index.php');
			modules_install();
			modules_uninstall();
			$r=db::query('SELECT * FROM '.db::table('modules').' ORDER BY id;');
			$list=array();
			if(db::num_rows($r)>0) while($row=db::fetch_array($r)) $list[]=$row;
			venus_set('list',$list);				
		}
function modules_install(){
			if(!isset($_POST['modname'])) return FALSE;
			$modname=preg_replace('/[^a-zA-Z0-9 -]/','',$_POST['modname']);
			if(modules_exists($modname)) return FALSE;
			include(ADIR.'modules/'.$modname.'/descr.php');
			if(file_exists(ADIR.'modules/'.$modname.'/install.php'))  include(ADIR.'modules/'.$modname.'/install.php');
			modules_module_reg($modname,$module['title'],$module['description'],$module['version'],intval((isset($module['system']) and $module['system']==1)));
		}
function modules_uninstall(){
			if(!isset(core::$query[2])) return FALSE;
			$modname=preg_replace('/[^a-zA-Z0-9 -]/','',core::$query[2]);
			if(!modules_exists($modname)) return FALSE;
			if(file_exists(ADIR.'modules/'.$modname.'/uninstall.php'))include(ADIR.'modules/'.$modname.'/uninstall.php');
			modules_module_unreg($modname);
		}
function modules_exists($modname){
			$r=db::query('SELECT id FROM '.db::table('modules').' WHERE name="'.$modname.'" LIMIT 1;');
			if(db::num_rows($r)==0) return FALSE;
			return TRUE;
		}
function modules_module_reg($name,$title,$descr,$ver,$system){
			$params=array($name,$title,$descr,$ver,$system);
			db::query('INSERT INTO '.db::table('modules').' SET name=?,title=?,description=?,ver=?,system=?;',$params);
			return TRUE;
		}
function modules_module_unreg($name){
			db::query('DELETE FROM '.db::table('modules').' WHERE name=?;',array($name));
			return TRUE;
		}

?>