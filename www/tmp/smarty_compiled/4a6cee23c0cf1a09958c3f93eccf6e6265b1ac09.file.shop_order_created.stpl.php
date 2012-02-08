<?php /* Smarty version Smarty-3.0.8, created on 2011-12-30 07:46:07
         compiled from "app/themes/myglonet/views/community/default/shop_order_created.stpl" */ ?>
<?php /*%%SmartyHeaderCode:126614efd420fd09553-83188940%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4a6cee23c0cf1a09958c3f93eccf6e6265b1ac09' => 
    array (
      0 => 'app/themes/myglonet/views/community/default/shop_order_created.stpl',
      1 => 1325220306,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '126614efd420fd09553-83188940',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<h1><?php echo $_smarty_tpl->getVariable('lang')->value['cmtyshoporder_sent'];?>
</h1>

<?php echo $_smarty_tpl->getVariable('lang')->value['cmtyshoporder_number'];?>
: <b>№ <?php echo $_smarty_tpl->getVariable('order')->value['orderID'];?>
</b> <a href="<?php echo $_smarty_tpl->getVariable('URL')->value;?>
/shop/order/view/<?php echo $_smarty_tpl->getVariable('order')->value['orderID'];?>
">(<?php echo $_smarty_tpl->getVariable('lang')->value['view'];?>
)</a>

