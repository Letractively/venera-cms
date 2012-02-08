<?php
echo '<li '.(isset($items[$item['iID']]) and count($items[$item['iID']])>0?'class="current_menu_item"':'class="menu_item"').'><a href="'.$item['iUrl'].'">'.$item['iTitle'].'</a>';
if(isset($items[$item['iID']]) and count($items[$item['iID']])>0){
		echo '<ul class="sub_menu">';
	foreach($items[$item['iID']] as $index=>$item) include(TDIR.'views/plugins/menu.php');
		echo '</ul>';
	}
echo '</li>';
?>