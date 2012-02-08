<?php /* Smarty version Smarty-3.0.8, created on 2012-01-17 09:34:29
         compiled from "app/themes/myglonet/views/community/default/index.stpl" */ ?>
<?php /*%%SmartyHeaderCode:26124f1540a5f16125-23017761%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4f5b8a5d151fef50096f8be674c4000ce3528494' => 
    array (
      0 => 'app/themes/myglonet/views/community/default/index.stpl',
      1 => 1326792868,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '26124f1540a5f16125-23017761',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>
<head>
<TITLE><?php echo $_smarty_tpl->getVariable('page_title')->value;?>
 <?php echo $_smarty_tpl->getVariable('community')->value['title'];?>
</TITLE>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<meta name="description" content="<?php echo $_smarty_tpl->getVariable('page_meta_description')->value;?>
 <?php echo $_smarty_tpl->getVariable('community')->value['eMDescription'];?>
>">
<meta name="keywords" content="<?php echo $_smarty_tpl->getVariable('page_meta_keywords')->value;?>
 <?php echo $_smarty_tpl->getVariable('community')->value['eMKeywords'];?>
">
<style type="text/css">

body{background:#EEEEEEE;margin:10px;font-family: Arial;}
#main{width:984px;padding:20px;background:#FFFFFF;border-width:1px;border-style:solid;border-color:black;}
#header{width:1006px;padding:9px;background:#EEEEFE;margin-bottom:0px;color:black;border-width:1px;border-style:solid;}
#menu{width:1016px;padding:4px;margin-bottom:0px;background:#AAAAEE;height:25px;border-width:1px;border-style:solid;border-color:black;}
#menu a{color:#000000;font-weight:bold;font-size:12px;}
#menu a:hover{text-decoration:none;color:#0000FF;}
#footer{width:1014px;padding:5px;color:#777777;font-size:12px;}
a{color:#0554A4;}
#error_box{margin:10px;border-style:solid;border-width:1px;border-color:red;padding:10px;}
#message_box{margin:10px;border-style:solid;border-width:1px;border-color:green;padding:10px;}
.fixed{
	position:fixed;;
<!--[if IE]>
	position: absolute;
	top: expression(eval(document.body.scrollTop) + "px");
<![endif]-->
}

</style>
<?php echo $_smarty_tpl->getVariable('head')->value;?>


<script type="text/javascript">
var community=<?php echo $_smarty_tpl->getVariable('community')->value['eID'];?>
;

function community_shop_basket_callback(){
	document.getElementById('shop_basket').innerHTML=cmtyshopbasketmngr.status;
}
cmtyshopbasketmngr.parsedcallback='community_shop_basket_callback';
cmtyshopbasketmngr.update();

function community_invite_friend_cb(data) {
     var req = venus_createXMLHttp();
     req.onreadystatechange = function () { 
          if (req.readyState==4) {
               if (req.status==200) {
					if(req.responseText!='error'){
						data = eval('('+req.responseText+')');
						document.getElementById('mfrmngr_list_item_'+data.user).style.display="none";
						mfrmngr.show_msg(data.result);
					}
               } 
          }
     };
     req.open("GET", '/app/ext/community_friend_invite.php?user='+data.uID+'&community='+community); 
     req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf8"); // set Header
     req.send(null); 
}

function community_invite_friend(){
	mfrmngr.callback='community_invite_friend_cb';
	mfrmngr.open();
}

</script>

</head>
<body>
<div style="width:1024px;margin:0 auto;">
<div id="header">
<table><tr>
<td valign="middle" style="padding:10px;"  align="left" >
<img  src="<?php echo $_smarty_tpl->getVariable('community')->value['logo'];?>
"/>
</td><td  valign="middle" align="left" style="padding:10px;" width="100%">
<h1 style="font-size:18px;"><?php echo $_smarty_tpl->getVariable('community')->value['title'];?>
</h1>
</td></tr></table>
</div>
<div id="menu">
&nbsp;&nbsp;
<a href="<?php echo $_smarty_tpl->getVariable('URL')->value;?>
">Home</a>
&nbsp;&nbsp;
<a href="<?php echo $_smarty_tpl->getVariable('URL')->value;?>
blog">Blog</a>
&nbsp;&nbsp;
<a href="<?php echo $_smarty_tpl->getVariable('URL')->value;?>
shop">Shop</a>
&nbsp;&nbsp;
<a href="<?php echo $_smarty_tpl->getVariable('URL')->value;?>
contact">Contacts</a>
&nbsp;&nbsp;
<a href="<?php echo $_smarty_tpl->getVariable('URL')->value;?>
users">Users</a>
&nbsp;&nbsp;
<?php if ($_smarty_tpl->getVariable('isGuest')->value==1){?>
<a href="<?php echo $_smarty_tpl->getVariable('URL')->value;?>
?join_open"><?php echo $_smarty_tpl->getVariable('lang')->value['cmtyjoin'];?>
</a>&nbsp;&nbsp;
<?php }elseif($_smarty_tpl->getVariable('isNone')->value==1){?>
<a href="<?php echo $_smarty_tpl->getVariable('BASE_URL')->value;?>
?q=user/login"><?php echo $_smarty_tpl->getVariable('lang')->value['authorization'];?>
</a>
/
<a href="<?php echo $_smarty_tpl->getVariable('BASE_URL')->value;?>
?q=user/action/reg/form"><?php echo $_smarty_tpl->getVariable('lang')->value['ureg'];?>
</a>&nbsp;&nbsp;
<?php }else{ ?>
<a href="<?php echo $_smarty_tpl->getVariable('URL')->value;?>
?unsubscribeme"><?php echo $_smarty_tpl->getVariable('lang')->value['cmtyunsubscribe'];?>
</a>&nbsp;&nbsp;
<?php }?>

<div style="float:right;">
<?php if ($_smarty_tpl->getVariable('isNone')->value!=1){?>
&nbsp;<a href="javascript:community_invite_friend();"><?php echo $_smarty_tpl->getVariable('lang')->value['cmtyinvitefriend'];?>
</a>&nbsp;
<?php }?>
<?php if ($_smarty_tpl->getVariable('community')->value['options']['module_shop']==true){?>
<?php if ($_smarty_tpl->getVariable('isNone')->value!=1){?>
&nbsp;<a href="<?php echo $_smarty_tpl->getVariable('URL')->value;?>
shop/order"><?php echo $_smarty_tpl->getVariable('lang')->value['cmtyshoporders'];?>
</a>&nbsp;
<?php }?>
&nbsp;<a href="javascript:cmtyshopbasketmngr.open();"><?php echo $_smarty_tpl->getVariable('lang')->value['cmtyshopbasket'];?>
: <span id="shop_basket"></span></a>&nbsp;<br/>
<?php }?>
</div>
</div>
<div id="main">

<?php if (!empty($_smarty_tpl->getVariable('errors',null,true,false)->value)){?><div class="error_message" id="error_box"><?php  $_smarty_tpl->tpl_vars['error'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('errors')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['error']->key => $_smarty_tpl->tpl_vars['error']->value){
?><?php echo $_smarty_tpl->tpl_vars['error']->value;?>
<br/><?php }} ?></div><?php }?>
<?php if (!empty($_smarty_tpl->getVariable('message',null,true,false)->value)){?><div class="message" id="message_box"><?php echo $_smarty_tpl->getVariable('message')->value;?>
</div><?php }?>
<!--end messages-->
<?php echo $_smarty_tpl->getVariable('content')->value;?>

</div>
<div id="footer"><center>&copy 2011</center></div>
</div>
</body>
</html>