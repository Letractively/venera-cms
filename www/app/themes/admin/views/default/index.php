<?php
if(count(core::$settings['etypes'])>0){
		echo '<div class="subtypes_select">'.lt('add').':';
?>

<select onchange="location.href=this.value">
<option value="">...</option>
<?
		foreach(core::$settings['etypes'] as $i=>$name){
			echo '<option value="'.l('admin/default/action/add/0/'.$name).'">'.lt('t'.$name).'</option>';
		}

?>
</select>
</div>
<?}

if(count($child_elements_list)>0){
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
	foreach($child_elements_list as $i=>&$element){
			include(TDIR.'views/default/list.type.php');

			}
?>
</div>

<?
		}else{
?>
<center>Empty...</center>
<?php } ?>
<br/>
<div id="paging">
<?php echo venus_nav_links('admin/default/index/{%page%}/'.$pCount,array('pagenow'=>$pNum,'maxpage'=>ceil($child_elements_count/$pCount)-1));?>

</div>