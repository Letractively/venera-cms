<?php /* Smarty version Smarty-3.0.8, created on 2011-11-02 20:55:07
         compiled from "app/themes/myglonet/views/community/default/blog_post.stpl" */ ?>
<?php /*%%SmartyHeaderCode:233884eb183fb8f14b4-38698653%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4239521533a8c92fbda6c760bfb15b4d643a6c92' => 
    array (
      0 => 'app/themes/myglonet/views/community/default/blog_post.stpl',
      1 => 1320256505,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '233884eb183fb8f14b4-38698653',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_date_format')) include 'Z:\home\project.com\www\app\include\smarty\plugins\modifier.date_format.php';
?><div>
<div style="width:760px;float:left;">
<h1><?php echo $_smarty_tpl->getVariable('post')->value['title'];?>
</h1>
<font color="#777777"><?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('post')->value['eCDate'],"%d/%m/%Y %H:%M");?>
</font><br/>
<p><?php echo $_smarty_tpl->getVariable('post')->value['text'];?>
</p>
<p><b><?php echo $_smarty_tpl->getVariable('lang')->value['etags'];?>
:<?php echo $_smarty_tpl->getVariable('post')->value['eTags'];?>
</b></p>
<?php if ($_smarty_tpl->getVariable('access')->value['blogedit']==1||$_smarty_tpl->getVariable('USER')->value['uID']==$_smarty_tpl->getVariable('post')->value['uID']){?>
	<a href="<?php echo $_smarty_tpl->getVariable('URL')->value;?>
blog/edit/<?php echo $_smarty_tpl->getVariable('post')->value['eID'];?>
"><?php echo $_smarty_tpl->getVariable('lang')->value['edit'];?>
</a>&nbsp;
<?php }?>
<?php if ($_smarty_tpl->getVariable('access')->value['blogdelete']==1||$_smarty_tpl->getVariable('USER')->value['uID']==$_smarty_tpl->getVariable('post')->value['uID']){?>
	<a href="<?php echo $_smarty_tpl->getVariable('URL')->value;?>
blog/delete/<?php echo $_smarty_tpl->getVariable('post')->value['eID'];?>
"><?php echo $_smarty_tpl->getVariable('lang')->value['delete'];?>
</a>&nbsp;
<?php }?>
</div>
<div style="width:200px;float:left;padding-left:10px;">
<center><?php echo $_smarty_tpl->getVariable('lang')->value['author'];?>
: <img src="<?php echo $_smarty_tpl->getVariable('post')->value['userpic'];?>
" width="190px"/><br/><a href="<?php echo $_smarty_tpl->getVariable('BASE_URL')->value;?>
userspace/<?php echo $_smarty_tpl->getVariable('post')->value['uID'];?>
"><?php echo $_smarty_tpl->getVariable('post')->value['name'];?>
 <?php echo $_smarty_tpl->getVariable('post')->value['login'];?>
 <?php echo $_smarty_tpl->getVariable('post')->value['sername'];?>
</a></center>

</div>
<div style="clear:both;"></div>
</div>
<h1><?php echo $_smarty_tpl->getVariable('lang')->value['comments'];?>
<sup>[<?php echo $_smarty_tpl->getVariable('post')->value['eCCount'];?>
]</sup></h1>
<?php if ($_smarty_tpl->getVariable('access')->value['blogcomment']){?>
<form action="<?php echo $_smarty_tpl->getVariable('URL')->value;?>
blog/post/<?php echo $_smarty_tpl->getVariable('post')->value['eID'];?>
" method="post">
<input type="hidden" name="save_comment" value="1"/>
<?php echo $_smarty_tpl->getVariable('html_comment_form')->value->get_hidden();?>

<?php echo $_smarty_tpl->getVariable('lang')->value['comment'];?>
:<br/>
<textarea name="cText" style="width:500px;height:150px;"></textarea><br/>
<input type="submit" value="<?php echo $_smarty_tpl->getVariable('lang')->value['postcomment'];?>
"/>
</form>
<?php }?>
<?php if ($_smarty_tpl->getVariable('post')->value['eCCount']!=0){?>
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
blog/post/<?php echo $_smarty_tpl->getVariable('post')->value['eID'];?>
/delete_comment/<?php echo $_smarty_tpl->tpl_vars['comment']->value['cID'];?>
"><?php echo $_smarty_tpl->getVariable('lang')->value['delete'];?>
</a><?php }?>
</td></tr></table></div>
<?php }} ?>
<?php echo $_smarty_tpl->getVariable('comments_nav_links')->value;?>

<?php }?>
