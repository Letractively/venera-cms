<?php

if(count($comments_list)>0){
?>
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
<?php

echo venus_nav_links('default/comments/'.$element->eID.'/{%page%}/'.$cpCount,array('pagenow'=>$pNum,'maxpage'=>ceil($comments_count/$cpCount)-1));

?>
</div>