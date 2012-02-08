<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>
<?=$page_title;?> Administration Center
</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<? 
venus_head_part(array('type'=>'css','src'=>BASEURL.'app/js/jquery/jquery.tooltip.css'));
venus_head_part(array('type'=>'css','src'=>BASEURL.'app/js/jquery/custom.css'));
venus_head_part(array('type'=>'css','src'=>BASEURL.'app/js/jquery/jquery.treeview.css'));
venus_head_part(array('type'=>'js','src'=>BASEURL.'app/js/jquery/jquery.js'));
venus_head_part(array('type'=>'js','src'=>BASEURL.'app/js/jquery/jqueryui.js'));
venus_head_part(array('type'=>'js','src'=>BASEURL.'app/js/jquery/hoverIntent.js'));
venus_head_part(array('type'=>'js','src'=>BASEURL.'app/js/jquery/jquery.tooltip.js'));
venus_head_part(array('type'=>'js','src'=>BASEURL.'app/js/jquery/jquery.cookie.js'));
venus_head_part(array('type'=>'js','src'=>BASEURL.'app/js/jquery/jquery.treeview.js'));
venus_head_part(array('type'=>'js','text'=>'$(function() {$("a").tooltip({track: true,delay: 0,showURL: false,fade: 200});});$(function() {$("#treemenu").treeview({collapsed:true, persist: "cookie"});});'));
venus_head_part(array('type'=>'css','src'=>THEME.'styles/style.css'));
venus_head();
?>
</head>
<body>
<table id="page" cellpadding="0" cellspacing="7px" height="100%" width="1000" align="center"><tr><td valign="top" width="190px">
<a href="javascript:return false;" class="logo">
<div>
</div></a>
<div id="leftmenu" class="ui-corner-all ui-widget-content">
<ul id="treemenu"><span class="ui-icon ui-icon-home"></span>	
<? venus_plugin('menu');?>
</ul>
</div>
</td><td valign="top">
<div id="menu" class="ui-corner-all ui-widget-content">
<div style="padding:20px;">
<div id="header">
<?
_lt('youauthorized');?> <?=core::$user['name'].' &laquo;'.core::$user['login'].'&raquo; '.core::$user['sername'];?>
 ( <?=__l('admin/user/action/profile',lt('profile'));?> | <?='<a href="'.BASEURL.'?logout">'.lt('exit').'</a>';?> )
</div>
<? if(count(breadcrumbs::$items)>0){ ?>
<div id="breadcrumbs" style="clear:both;">Breadcrumbs
<?
foreach(breadcrumbs::$items as $i=>$item) echo ' / <a href="'.$item['url'].'">'.$item['title'].'</a>';
?></div>
<? } ?>
<? if(venus_have_errors()){ ?>
<script type="text/javascript">
	$(document).ready(function() {
			$("#error_box1").effect("highlight",{},1500,callback);
		function callback(){
			setTimeout(function(){
				$("#error_box1").fadeOut();
			}, 10000);
		};

	});
</script>
<div style="clear:both;"></div>
<div class="ui-widget" id="error_box1">
				<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
					<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
					<?=implode('<br/>',core::$errors);?>
					</p>
				</div>
</div>
<? }else
if(isset($message)){ ?>
<script type="text/javascript">
	$(document).ready(function() {
			$("#message_box1").effect("highlight",{},1500,callback);
		function callback(){
			setTimeout(function(){
				$("#message_box1").fadeOut();
			}, 2000);
		};

	});
</script>
<div style="clear:both;"></div>
<div class="ui-widget" id="message_box1">
				<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;"> 
					<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span> 
					<?=$message;?>
					</p>
				</div>
</div>
<? } ?>
<div style="clear:both;"></div>
<? venus_content();?>
</div></div>
</td></tr>
<tr>
</table>

<center style="color:#777777;">Venera CMS v.<?=core::$version;?> <?=core::$version_type;?><Br/>Copyright by Ildar Usmanov aka waj0x<br /> &copy; 2009-2012</center>
</body>
</html>