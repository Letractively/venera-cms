<ul>
<?php
if($ctlist!=null)
foreach($ctlist as $i=>&$city){
	echo '<li style="list-style-type:disc;"  onMouseOver="document.getElementById(\'opt_'.$city['cityID'].'\').style.display=\'inline\';" onMouseOut="document.getElementById(\'opt_'.$city['cityID'].'\').style.display=\'none\';">'
	.$city['city_title'].'<br/><div style="display:none;" id="opt_'.$city['cityID'].'">('
	.__l('admin/regions/city/edit/'.$city['cityID'],lt('edit'))
	.'/'
	.__l('admin/regions/city/delete/'.$city['cityID'],lt('delete'))
	.')</div></li>';
}
?>
</ul>
<?php echo venus_nav_links('admin/regions/city/'.$countryID.'/'.$regionID.'/{%page%}',array('pagenow'=>$pNum,'maxpage'=>ceil($count/$pCount)-1));?>