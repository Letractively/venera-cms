<?php /* Smarty version Smarty-3.0.8, created on 2011-12-30 07:45:27
         compiled from "app/themes/myglonet/views/community/default/shop_basket.stpl" */ ?>
<?php /*%%SmartyHeaderCode:89624efd41e7576598-49532070%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6edec668dd8d2e511c74f083410836cae8716f62' => 
    array (
      0 => 'app/themes/myglonet/views/community/default/shop_basket.stpl',
      1 => 1325214888,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '89624efd41e7576598-49532070',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<h1><?php echo $_smarty_tpl->getVariable('lang')->value['cmtyshopbasket'];?>
</h1>
<?php ob_start();?><?php echo count($_smarty_tpl->getVariable('basket')->value);?>
<?php $_tmp1=ob_get_clean();?><?php if ($_tmp1!=0){?>
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
<form action="<?php echo $_smarty_tpl->getVariable('URL')->value;?>
shop/basket" method="post">
<input type="hidden" name="basket_setitem" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['product']['eID'];?>
"/>
<input type="text" name="basket_setitemcount" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['count'];?>
" size="3"/>
<input type="submit" value="<?php echo $_smarty_tpl->getVariable('lang')->value['update'];?>
"/>
</form>

</td>
<td align="center"><?php echo $_smarty_tpl->tpl_vars['item']->value['summ'];?>
 <?php echo $_smarty_tpl->getVariable('lang')->value['billing_moneyname'];?>
</td>
<td>
<form action="<?php echo $_smarty_tpl->getVariable('URL')->value;?>
shop/basket" method="post">
<input type="hidden" name="basket_dropitem" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['product']['eID'];?>
"/>
<input type="submit" value="<?php echo $_smarty_tpl->getVariable('lang')->value['cmtydropfrombasket'];?>
"/></form>
</form>
</td>
</tr>
<?php }} ?>
<tr><td colspan="5" align="right"><?php echo $_smarty_tpl->getVariable('lang')->value['cmtyshopbasketallsumm'];?>
: <?php echo $_smarty_tpl->getVariable('basket_summ')->value;?>
 <?php echo $_smarty_tpl->getVariable('lang')->value['billing_moneyname'];?>
<br/><a href="<?php echo $_smarty_tpl->getVariable('URL')->value;?>
shop/order/add"><?php echo $_smarty_tpl->getVariable('lang')->value['cmtyshopaddorder'];?>
</a></td><td></td></tr>
</table>
<?php }else{ ?>
Empty
<?php }?>