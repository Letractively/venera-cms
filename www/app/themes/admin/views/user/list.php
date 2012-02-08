<script type="text/javascript">
	$(function() {
		$("#elements_list").accordion({
			autoHeight: false,
			navigation: true
		});
	});
</script>
<div id="elements_list">
<?php
if(count($users)>0)
	foreach($users	as $index=>&$user){
?>
<h3 class="element_list_item_title"><a href="#"><table><tr><td valign="middle"><img src="<?php echo THEME.'img/user.png';?>" height="32px"/></td><td valign="middle"><?php echo $user->name.' '.$user->login.' '.$user->sername;?></td></tr></table></a></h3>
<div class="element_list_item">
E-mail: <?php echo $user->email;?><br/>
Group: <?php
switch($user->gID){
		case UT_USER:echo 'user';break;
		case UT_MODERATOR:echo 'moderator';break;
		case UT_ADMIN:echo 'admin';break;
	}
?><br/>
Status: <?php echo ($user->active)?'Active':'Inactive';?>
<br/>
<div class="element_list_item_bar">
<?php
if(access('edit_user')){
echo __l('admin/user/action/chpform/'.$user->uID,'<img src="'.THEME.'img/key.png" title="'.lt('change_password').'"/>');
echo __l('admin/user/action/edit/'.$user->uID,'<img src="'.THEME.'img/edit.png" title="'.lt('edit').'"/>');
}
if(access('delete_user'))  echo __l('admin/user/action/drop/'.$user->uID,'<img src="'.THEME.'img/delete.png" title="'.lt('delete').'"/>');
?>
</div>
</div>
<?php
		}
?>
</div>
<div id="paging">
<?php echo venus_nav_links('admin/user/action/userlist/{%page%}/'.$pCount,array('pagenow'=>$pNum,'maxpage'=>ceil($users_count/$pCount)-1));?>

</div>
