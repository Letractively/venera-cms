<?php /* Smarty version Smarty-3.0.8, created on 2011-09-13 15:43:57
         compiled from "app/modules/community/data/58/index.stpl" */ ?>
<?php /*%%SmartyHeaderCode:202044e6f41fd8440d5-89625655%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b10c0b96b0456d941285e5247e349f4892d7ee2b' => 
    array (
      0 => 'app/modules/community/data/58/index.stpl',
      1 => 1315914235,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '202044e6f41fd8440d5-89625655',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<html>
<head>
<TITLE><?php echo $_smarty_tpl->getVariable('community')->value['title'];?>
</TITLE>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<meta name="description" content="<?php echo $_smarty_tpl->getVariable('community')->value['eMDescription'];?>
>">
<meta name="keywords" content="<?php echo $_smarty_tpl->getVariable('community')->value['eMKeywords'];?>
">
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->getVariable('THEME')->value;?>
css/style.css">
<?php echo $_smarty_tpl->getVariable('head')->value;?>

</head>
<body>
<div style="width:1024px;margin:0 auto;">
<div id="header">
<table class="header_text"><tr>
<td valign="middle" style="padding:10px;"  align="left" >
<img height="120" src="<?php echo $_smarty_tpl->getVariable('community')->value['logo'];?>
"/>
</td><td  valign="middle" align="left" style="padding:10px;" width="100%">
</td></tr></table>
</div>
<div id="menu">
<?php echo $_smarty_tpl->getVariable('menu')->value;?>

</div>
<div id="main">
<?php if (!empty($_smarty_tpl->getVariable('errors',null,true,false)->value)){?><div class="error_message" id="error_box"><?php  $_smarty_tpl->tpl_vars['error'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('errors')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['error']->key => $_smarty_tpl->tpl_vars['error']->value){
?><?php echo $_smarty_tpl->tpl_vars['error']->value;?>
<br/><?php }} ?></div><?php }?>
<?php if (!empty($_smarty_tpl->getVariable('message',null,true,false)->value)){?><div class="message" id="message_box"><?php echo $_smarty_tpl->getVariable('message')->value;?>
/div><?php }?>
<!--end messages-->
<?php echo $_smarty_tpl->getVariable('content')->value;?>

</div>
<div id="footer"><center>© 2011</center></div>
</div>
</body>
</html>