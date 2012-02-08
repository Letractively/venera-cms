<ul>
<?php
if($rlist!=null)
foreach($rlist as $i=>&$region){
	echo '<li style="list-style-type:disc;"  onMouseOver="document.getElementById(\'opt_'.$region['regionID'].'\').style.display=\'inline\';" onMouseOut="document.getElementById(\'opt_'.$region['regionID'].'\').style.display=\'none\';">'
	.$region['region_title'].'<br/><div style="display:none;" id="opt_'.$region['regionID'].'">('
	.__l('admin/regions/city/'.$region['region_country'].'/'.$region['regionID'],lt('citieslist'))
	.'/'
	.__l('admin/regions/city/addtoregion/'.$region['regionID'],lt('addcity'))
	.'/'
	.__l('admin/regions/region/edit/'.$region['regionID'],lt('edit'))
	.'/'
	.__l('admin/regions/region/delete/'.$region['regionID'],lt('delete'))
	.')</div></li>';
}
?>
</ul>
<?php echo venus_nav_links('admin/regions/region/'.$countryID.'{%page%}',array('pagenow'=>$pNum,'maxpage'=>ceil($count/$pCount)-1));?>