<?php /* Smarty version Smarty-3.0.8, created on 2011-11-02 20:59:04
         compiled from "app/themes/myglonet/views/community/default/blog_created.stpl" */ ?>
<?php /*%%SmartyHeaderCode:249934eb184e8792162-22540296%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5d84540d7c74e95473e50854ecdc97b096ef83c7' => 
    array (
      0 => 'app/themes/myglonet/views/community/default/blog_created.stpl',
      1 => 1320256725,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '249934eb184e8792162-22540296',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<h1><?php echo $_smarty_tpl->getVariable('lang')->value['blog_post_created'];?>
</h1>
<h2>
<a href="<?php echo $_smarty_tpl->getVariable('URL')->value;?>
blog/write"><?php echo $_smarty_tpl->getVariable('lang')->value['cmtyblogadd'];?>
</a><br/>
<a href="<?php echo $_smarty_tpl->getVariable('URL')->value;?>
blog"><?php echo $_smarty_tpl->getVariable('lang')->value['back'];?>
</a><br/>
</h2>