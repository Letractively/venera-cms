<?php
$pelement=&$element;
include(TDIR.'views/default/'.$pelement->eType.'_full.type.php');
if(count($child_elements_list)>0){
?>
<div id="elements_list">
<?php
	foreach($child_elements_list as $i=>&$element){
			include(TDIR.'views/default/'.$element->eType.'_list.type.php');

			}
?>
</div>
<?
		}
?>
<div id="paging">
<?php echo venus_nav_links('admin/default/element/'.$pelement->eFurl.'/{%page%}/'.$pCount,array('pagenow'=>$pNum,'maxpage'=>ceil($child_elements_count/$pCount)-1));?>
</div>
<?php
if($pelement->access('comment')){ ?>
<form action="<?php echo l('default/action/post_comment/'.$pelement->eID).'/create';?>" method="post">
<?php 
foreach($html_comment_form->fields as $i=>&$field)
	echo $field->caption.'<br/>'.$field->get_html().'<br/>';
 
echo $html_comment_form->get_hidden();?>
<input type="submit"><input type="reset">
</form>
<?php }
if($comments_count>0 and access('view_comments')){?>
<h2>Комментарии:</h2><a name="comments"></a>
<?php
	foreach($comments_list as $index=>$comment){?>
<?php
if(!isGuest()){
	echo (access('edit_comments') or $comment->cAID==core::$user['uID'])? __l('default/action/edit_comment/'.$comment->cID,lt('edit')).'&nbsp;&nbsp;':'';
	echo (access('delete_comments')  or $comment->cAID==core::$user['uID'])? __l('default/action/drop_comment/'.$comment->cID,lt('delete')).'&nbsp;&nbsp;':'';
}
?>
<div style="border-color:#777777;background:#FFFFFF;padding:10px;border-style:dotted;border-width:1px;"><b><?php echo $comment->cAName;?></b>: <br/><?php echo $comment->cText;?></div><br/>
<?php		}?>

<?php 
echo venus_nav_links('default/element/'.$pelement->eFurl.'/comments/{%page%}/'.$cpCount.'#comments',array('pagenow'=>$cpNum,'maxpage'=>ceil($comments_count/$cpCount)-1));
 }?>