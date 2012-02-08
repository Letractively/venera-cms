<?php
function venus_plugin_modules(){
		if(!isAdmin() or MODE!='admin') return;
		$sql='SELECT * FROM '.db::table('modules').' ORDER BY id;';
  		$sqlres=db::query($sql);
        if(db::num_rows($sqlres)==0) return FALSE;
        while($module=db::fetch_array($sqlres)) $modules[]=$module;
		include(TDIR.'views/plugins/modules.php');
	}

?>