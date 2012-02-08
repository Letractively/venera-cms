<?php
if(!isGuest()){
		echo '<h2>'.__l('user/action/info',core::$user['name'].' '.core::$user['login'].' '.core::$user['sername']).'</h2>';		
}else{
?>

<div style="padding:30px;">
<h2><?=lt('authorization');?></h2>
<form action="<?php _l('user/login');?>" method="post">
<input name="system_login" type="hidden" value="true">
<?php _lt('email');?>:<br/>
<input name="email" type="text" value="" style="width:500px;font-size:24px;"><br />
<?php _lt('password');?>:<br/>
<input name="password" type="password" value="" style="width:500px;font-size:24px;"><br />
<input type="checkbox" name="rememberme"/><?=lt('rememberme');?><br/>
<input type="submit" value="<?php _lt('loginbtn');?>">
</form>
</div>


<div style="clear:both;"></div>
<h2><?php _lt('forgotpassword');?></h2>
<form action="<?=_l('user/action/restorepassword');?>" method="post">
<?php _lt('insertemail');?><br />
<input name="email" type="text" value="" style="width:450px;font-size:24px;">
<input type="submit">
</form>

<?php
	}
?>