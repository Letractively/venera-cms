<?php /* Smarty version Smarty-3.0.8, created on 2011-11-02 20:00:20
         compiled from "app/themes/myglonet/views/community/default/contact.stpl" */ ?>
<?php /*%%SmartyHeaderCode:165104eb177248118d5-90607318%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e98cb8d76f83cabbcf7b16e3d840ff156a9f8b6a' => 
    array (
      0 => 'app/themes/myglonet/views/community/default/contact.stpl',
      1 => 1320253219,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '165104eb177248118d5-90607318',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<h1><?php echo $_smarty_tpl->getVariable('lang')->value['cmtycontact'];?>
</h1>

<?php if (empty($_smarty_tpl->getVariable('contacts',null,true,false)->value)){?>
	<center><?php echo $_smarty_tpl->getVariable('lang')->value['nocmtycontact'];?>
</center>
<?php }else{ ?>
<table>
<?php if (!empty($_smarty_tpl->getVariable('contacts',null,true,false)->value['emails'])){?><tr><td><?php echo $_smarty_tpl->getVariable('lang')->value['cmtycontact_emails'];?>
:</td><td><?php echo $_smarty_tpl->getVariable('contacts')->value['emails'];?>
</td></tr><?php }?>
<?php if (!empty($_smarty_tpl->getVariable('contacts',null,true,false)->value['phones'])){?><tr><td><?php echo $_smarty_tpl->getVariable('lang')->value['cmtycontact_phones'];?>
:</td><td><?php echo $_smarty_tpl->getVariable('contacts')->value['phones'];?>
</td></tr><?php }?>
<?php if (!empty($_smarty_tpl->getVariable('contacts',null,true,false)->value['addr'])){?><tr><td><?php echo $_smarty_tpl->getVariable('lang')->value['cmtycontact_addr'];?>
:</td><td><?php echo $_smarty_tpl->getVariable('contacts')->value['addr'];?>
</td></tr><?php }?>
<?php if (!empty($_smarty_tpl->getVariable('contacts',null,true,false)->value['map'])){?><tr><td colspan="2"><?php echo $_smarty_tpl->getVariable('lang')->value['cmtycontact_map'];?>
:<br/><img src="<?php echo $_smarty_tpl->getVariable('contacts')->value['map'];?>
"/></td></tr><?php }?>
<?php if (!empty($_smarty_tpl->getVariable('contacts',null,true,false)->value['text'])){?><tr><td colspan="2"><?php echo $_smarty_tpl->getVariable('contacts')->value['text'];?>
</td></tr><?php }?>
</table>
<?php if (!empty($_smarty_tpl->getVariable('contacts',null,true,false)->value['email'])){?>
<h2><?php echo $_smarty_tpl->getVariable('lang')->value['cmtycontact_form'];?>
</h2>
<?php echo $_smarty_tpl->getVariable('html_contact_form')->value->get_html();?>

<?php }?>
<?php }?>