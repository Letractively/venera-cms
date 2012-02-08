<?php /* Smarty version Smarty-3.0.8, created on 2011-12-30 03:17:13
         compiled from "app/themes/myglonet/views/community/default/blog_rubric.stpl" */ ?>
<?php /*%%SmartyHeaderCode:230864efd03090b3421-84388169%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd012d64d79e9ecf9cb6b71d1f2f3c0dab6d793a7' => 
    array (
      0 => 'app/themes/myglonet/views/community/default/blog_rubric.stpl',
      1 => 1324900409,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '230864efd03090b3421-84388169',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_date_format')) include 'Z:\home\project.com\www\app\include\smarty\plugins\modifier.date_format.php';
?><h1><?php echo $_smarty_tpl->getVariable('lang')->value['cmtyblog'];?>
</h1>

<?php if ($_smarty_tpl->getVariable('access')->value['blogwrite']==1){?>

<h2><a href="<?php echo $_smarty_tpl->getVariable('URL')->value;?>
blog/write"><?php echo $_smarty_tpl->getVariable('lang')->value['cmtyblogadd'];?>
</a></h2>
<?php }?>
<div style="width:256px;float:right;padding:10px;border-style:solid;border-width:1px;border-color:#AAAAFF">
<div style="margin:-10px -10px 0px -10px;background:#EEEEFF;padding:5px;font-size:18px;"><?php echo $_smarty_tpl->getVariable('lang')->value['cmtyblogrubrics'];?>
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
blog/rubric/<?php echo $_smarty_tpl->tpl_vars['rubric']->value['eID'];?>
"><?php echo $_smarty_tpl->tpl_vars['rubric']->value['title'];?>
</a>
</li>
<?php }?>
<?php }} ?>

<div style="clear:both;"></div>
</div>
<div style="float:right;width:680px;margin-right:20px;">
<?php ob_start();?><?php echo count($_smarty_tpl->getVariable('blog')->value);?>
<?php $_tmp1=ob_get_clean();?><?php if ($_tmp1==0){?>
	<center><?php echo $_smarty_tpl->getVariable('lang')->value['nocmtyblog'];?>
</center>
<?php }else{ ?>
<?php  $_smarty_tpl->tpl_vars['post'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('blog')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['post']->key => $_smarty_tpl->tpl_vars['post']->value){
?>

<div style="margin-bottom:15px;padding:10px;border-style:solid;border-width:1px;border-color:#AAAAFF">
<div style="margin:-10px -10px 0px -10px;background:#EEEEFF;padding:5px;font-size:18px;"><a href="<?php echo $_smarty_tpl->getVariable('URL')->value;?>
blog/post/<?php echo $_smarty_tpl->tpl_vars['post']->value['eID'];?>
">
<?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
</a></div>
<div style="padding:10px;background:#FFFFFF;margin-bottom:7px;color:#777777"><?php echo $_smarty_tpl->tpl_vars['post']->value['short'];?>
<div style="clear:both;"></div></div>
<div style="padding:5px;color:#999999;font-size:12px;"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['post']->value['eCDate'],"%d/%m/%Y %H:%M");?>

<?php echo $_smarty_tpl->getVariable('lang')->value['author'];?>
: <a href="<?php echo $_smarty_tpl->getVariable('BASE_URL')->value;?>
userspace/<?php echo $_smarty_tpl->tpl_vars['post']->value['eAID'];?>
"><?php echo $_smarty_tpl->tpl_vars['post']->value['name'];?>
 <?php echo $_smarty_tpl->tpl_vars['post']->value['login'];?>
 <?php echo $_smarty_tpl->tpl_vars['post']->value['sername'];?>
</a></div>
<div style="clear:both;"></div>
<?php if ($_smarty_tpl->getVariable('access')->value['blogedit']==1||$_smarty_tpl->tpl_vars['post']->value['eAID']==$_smarty_tpl->getVariable('USER')->value['uID']){?><a href="<?php echo $_smarty_tpl->getVariable('URL')->value;?>
blog/edit/<?php echo $_smarty_tpl->tpl_vars['post']->value['eID'];?>
"><?php echo $_smarty_tpl->getVariable('lang')->value['edit'];?>
</a>&nbsp<?php }?>
<?php if ($_smarty_tpl->getVariable('access')->value['blogdelete']==1||$_smarty_tpl->tpl_vars['post']->value['eAID']==$_smarty_tpl->getVariable('USER')->value['uID']){?><a href="<?php echo $_smarty_tpl->getVariable('URL')->value;?>
blog/rubric/<?php echo $_smarty_tpl->getVariable('rubric')->value['eID'];?>
/delete/<?php echo $_smarty_tpl->tpl_vars['post']->value['eID'];?>
"><?php echo $_smarty_tpl->getVariable('lang')->value['delete'];?>
</a><?php }?>
</div>
<?php }} ?>
<?php echo $_smarty_tpl->getVariable('nav_links')->value;?>

<?php }?>
<div style="clear:both;"></div>
</div>
<div style="clear:both;"></div>
