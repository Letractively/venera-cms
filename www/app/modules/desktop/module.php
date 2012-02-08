<?php
function module_index(){
			if(MODE!='admin') throw new AccessException();
			breadcrumbs::$items=array(array('url'=>l('admin'),'title'=>lt('crumb_admin')),array('url'=>l('admin/desktop'),'title'=>lt('crumb_desktop')));
        	venus_ctpl(TDIR.'views/desktop/index.php');
		}
?>