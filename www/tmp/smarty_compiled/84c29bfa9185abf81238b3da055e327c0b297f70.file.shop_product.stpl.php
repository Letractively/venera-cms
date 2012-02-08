<?php /* Smarty version Smarty-3.0.8, created on 2012-01-08 22:49:56
         compiled from "app/themes/myglonet/views/community/default/shop_product.stpl" */ ?>
<?php /*%%SmartyHeaderCode:136394f09f3648ab1e2-63690694%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '84c29bfa9185abf81238b3da055e327c0b297f70' => 
    array (
      0 => 'app/themes/myglonet/views/community/default/shop_product.stpl',
      1 => 1326052190,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '136394f09f3648ab1e2-63690694',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_date_format')) include 'Z:\home\project.com\www\app\include\smarty\plugins\modifier.date_format.php';
?><div>

<h1><?php echo $_smarty_tpl->getVariable('product')->value['title'];?>
</h1>
<font color="#777777"><?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('product')->value['eCDate'],"%d/%m/%Y %H:%M");?>
</font><br/>
<h2><?php echo $_smarty_tpl->getVariable('lang')->value['tproduct_price'];?>
: <?php echo $_smarty_tpl->getVariable('product')->value['price'];?>
 <?php echo $_smarty_tpl->getVariable('lang')->value['billing_moneyname'];?>
 (<a href="javascript:cmtyshopbasketmngr.add(<?php echo $_smarty_tpl->getVariable('product')->value['eID'];?>
);"><?php echo $_smarty_tpl->getVariable('lang')->value['cmtyputinbasket'];?>
</a>)</h2>
<p><?php echo $_smarty_tpl->getVariable('product')->value['full'];?>
</p>
<?php if (!empty($_smarty_tpl->getVariable('product',null,true,false)->value['image1'])){?><img src="<?php echo $_smarty_tpl->getVariable('URL')->value;?>
<?php echo $_smarty_tpl->getVariable('product')->value['image1'];?>
"/><?php }?>
<?php if (!empty($_smarty_tpl->getVariable('product',null,true,false)->value['image2'])){?><img src="<?php echo $_smarty_tpl->getVariable('URL')->value;?>
<?php echo $_smarty_tpl->getVariable('product')->value['image2'];?>
"/><?php }?>
<?php if (!empty($_smarty_tpl->getVariable('product',null,true,false)->value['image3'])){?><img src="<?php echo $_smarty_tpl->getVariable('URL')->value;?>
<?php echo $_smarty_tpl->getVariable('product')->value['image3'];?>
"/><?php }?>

<p><b><?php echo $_smarty_tpl->getVariable('lang')->value['etags'];?>
:<?php echo $_smarty_tpl->getVariable('product')->value['eTags'];?>
</b></p>
<?php if ($_smarty_tpl->getVariable('access')->value['shopedit']==1||$_smarty_tpl->getVariable('USER')->value['uID']==$_smarty_tpl->getVariable('product')->value['uID']){?>
	<a href="<?php echo $_smarty_tpl->getVariable('URL')->value;?>
shop/edit/<?php echo $_smarty_tpl->getVariable('product')->value['eID'];?>
"><?php echo $_smarty_tpl->getVariable('lang')->value['edit'];?>
</a>&nbsp;
<?php }?>
<?php if ($_smarty_tpl->getVariable('access')->value['shopdelete']==1||$_smarty_tpl->getVariable('USER')->value['uID']==$_smarty_tpl->getVariable('product')->value['uID']){?>
	<a href="<?php echo $_smarty_tpl->getVariable('URL')->value;?>
shop/delete/<?php echo $_smarty_tpl->getVariable('product')->value['eID'];?>
"><?php echo $_smarty_tpl->getVariable('lang')->value['delete'];?>
</a>&nbsp;
<?php }?>

</div>
<h1><?php echo $_smarty_tpl->getVariable('lang')->value['comments'];?>
<sup>[<?php echo $_smarty_tpl->getVariable('product')->value['eCCount'];?>
]</sup></h1>
<?php if ($_smarty_tpl->getVariable('access')->value['shopcomment']){?>
<form action="<?php echo $_smarty_tpl->getVariable('URL')->value;?>
shop/product/<?php echo $_smarty_tpl->getVariable('product')->value['eID'];?>
" method="product">
<input type="hidden" name="save_comment" value="1"/>
<?php echo $_smarty_tpl->getVariable('html_comment_form')->value->get_hidden();?>

<?php echo $_smarty_tpl->getVariable('lang')->value['comment'];?>
:<br/>
<textarea name="cText" style="width:500px;height:150px;"></textarea><br/>
<input type="submit" value="<?php echo $_smarty_tpl->getVariable('lang')->value['add'];?>
"/>
</form>
<?php }?>
<?php if ($_smarty_tpl->getVariable('product')->value['eCCount']!=0){?>
<?php  $_smarty_tpl->tpl_vars['comment'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('comments')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['comment']->key => $_smarty_tpl->tpl_vars['comment']->value){
?>
<div style="margin-bottom:20px;border-style:dotted;border-width:0px 0px 2px 0px;border-color:#777777;">
<table><tr><td valign="top"><img src="<?php echo $_smarty_tpl->tpl_vars['comment']->value['userpic'];?>
" width="100px"/></td><td valign="top">
<b><a href="<?php echo $_smarty_tpl->getVariable('BASE_URL')->value;?>
userspace/<?php echo $_smarty_tpl->tpl_vars['comment']->value['uID'];?>
"><?php echo $_smarty_tpl->tpl_vars['comment']->value['name'];?>
 <?php echo $_smarty_tpl->tpl_vars['comment']->value['login'];?>
 <?php echo $_smarty_tpl->tpl_vars['comment']->value['sername'];?>
</a></b>
<br/><small><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['comment']->value['cCDate'],"%d/%m/%Y %H:%M");?>
</small><br/><?php echo $_smarty_tpl->tpl_vars['comment']->value['cText'];?>
</td></tr>
<tr><td colspan="2"><?php if ($_smarty_tpl->getVariable('access')->value['moderate']==1||$_smarty_tpl->tpl_vars['comment']->value['uID']==$_smarty_tpl->getVariable('USER')->value['uID']){?><a href="<?php echo $_smarty_tpl->getVariable('URL')->value;?>
shop/product/<?php echo $_smarty_tpl->getVariable('product')->value['eID'];?>
/delete_comment/<?php echo $_smarty_tpl->tpl_vars['comment']->value['cID'];?>
"><?php echo $_smarty_tpl->getVariable('lang')->value['delete'];?>
</a><?php }?>
</td></tr></table></div>
<?php }} ?>
<?php echo $_smarty_tpl->getVariable('comments_nav_links')->value;?>

<?php }?>
