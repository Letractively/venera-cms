<h1>"<?=$tag;?>"</h1>

<?php
if(count($elements_list)>0)
	foreach($elements_list as $i=>&$element){			include(TDIR.'views/default/'.$element->eType.'_list.type.php');
			echo '<br/><br/>';
		}
?>
<?php

echo venus_nav_links('default/tag/'.$tag.'/{%page%}/'.$pCount,array('pagenow'=>$pNum,'maxpage'=>ceil($elements_count/$pCount)-1));
?>