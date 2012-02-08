<?php /* Smarty version Smarty-3.0.8, created on 2011-12-30 06:16:51
         compiled from "app/themes/myglonet/views/community/default/shop_order_add.stpl" */ ?>
<?php /*%%SmartyHeaderCode:1944efd2d230fae06-50919216%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9dfb47bb3565cb358f3ddca1f58ec1cf32b85028' => 
    array (
      0 => 'app/themes/myglonet/views/community/default/shop_order_add.stpl',
      1 => 1325215006,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1944efd2d230fae06-50919216',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<h1><?php echo $_smarty_tpl->getVariable('lang')->value['cmtyshopmakeorder'];?>
</h1>
<table cellspacing="5px">
<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('basket')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
<tr><td align="center"><a href="<?php echo $_smarty_tpl->getVariable('URL')->value;?>
shop/product/<?php echo $_smarty_tpl->tpl_vars['item']->value['product']['eID'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['product']['title'];?>
</a></td>
<td align="center"><?php echo $_smarty_tpl->tpl_vars['item']->value['product']['price'];?>
 <?php echo $_smarty_tpl->getVariable('lang')->value['billing_moneyname'];?>
</td>
<td align="center">
<b>x <?php echo $_smarty_tpl->tpl_vars['item']->value['count'];?>
</b></td>
<td align="center"><?php echo $_smarty_tpl->tpl_vars['item']->value['summ'];?>
 <?php echo $_smarty_tpl->getVariable('lang')->value['billing_moneyname'];?>
</td>
</tr>
<?php }} ?>
</table>
<?php echo $_smarty_tpl->getVariable('form')->value;?>
