<?php /* Smarty version Smarty-3.0.8, created on 2012-01-12 00:51:02
         compiled from "app/themes/myglonet/views/community/default/shop_order.stpl" */ ?>
<?php /*%%SmartyHeaderCode:123684f0e2e76347bf8-75367737%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a021b6bf189813a42f62b114b9e9fa5973b207e3' => 
    array (
      0 => 'app/themes/myglonet/views/community/default/shop_order.stpl',
      1 => 1326329454,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '123684f0e2e76347bf8-75367737',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_date_format')) include 'Z:\home\project.com\www\app\include\smarty\plugins\modifier.date_format.php';
?>
 № <?php echo $_smarty_tpl->getVariable('order')->value['orderID'];?>
 
 

userspace/<?php echo $_smarty_tpl->getVariable('order')->value['user'];?>
" target="_blank"><?php echo $_smarty_tpl->getVariable('order')->value['name'];?>
 <?php echo $_smarty_tpl->getVariable('order')->value['login'];?>
 <?php echo $_smarty_tpl->getVariable('order')->value['sername'];?>
</a></b></td></tr>
:</td><td>
 <?php echo $_smarty_tpl->getVariable('lang')->value['billing_moneyname'];?>
</b>
shop/order/view/<?php echo $_smarty_tpl->getVariable('order')->value['orderID'];?>
" method="post">
"/>
:</td><td>
 $_from = $_smarty_tpl->getVariable('items')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
shop/product/<?php echo $_smarty_tpl->tpl_vars['item']->value['product']['eID'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['product']['title'];?>
</a></td>
 <?php echo $_smarty_tpl->getVariable('lang')->value['billing_moneyname'];?>
</td>
</td>
 <?php echo $_smarty_tpl->getVariable('lang')->value['billing_moneyname'];?>
</b></td>
:</td><td><?php echo $_smarty_tpl->getVariable('order')->value['courtage'];?>
 <?php echo $_smarty_tpl->getVariable('lang')->value['billing_moneyname'];?>
</td></tr>
:</td><td><?php echo $_smarty_tpl->getVariable('lang')->value[("cmtyshoporderstatus").($_smarty_tpl->getVariable('order')->value['status'])];?>
</td></tr>
:</td><td><?php echo $_smarty_tpl->getVariable('order')->value['reciver_name'];?>
</td></tr>
:</td><td><?php echo $_smarty_tpl->getVariable('order')->value['reciver_addr'];?>
</td></tr>
:</td><td><?php echo $_smarty_tpl->getVariable('order')->value['contacts'];?>
</td></tr>
:</td><td><?php echo $_smarty_tpl->getVariable('delivery')->value['title'];?>
, <b><?php echo $_smarty_tpl->getVariable('delivery')->value['price'];?>
 <?php echo $_smarty_tpl->getVariable('lang')->value['billing_moneyname'];?>
</b></td></tr>
:</td><td><?php echo $_smarty_tpl->getVariable('order')->value['comment'];?>
</td></tr>
</h2>
shop/order/view/<?php echo $_smarty_tpl->getVariable('order')->value['orderID'];?>
" method="post">
"/>
<?php $_tmp1=ob_get_clean();?><?php if ($_tmp1!=0){?>
 $_from = $_smarty_tpl->getVariable('comments')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['comment']->key => $_smarty_tpl->tpl_vars['comment']->value){
?>
userspace/<?php echo $_smarty_tpl->tpl_vars['comment']->value['user'];?>
"><?php echo $_smarty_tpl->tpl_vars['comment']->value['name'];?>
 <?php echo $_smarty_tpl->tpl_vars['comment']->value['login'];?>
 <?php echo $_smarty_tpl->tpl_vars['comment']->value['sername'];?>
</a>: </p>
</p>
</small>
shop/order/view/<?php echo $_smarty_tpl->getVariable('order')->value['orderID'];?>
" method="post">
"/>
"/>