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
?><h2><?php echo $_smarty_tpl->getVariable('lang')->value['cmtyshoporder'];?>
 № <?php echo $_smarty_tpl->getVariable('order')->value['orderID'];?>
 | <?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('order')->value['time'],"%d/%m/%Y %H:%M");?>
 | <?php echo $_smarty_tpl->getVariable('lang')->value[("cmtyshoporderpayed").($_smarty_tpl->getVariable('order')->value['payed'])];?>
</h2><table cellspacing="5"><tr><td colspan="2" align="center"><b><a href="<?php echo $_smarty_tpl->getVariable('BASE_URL')->value;?>
userspace/<?php echo $_smarty_tpl->getVariable('order')->value['user'];?>
" target="_blank"><?php echo $_smarty_tpl->getVariable('order')->value['name'];?>
 <?php echo $_smarty_tpl->getVariable('order')->value['login'];?>
 <?php echo $_smarty_tpl->getVariable('order')->value['sername'];?>
</a></b></td></tr><tr><td align="right"><?php echo $_smarty_tpl->getVariable('lang')->value['cmtyshoporder_summ'];?>
:</td><td><b><?php echo $_smarty_tpl->getVariable('order')->value['summ'];?>
 <?php echo $_smarty_tpl->getVariable('lang')->value['billing_moneyname'];?>
</b><?php if ($_smarty_tpl->getVariable('canpay')->value){?><form action="<?php echo $_smarty_tpl->getVariable('URL')->value;?>
shop/order/view/<?php echo $_smarty_tpl->getVariable('order')->value['orderID'];?>
" method="post"><input type="hidden" name="pay" value="1"/><input type="submit" value="<?php echo $_smarty_tpl->getVariable('lang')->value['cmtyshoporder_payforthis'];?>
"/></form><?php }?></td></tr><tr><td align="right"><?php echo $_smarty_tpl->getVariable('lang')->value['cmtyshoporder_items'];?>
:</td><td><table cellspacing="5px"><?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('items')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?><tr><td align="center"><a href="<?php echo $_smarty_tpl->getVariable('URL')->value;?>
shop/product/<?php echo $_smarty_tpl->tpl_vars['item']->value['product']['eID'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['product']['title'];?>
</a></td><td align="center"><?php echo $_smarty_tpl->tpl_vars['item']->value['product']['price'];?>
 <?php echo $_smarty_tpl->getVariable('lang')->value['billing_moneyname'];?>
</td><td align="center">x <?php echo $_smarty_tpl->tpl_vars['item']->value['count'];?>
</td><td align="center"><b><?php echo $_smarty_tpl->tpl_vars['item']->value['summ'];?>
 <?php echo $_smarty_tpl->getVariable('lang')->value['billing_moneyname'];?>
</b></td></tr><?php }} ?></table></td></tr><tr><td align="right"><?php echo $_smarty_tpl->getVariable('lang')->value['cmtyshopordercourtage'];?>
:</td><td><?php echo $_smarty_tpl->getVariable('order')->value['courtage'];?>
 <?php echo $_smarty_tpl->getVariable('lang')->value['billing_moneyname'];?>
</td></tr><tr><td align="right"><?php echo $_smarty_tpl->getVariable('lang')->value['cmtyshoporderstatus'];?>
:</td><td><?php echo $_smarty_tpl->getVariable('lang')->value[("cmtyshoporderstatus").($_smarty_tpl->getVariable('order')->value['status'])];?>
</td></tr><tr><td align="right"><?php echo $_smarty_tpl->getVariable('lang')->value['cmtyshoporderrecname'];?>
:</td><td><?php echo $_smarty_tpl->getVariable('order')->value['reciver_name'];?>
</td></tr><tr><td align="right"><?php echo $_smarty_tpl->getVariable('lang')->value['cmtyshoporderrecaddr'];?>
:</td><td><?php echo $_smarty_tpl->getVariable('order')->value['reciver_addr'];?>
</td></tr><tr><td align="right"><?php echo $_smarty_tpl->getVariable('lang')->value['cmtyshopordercontacts'];?>
:</td><td><?php echo $_smarty_tpl->getVariable('order')->value['contacts'];?>
</td></tr><tr><td align="right"><?php echo $_smarty_tpl->getVariable('lang')->value['cmtyshoporderdelivery'];?>
:</td><td><?php echo $_smarty_tpl->getVariable('delivery')->value['title'];?>
, <b><?php echo $_smarty_tpl->getVariable('delivery')->value['price'];?>
 <?php echo $_smarty_tpl->getVariable('lang')->value['billing_moneyname'];?>
</b></td></tr><tr><td align="right"><?php echo $_smarty_tpl->getVariable('lang')->value['cmtyshopordercomment'];?>
:</td><td><?php echo $_smarty_tpl->getVariable('order')->value['comment'];?>
</td></tr><tr><td colspan="2"><h2><?php echo $_smarty_tpl->getVariable('lang')->value['comments'];?>
</h2><form action="<?php echo $_smarty_tpl->getVariable('URL')->value;?>
shop/order/view/<?php echo $_smarty_tpl->getVariable('order')->value['orderID'];?>
" method="post"><input type="hidden" name="post_comment" value="1"/><textarea name="text" cols="70" rows="10"></textarea><br/><input type="submit" value="<?php echo $_smarty_tpl->getVariable('lang')->value['add'];?>
"/></form><?php ob_start();?><?php echo count($_smarty_tpl->getVariable('comments')->value);?>
<?php $_tmp1=ob_get_clean();?><?php if ($_tmp1!=0){?><?php  $_smarty_tpl->tpl_vars['comment'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('comments')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['comment']->key => $_smarty_tpl->tpl_vars['comment']->value){
?><div style="padding:10px;margin:10px;background:<?php if ($_smarty_tpl->tpl_vars['comment']->value['admin']==1){?>#EEEEFF<?php }else{ ?>#EEFFEE<?php }?>"><p><a href="<?php echo $_smarty_tpl->getVariable('BASE_URL')->value;?>
userspace/<?php echo $_smarty_tpl->tpl_vars['comment']->value['user'];?>
"><?php echo $_smarty_tpl->tpl_vars['comment']->value['name'];?>
 <?php echo $_smarty_tpl->tpl_vars['comment']->value['login'];?>
 <?php echo $_smarty_tpl->tpl_vars['comment']->value['sername'];?>
</a>: </p><p><?php echo $_smarty_tpl->tpl_vars['comment']->value['text'];?>
</p><small><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['comment']->value['time'],"%d/%m/%Y %H:%M");?>
</small><?php if ($_smarty_tpl->tpl_vars['comment']->value['user']==$_smarty_tpl->getVariable('USER')->value['uID']){?><form action="<?php echo $_smarty_tpl->getVariable('URL')->value;?>
shop/order/view/<?php echo $_smarty_tpl->getVariable('order')->value['orderID'];?>
" method="post"><input type="hidden" name="delete_comment" value="<?php echo $_smarty_tpl->tpl_vars['comment']->value['commentID'];?>
"/><input type="submit" value="<?php echo $_smarty_tpl->getVariable('lang')->value['delete'];?>
"/></form><?php }?></div><?php }} ?><?php }?></td></tr></table>