<?php /* Smarty version Smarty-3.0.8, created on 2012-01-07 23:31:33
         compiled from "app/themes/myglonet/views/community/default/users.stpl" */ ?>
<?php /*%%SmartyHeaderCode:238434f08aba5959cd4-30889820%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7957961a1cef20a04951561c7efcd5e8a103220f' => 
    array (
      0 => 'app/themes/myglonet/views/community/default/users.stpl',
      1 => 1325968292,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '238434f08aba5959cd4-30889820',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<h1><?php echo $_smarty_tpl->getVariable('lang')->value['cmtyusers'];?>
</h1>
<?php if (count($_smarty_tpl->getVariable('users')->value)==0){?>
<center><?php echo $_smarty_tpl->getVariable('lang')->value['nocmtyusers'];?>
</center>
<?php }else{ ?>
<?php  $_smarty_tpl->tpl_vars['user'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('users')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['user']->key => $_smarty_tpl->tpl_vars['user']->value){
?>
<div style="padding:15px;margin-bottom:15px;border-style:solid;border-color:silver;border-width:1px;background:#eeeeff;">
<div style="float:left;margin:5px;"><img src="<?php echo $_smarty_tpl->tpl_vars['user']->value['avatar'];?>
" width="50px"/></div><div style="margin-left:10px;height:60px;padding:20px;"><?php echo $_smarty_tpl->tpl_vars['user']->value['name'];?>
 <?php echo $_smarty_tpl->tpl_vars['user']->value['sername'];?>

<br/><small><a href="<?php echo $_smarty_tpl->getVariable('BASE_URL')->value;?>
userspace/<?php echo $_smarty_tpl->tpl_vars['user']->value['uID'];?>
"><?php echo $_smarty_tpl->getVariable('lang')->value['friends_page'];?>
</a>
</small>
</div>
</div><div style="clear:both"></div>
<?php }} ?>
<?php echo $_smarty_tpl->getVariable('users_nav_links')->value;?>

<?php }?>