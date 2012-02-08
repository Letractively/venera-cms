<?php
echo '<li ><a href="'.$item['iUrl'].'">'.$item['iTitle'].'</a>';
if(isset($items[$item['iID']]) and count($items[$item['iID']])>0){
		echo '<ul>';
	foreach($items[$item['iID']] as $index=>$item) include(TDIR.'views/plugins/menu.php');
		echo '</ul>';
	}
echo '</li>';
?>