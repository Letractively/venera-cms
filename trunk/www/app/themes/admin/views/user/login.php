<?php
if(core::$user['gID']!=UT_GUEST){
		echo '<h2>'.lt('yourprofile').'</h2>';
		echo '<br/><b>'.lt('login').':</b>'.core::$user->login.'<br/>';
		echo '<b>'.lt('email').':</b>'.core::$user->email;
	}else{
echo '<h2>'.lt('authorization').'</h2>';
?>
<form action="<?php _l('user/login');?>" method="post">
<input name="system_login" type="hidden" value="true">
<?php _lt('login');?>:<br/>
<input name="login" type="text" value=""><br />
<?php _lt('password');?>:<br/>
<input name="password" type="password" value=""><br />
<input type="submit" value="<?php _lt('loginbtn');?>">
</form>
<h2><?php _lt('forgotpassword');?></h2>
<form action="<?php _l('user/action/restorepassword');?>" method="post">
<?php _lt('insertloginoremail');?><br />
<input name="loginoremail" type="text" value="">
<input type="submit">
</form>
<?php
	}
?>