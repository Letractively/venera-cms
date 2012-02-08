<form action="<?php echo _l('admin/modules');?>" method="post">
Module name: <input type="text" name="modname"/><input type="submit" value="install"/>
</form><br/>
<?php
$list=venus_get('list');
foreach($list as $k=>&$module){
echo '<b>'.$module['title'].'</b><br/><small>'.$module['description'].'</small><br/>Version: '.$module['ver'].'<br/>'
.($module['system']==1?'<i>[SYSTEM]</i><br/>':'')
.__l('admin/modules/uninstall/'.$module['name'],'[uninstall]').'<br/><br/>';
}
?>