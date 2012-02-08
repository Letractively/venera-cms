<div class="menu_items_list">
<?php
echo '<li class="menu_item_root">'.__l('admin/menu/action/add_item/0','<span class="ui-icon ui-icon-plus" title="'.lt('add').'" style="float:left;"></span>').
'Root<ul>';
	foreach(venus_get('menu_items') as $index=>$item)
		include(TDIR.'views/menu/item.php');

?>
</ul>
</li>
</div>