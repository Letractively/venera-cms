<?php
echo '<li class="menu_item">'.
__l('admin/menu/action/add_item/'.$item['iID'],'<span class="ui-icon ui-icon-plus" title="'.lt('add').'" style="float:left;"></span>').
__l('admin/menu/action/edit_item/'.$item['iID'],'<span class="ui-icon ui-icon-pencil" title="'.lt('edit').'" style="float:left;"></span>').
__l('admin/menu/action/drop_item/'.$item['iID'],'<span class="ui-icon ui-icon-close" title="'.lt('delete').'" style="float:left;"></span>').
$item['iTitle'];

if(count($item['childs'])>0){
		echo '<ul>';
	foreach($item['childs'] as $index=>$item) include(TDIR.'views/menu/item.php');
		echo '</ul>';
	}
echo '</li>';
?>