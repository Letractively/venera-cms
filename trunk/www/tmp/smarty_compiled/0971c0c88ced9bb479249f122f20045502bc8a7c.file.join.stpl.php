<?php /* Smarty version Smarty-3.0.8, created on 2012-01-10 14:08:57
         compiled from "app/themes/myglonet/views/community/default/join.stpl" */ ?>
<?php /*%%SmartyHeaderCode:304054f0c1c4960f2c5-99426199%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0971c0c88ced9bb479249f122f20045502bc8a7c' => 
    array (
      0 => 'app/themes/myglonet/views/community/default/join.stpl',
      1 => 1320253664,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '304054f0c1c4960f2c5-99426199',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_smarty_tpl->getVariable('community_joinstat')->value==0){?>
<h2><?php echo $_smarty_tpl->getVariable('lang')->value['cmtyjoin0'];?>
</h2>
<form action="<?php echo $_smarty_tpl->getVariable('URL')->value;?>
" method="post">
<input type="hidden" name="join_community" value="true"/>
<input type="submit" value="<?php echo $_smarty_tpl->getVariable('lang')->value['cmtyjoin'];?>
"/>
</form>
<?php }?>

<?php if ($_smarty_tpl->getVariable('community_joinstat')->value==1){?><h2><?php echo $_smarty_tpl->getVariable('lang')->value['cmtyjoin1'];?>
</h2><?php }?>
<?php if ($_smarty_tpl->getVariable('community_joinstat')->value==2){?><h2><?php echo $_smarty_tpl->getVariable('lang')->value['cmtyjoin2'];?>
</h2><?php }?>
<?php if ($_smarty_tpl->getVariable('community_joinstat')->value==3){?><h2><?php echo $_smarty_tpl->getVariable('lang')->value['cmtyjoin3'];?>
</h2><?php }?>
