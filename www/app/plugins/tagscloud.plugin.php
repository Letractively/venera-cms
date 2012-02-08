<?php
function venus_plugin_tagscloud(){
		$sql='SELECT * FROM '.db::table('tags').' ORDER BY tID LIMIT 300;';
  		$sqlres=db::query($sql);
        if(db::num_rows($sqlres)==0) return FALSE;
        while($tag=db::fetch_array($sqlres))
			include(TDIR.'views/plugins/tagscloud.php');
	}

?>