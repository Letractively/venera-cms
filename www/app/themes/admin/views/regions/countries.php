<ul><?=__l('admin/regions/country/add',lt('addcountry'));?>
<?php
if($clist!=null)
foreach($clist as $i=>&$country){
	echo '<li style="list-style-type:disc;"  onMouseOver="document.getElementById(\'opt_'.$country['countryID'].'\').style.display=\'inline\';" onMouseOut="document.getElementById(\'opt_'.$country['countryID'].'\').style.display=\'none\';">'
	.$country['country_title'].'<br/><div style="display:none;" id="opt_'.$country['countryID'].'">('
	.__l('admin/regions/region/'.$country['countryID'],lt('regionslist'))
	.'/'
	.__l('admin/regions/city/'.$country['countryID'],lt('citieslist'))
	.'/'
	.__l('admin/regions/region/add/'.$country['countryID'],lt('addregion'))
	.'/'
	.__l('admin/regions/city/addtocountry/'.$country['countryID'],lt('addcity'))
	.'/'
	.__l('admin/regions/country/edit/'.$country['countryID'],lt('edit'))
	.'/'
	.__l('admin/regions/country/delete/'.$country['countryID'],lt('delete'))
	.')</div></li>';
}
?>
</ul>