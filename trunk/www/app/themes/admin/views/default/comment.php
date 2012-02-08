<h3 class="element_list_item_title"><a href="#"><table><tr><td valign="middle"><img src="<?php echo THEME.'img/comment.png';?>" height="32px"/></td><td valign="middle">Re: <?php echo $comment->cETitle;?></td></tr></table></a></h3>
<div class="element_list_item">
URL: <?php echo __l('default/element/'.$element->eFurl,l('default/element/'.$comment->cEFurl),'_blank');?><br/>
Posted by: <?php echo $comment->cALogin;?><br/>
Text:<?php echo $comment->cText;?><br/>
<?php echo lt('created').': '.date('d/m/Y H:i:s',$comment->cCDate);?>
<?php
if($comment->cCDate!=$comment->cUDate){
		echo '<br/>'.lt('updated').': '.date('d/m/y h:i:s',$comment->cUDate);
	}
?>
<div class="element_list_item_bar">
<?php
echo (access('moderate_comments')  and intval($comment->cActive!=1))? __l('admin/default/action/approve_comment/'.$comment->cID,'<img src="'.THEME.'img/approve.png" title="'.lt('approve').'"/>'):'';
echo (access('edit_comments'))? __l('admin/default/action/edit_comment/'.$comment->cID,'<img src="'.THEME.'img/edit.png" title="'.lt('edit').'"/>'):'';
echo (access('delete_comments'))? __l('admin/default/action/drop_comment/'.$comment->cID,'<img src="'.THEME.'img/delete.png" title="'.lt('delete').'"/>'):'';
?>
</div>
</div>