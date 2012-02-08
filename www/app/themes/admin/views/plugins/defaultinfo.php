<div class="ui-widget-content" style="width:320px;float:left;padding:10px;margin:10px;">
<img src="<?php echo THEME.'/img/contentinfo.png';?>" style="float:left;"/>
	<p>
Approved elements: <?php echo $emCount;?><br/>
Approved comments: <?php echo $cmCount;?><br/>
<?php if($enmCount>0){ ?>
<b><?php echo __l('admin/default/mod_elements',$enmCount);?></b> not moderated elements.<br/>
<?php } ?>
<?php if($cnmCount>0 ){ ?>
<b><?php echo __l('admin/default/mod_comments',$cnmCount);?></b> not moderated comments.<br/>
<?php } ?>
	</p>
<div style="clear:both;"></div>
</div>