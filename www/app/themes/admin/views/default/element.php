<?php
$felement=$element;
if(count($felement->subtypes)>0 and ($felement->access('add') or $felement->access('category'))){
		echo  '<div class="subtypes_select">'.lt('add').':';
?>
<select onchange="location.href=this.value">
<option value="">...</option>
<?
		if($felement->access('category') and $felement->subtypes[0]!='') echo '<option value="'.l('admin/default/action/add/'.$felement->eID.'/'.$felement->subtypes[0]).'">'.lt('t'.$felement->subtypes[0]).'</option>';
		if($felement->access('add') and $felement->subtypes[1]!='') echo '<option value="'.l('admin/default/action/add/'.$felement->eID.'/'.$felement->subtypes[1]).'">'.lt('t'.$felement->subtypes[1]).'</option>';
?>
</select>
</div>
<?}

if(count($child_elements_list)!=0){
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
<?php echo venus_nav_links('admin/default/element/'.$felement->eFurl.'/{%page%}/'.$pCount,array('pagenow'=>$pNum,'maxpage'=>ceil($child_elements_count/$pCount)-1));?>
</div>