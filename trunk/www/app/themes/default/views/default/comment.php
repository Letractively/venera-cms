<h3 class="element_list_item_title"><a href="#">Re:<?php echo l('default/element/'.$element->eFurl);?></a></h3>
<div class="element_list_item">
Element: <?php echo __l('default/element/'.$element->eFurl,l('default/element/'.$element->eFurl),'_blank');?><br/>
Posted by: <?php echo $comment->cALogin;?><br/>
Text:<?php echo $comment->cText;?><br/>
<?php echo lt('created').':'.date('d/m/Y H:i:s',$comment->cCDate);?>
<?php
if($comment->cCDate!=$comment->cUDate){
		echo ' '.lt('updated').':'.date('d/m/y h:i:s',$comment->cUDate);
	}
?>
<div class="element_list_item_bar">
<?php
echo (dispatcher::$module->access('eCMPermissions')  and intval($comment->cActive!=1))? __l('default/action/approve_comment/'.$comment->cID,'<span class="ui-icon ui-icon-check" title="'.lt('approve').'"></span>'):'';
echo (dispatcher::$module->access('eECPermissions'))? __l('default/action/edit_comment/'.$comment->cID,'<span class="ui-icon ui-icon-pencil" title="'.lt('edit').'"></span>'):'';
echo (dispatcher::$module->access('eDCPermissions'))? __l('default/action/drop_comment/'.$comment->cID,'<span class="ui-icon ui-icon-close" title="'.lt('delete').'"></span>'):'';
?>
</div>
</div>