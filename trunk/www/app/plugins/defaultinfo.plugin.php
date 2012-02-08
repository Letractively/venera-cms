<?php
function venus_plugin_defaultinfo(){
				//try{
            	//------------------------------------
				$sqlr=db::select_array('SELECT count(*) as cs FROM '.db::table('elements').' WHERE eActive=0  AND ePID>0;');
				$enmCount=$sqlr['cs'];
				$sqlr=db::select_array('SELECT count(*) as cs FROM '.db::table('elements').' WHERE eActive=1;');
				$emCount=$sqlr['cs'];
				$sqlr=db::select_array('SELECT count(*) as cs FROM '.db::table('comments').' WHERE cActive=0 AND cEID>0;');
				$cnmCount=$sqlr['cs'];
				$sqlr=db::select_array('SELECT count(*) as cs FROM '.db::table('comments').' WHERE cActive=1;');
				$cmCount=$sqlr['cs'];
				//}catch(Exception $e){
				//	return;
				//}
				//------------------------------------
				include(TDIR.'views/plugins/defaultinfo.php');
			}
?>