<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>
<head>
<link rel="shortcut icon" href="/favicon.ico"/>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?=$page_title;?></title>
<meta name="keywords" content="<?=$page_meta_keywords;?>"/>
<meta name="description" content="<?=$page_meta_description;?>"/>
<?php
venus_head_part(array('type'=>'css','src'=>BASEURL.'app/js/jquery/jquery.tooltip.css'));
venus_head_part(array('type'=>'css','src'=>BASEURL.'app/js/jquery/custom.css'));
venus_head_part(array('type'=>'css','src'=>BASEURL.'app/js/jquery/jquery.treeview.css'));
venus_head_part(array('type'=>'js','src'=>BASEURL.'app/js/jquery/jquery.js'));
venus_head_part(array('type'=>'js','src'=>BASEURL.'app/js/jquery/jqueryui.js'));
venus_head_part(array('type'=>'js','src'=>BASEURL.'app/js/ajax.js'));
venus_head_part(array('type'=>'js','src'=>BASEURL.'app/js/cookie.js'));
venus_head_part(array('type'=>'css','src'=>THEME.'styles/style.css'));
venus_head();
?>
</head>
<body>
<div id="main">
<div id="auth">
<? if(isGuest()): ?>
<form action="<?php _l('user/login');?>" method="post">
<input name="system_login" type="hidden" value="true">
<?php _lt('email');?>: 
<input name="email" type="text" value="" style="width:100px;font-size:12px;">
<?php _lt('password');?>: 
<input name="password" type="password" value="" style="width:100px;font-size:12px;">
<input type="checkbox" name="rememberme"/><?=lt('rememberme');?>
<input type="submit" value="<?php _lt('loginbtn');?>">
</form>
<? else: ?>
<a href="<?=l('user/info/'.core::$user['uID']);?>"><?=core::$user['name'].' '.core::$user['login'].' '.core::$user['sername'];?></a>
( <?=(core::$user['newmsg']>0?__l('im',lt('im_inmessages').' ('.core::$user['newmsg'].') ').' | ':'');?><?=__l('user/action/profile',lt('edit'));?> | <?=__l('',lt('exit'),'_self','logout');?> )
<? endif; ?>
</div>
<div id="menu">
<ul>
<? venus_plugin('menu');?>
</ul>
<div style="clear:both;"></div>
</div>
<div id="content">
<? if(venus_have_errors()): ?>
<div class="error_box"><?=implode('<br/>',core::$errors);?></div>
<? else: if(isset($message)): ?>
<div class="message_box"><?=$message;?></div>
<? endif; endif; ?>
<div style="clear:both;"></div>
<? venus_content();?>
<div style="clear:both;"></div>
<? venus_plugin('tagscloud');?>
<div style="clear:both;"></div>
<? venus_plugin('whoonline');?>
</div>
<div style="clear:both;"></div>
</div>
<div id="footer">Powered by <a href="http://wajox.myglonet.com">Venera CMS v.<?=core::$version;?> <?=core::$version_type;?></a><br/>Copyright by Ildar Usmanov<br/>&copy; 2009 - 2012</div>
</body></html>