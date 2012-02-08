<div class="ui-widget-content"  style="width:683px;padding:10px; margin:10px;float:left;">
<img src="<?php echo THEME.'/img/modules.png';?>" style="float:right;"/>
<?php
foreach($modules as $i=>$module)echo '<b>'.__l('admin/'.$module['name'],$module['title']).'</b><br/><small>'.$module['description'].($module['system']==1?'<br/><i>[system]</i>':'').'</small><br/>';
?>
<div style="clear:both;"></div>
</div>