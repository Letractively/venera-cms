<?php
if(count($elements_list)>0){
?>
<script type="text/javascript">
	$(function() {
		$("#elements_list").accordion({
			autoHeight: false,
			navigation: true
		});
	});
</script>
<div id="elements_list">
<?php
	foreach($elements_list as $i=>&$element){
			include(TDIR.'views/default/list.type.php');

			}
?>
</div>
<?
		}else{
?>
<center>Empty...</center>
<?php } ?>
<div id="paging">
<?php echo venus_nav_links('admin/default/mod_elements/{%page%}/'.$pCount,array('pagenow'=>$pNum,'maxpage'=>ceil($elements_count/$pCount)-1));?>
</div>