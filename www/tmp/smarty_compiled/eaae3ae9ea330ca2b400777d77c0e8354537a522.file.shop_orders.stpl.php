<?php /* Smarty version Smarty-3.0.8, created on 2012-01-12 00:54:02
         compiled from "app/themes/myglonet/views/community/default/shop_orders.stpl" */ ?>
<?php /*%%SmartyHeaderCode:266864f0e2f2acb19a7-20609062%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'eaae3ae9ea330ca2b400777d77c0e8354537a522' => 
    array (
      0 => 'app/themes/myglonet/views/community/default/shop_orders.stpl',
      1 => 1326329640,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '266864f0e2f2acb19a7-20609062',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_date_format')) include 'Z:\home\project.com\www\app\include\smarty\plugins\modifier.date_format.php';
?><?php ob_start();?><?php echo count($_smarty_tpl->getVariable('orders')->value);?>
<?php $_tmp1=ob_get_clean();?><?php if ($_tmp1==0){?>
</center>
 $_from = $_smarty_tpl->getVariable('orders')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['order']->key => $_smarty_tpl->tpl_vars['order']->value){
?>
shop/order/view/<?php echo $_smarty_tpl->tpl_vars['order']->value['orderID'];?>
"><h2><?php echo $_smarty_tpl->getVariable('lang')->value['cmtyshoporder'];?>
 № <?php echo $_smarty_tpl->tpl_vars['order']->value['orderID'];?>
 
 

:</td><td><b><?php echo $_smarty_tpl->tpl_vars['order']->value['summ'];?>
 <?php echo $_smarty_tpl->getVariable('lang')->value['billing_moneyname'];?>
</b></td></tr>
:</td><td><?php echo $_smarty_tpl->getVariable('lang')->value[("cmtyshoporderstatus").($_smarty_tpl->tpl_vars['order']->value['status'])];?>
</td></tr>
:</td><td><?php echo $_smarty_tpl->tpl_vars['order']->value['comment'];?>
</td></tr>
