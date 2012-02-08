<h3 class="element_list_item_title"><a href="#"><table><tr><td valign="middle"><img src="<?php echo THEME.'img/etype_'.$element->eType.'.png';?>" height="32px"/></td><td valign="middle"><?php echo $element->title;?></td></tr></table></a></h3>
<div class="element_list_item">
<?php echo __l('default/element/'.$element->eFurl,l('default/element/'.$element->eFurl),'_blank');?><br/>
<?php echo lt('created').': '.date('d/m/Y H:i:s',$element->eCDate);?>
<?php if($element->eCDate!=$element->eUDate) echo '<br/>'.lt('updated').': '.date('d/m/y h:i:s',$element->eUDate);?>
<div class="element_list_item_bar">
<?php
if(count($element->subtypes)>0)
	echo ($element->grant_read)? __l('admin/default/element/'.$element->eFurl,'<img src="'.THEME.'img/open_folder.png" title="'.lt('view').'"/>'):'';
echo ($element->grant_comment)? __l('admin/default/action/post_comment/'.$element->eID,'<img src="'.THEME.'img/add_comment.png" title="'.lt('postcomment').'"/>'):'';
echo ($element->eCCount>0)? __l('admin/default/comments/'.$element->eID,'<img src="'.THEME.'img/comments.png" title="'.lt('comments').'"/>'):'';
echo (access('moderate') and $element->eActive!=1)? __l('admin/default/action/approve/'.$element->eID,'<img src="'.THEME.'img/approve.png" title="'.lt('approve').'"/>'):'';
echo ($element->grant_edit)? __l('admin/default/action/edit/'.$element->eID,'<img src="'.THEME.'img/edit.png" title="'.lt('edit').'"/>'):'';
echo ($element->grant_delete)? __l('admin/default/action/drop/'.$element->eID,'<img src="'.THEME.'img/delete.png" title="'.lt('delete').'"/>'):'';
?>
</div>
</div>