<?php
if(count($comments_list)>0){
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
	foreach($comments_list as $i=>&$comment){
			include(TDIR.'views/default/comment.php');

			}
?>
</div>
<?
		}else{
?>
<center>Empty...</center>
<?php } ?>
<div id="paging">
<?php echo venus_nav_links('admin/default/comments/'.$element->eID.'/{%page%}/'.$pCount,array('pagenow'=>$pNum,'maxpage'=>ceil($comments_count/$pCount)-1));?>
</div>