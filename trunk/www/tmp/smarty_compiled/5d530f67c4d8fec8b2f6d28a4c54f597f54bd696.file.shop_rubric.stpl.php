<?php /* Smarty version Smarty-3.0.8, created on 2012-01-08 02:28:17
         compiled from "app/themes/myglonet/views/community/default/shop_rubric.stpl" */ ?>
<?php /*%%SmartyHeaderCode:71304f08d511ac5b47-34101584%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5d530f67c4d8fec8b2f6d28a4c54f597f54bd696' => 
    array (
      0 => 'app/themes/myglonet/views/community/default/shop_rubric.stpl',
      1 => 1325978839,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '71304f08d511ac5b47-34101584',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_date_format')) include 'Z:\home\project.com\www\app\include\smarty\plugins\modifier.date_format.php';
?><h1><?php echo $_smarty_tpl->getVariable('lang')->value['cmtyshop'];?>
</h1>

<?php if ($_smarty_tpl->getVariable('access')->value['shopwrite']==1){?>

<h2><a href="<?php echo $_smarty_tpl->getVariable('URL')->value;?>
shop/write"><?php echo $_smarty_tpl->getVariable('lang')->value['cmtyshopproductadd'];?>
</a></h2>
<?php }?>
<div style="width:256px;float:right;padding:10px;border-style:solid;border-width:1px;border-color:#AAAAFF">
<div style="margin:-10px -10px 0px -10px;background:#EEEEFF;padding:5px;font-size:18px;"><?php echo $_smarty_tpl->getVariable('lang')->value['cmtyshoprubrics'];?>
</div>

<?php  $_smarty_tpl->tpl_vars['rubric'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('rubrics_list')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['rubric']->key => $_smarty_tpl->tpl_vars['rubric']->value){
?>
<?php if ($_smarty_tpl->tpl_vars['rubric']->value=='begin'){?>
<ul>
<?php }elseif($_smarty_tpl->tpl_vars['rubric']->value=='end'){?>
</ul>
<?php }else{ ?>
<li>
<a href="<?php echo $_smarty_tpl->getVariable('URL')->value;?>
shop/rubric/<?php echo $_smarty_tpl->tpl_vars['rubric']->value['eID'];?>
"><?php echo $_smarty_tpl->tpl_vars['rubric']->value['title'];?>
</a>
</li>
<?php }?>
<?php }} ?>

<div style="clear:both;"></div>
</div>
<div style="float:right;width:680px;margin-right:20px;">
<?php ob_start();?><?php echo count($_smarty_tpl->getVariable('products')->value);?>
<?php $_tmp1=ob_get_clean();?><?php if ($_tmp1==0){?>
	<center><?php echo $_smarty_tpl->getVariable('lang')->value['nocmtyshop'];?>
</center>
<?php }else{ ?>
<?php  $_smarty_tpl->tpl_vars['product'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('products')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['product']->key => $_smarty_tpl->tpl_vars['product']->value){
?>

<div style="margin-bottom:15px;padding:10px;border-style:solid;border-width:1px;border-color:#AAAAFF">
<div style="margin:-10px -10px 0px -10px;background:#EEEEFF;padding:5px;font-size:18px;"><a href="<?php echo $_smarty_tpl->getVariable('URL')->value;?>
shop/product/<?php echo $_smarty_tpl->tpl_vars['product']->value['eID'];?>
">
<?php echo $_smarty_tpl->tpl_vars['product']->value['title'];?>
</a></div>
<div style="width:256px;height:256px;overflow:hidden;float:left;margin:5px;">
<?php if ($_smarty_tpl->tpl_vars['product']->value['image1']!=''){?>
<img src="<?php echo $_smarty_tpl->getVariable('URL')->value;?>
<?php echo $_smarty_tpl->tpl_vars['product']->value['image1'];?>
" width="256px"/>
<?php }elseif($_smarty_tpl->tpl_vars['product']->value['image2']!=''){?>
<img src="<?php echo $_smarty_tpl->getVariable('URL')->value;?>
<?php echo $_smarty_tpl->tpl_vars['product']->value['image2'];?>
" width="256px"/>
<?php }elseif($_smarty_tpl->tpl_vars['product']->value['image3']!=''){?>
<img src="<?php echo $_smarty_tpl->getVariable('URL')->value;?>
<?php echo $_smarty_tpl->tpl_vars['product']->value['image3'];?>
" width="256px"/>
<?php }else{ ?>
<img src="<?php echo $_smarty_tpl->getVariable('URL')->value;?>
img/image.png" width="256px"/>
<?php }?>
</div>
<div style="float:left;padding:5px;width:350px;">
<b><?php echo $_smarty_tpl->tpl_vars['product']->value['price'];?>
 <?php echo $_smarty_tpl->getVariable('lang')->value['billing_moneyname'];?>
</b>
<p><?php echo $_smarty_tpl->tpl_vars['product']->value['short'];?>
</p>

</div>
<div style="clear:both"></div>
<a href="javascript:cmtyshopbasketmngr.add(<?php echo $_smarty_tpl->tpl_vars['product']->value['eID'];?>
);"><?php echo $_smarty_tpl->getVariable('lang')->value['cmtyputinbasket'];?>
</a>



<div style="clear:both;"></div>
<div style="padding:5px;color:#999999;font-size:12px;"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['product']->value['eCDate'],"%d/%m/%Y %H:%M");?>

<?php echo $_smarty_tpl->getVariable('lang')->value['author'];?>
: <a href="<?php echo $_smarty_tpl->getVariable('BASE_URL')->value;?>
userspace/<?php echo $_smarty_tpl->tpl_vars['product']->value['eAID'];?>
"><?php echo $_smarty_tpl->tpl_vars['product']->value['name'];?>
 <?php echo $_smarty_tpl->tpl_vars['product']->value['login'];?>
 <?php echo $_smarty_tpl->tpl_vars['product']->value['sername'];?>
</a></div>
<div style="clear:both;"></div>
<?php if ($_smarty_tpl->getVariable('access')->value['shopedit']==1||$_smarty_tpl->tpl_vars['product']->value['eAID']==$_smarty_tpl->getVariable('USER')->value['uID']){?><a href="<?php echo $_smarty_tpl->getVariable('URL')->value;?>
shop/edit/<?php echo $_smarty_tpl->tpl_vars['product']->value['eID'];?>
"><?php echo $_smarty_tpl->getVariable('lang')->value['edit'];?>
</a>&nbsp<?php }?>
<?php if ($_smarty_tpl->getVariable('access')->value['shopdelete']==1||$_smarty_tpl->tpl_vars['product']->value['eAID']==$_smarty_tpl->getVariable('USER')->value['uID']){?><a href="<?php echo $_smarty_tpl->getVariable('URL')->value;?>
shop/delete/<?php echo $_smarty_tpl->tpl_vars['product']->value['eID'];?>
"><?php echo $_smarty_tpl->getVariable('lang')->value['delete'];?>
</a><?php }?>
</div>
<?php }} ?>
<?php echo $_smarty_tpl->getVariable('nav_links')->value;?>

<?php }?>
<div style="clear:both;"></div>
</div>
<div style="clear:both;"></div>
