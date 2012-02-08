<?php
define('EXTENSION',1);
function extension(){
		venus_output('direct');	
		if($_REQUEST['country']==0){
					echo json_encode(array('regions'=>'','cities'=>''));
					return;
			}
		//load countries list
		$selected=array('country'=>0,'region'=>0,'city'=>0);
		$_REQUEST['country']=(isset($_REQUEST['country']) and is_numeric($_REQUEST['country']))?intval($_REQUEST['country']):0;
		$_REQUEST['region']=(isset($_REQUEST['region']) and is_numeric($_REQUEST['region']))?intval($_REQUEST['region']):0;
		$_REQUEST['city']==(isset($_REQUEST['city']) and is_numeric($_REQUEST['city']))?intval($_REQUEST['city']):0;	
		$sql='SELECT * FROM '.db::table('countries').' WHERE countryID='.$_REQUEST['country'].';';
		$cr_exists=FALSE;//country exists in DB flag
		if($_REQUEST['country']!=0 and $_REQUEST['region']!=0){
			$sqlr=db::query('SELECT * FROM '.db::table('regions').' WHERE regionID='.intval($_REQUEST['region']).' ORDER BY region_pos, region_title;');
			if(db::num_rows($sqlr)>0){
				$region=db::fetch_array_assoc($sqlr);
				if($region['region_country']==$_REQUEST['country']){
					$selected['country']=$_REQUEST['country']=$region['region_country'];
					$selected['region']=$region['regionID'];
					$rg_exists=$cr_exists=TRUE;
				}else{
					$sqlr=db::query('SELECT * FROM '.db::table('countries').' WHERE countryID='.$_REQUEST['country'].' ORDER BY country_pos, country_title;');
					if(db::num_rows($sqlr)>0){
						$country=db::fetch_array_assoc($sqlr);
						$selected['country']=$_REQUEST['country'];	
						$cr_exists=TRUE;
					}
				}
			}			
		}elseif($_REQUEST['country']!=0){	
			$sqlr=db::query('SELECT * FROM '.db::table('countries').' WHERE countryID='.$_REQUEST['country'].' ORDER BY country_pos, country_title;');
			if(db::num_rows($sqlr)>0){
				$country=db::fetch_array_assoc($sqlr);
				$selected['country']=$_REQUEST['country'];	
				$cr_exists=TRUE;
			}		
		}elseif($_REQUEST['region']!=0){
			$sqlr=db::query('SELECT * FROM '.db::table('regions').' WHERE regionID='.intval($_REQUEST['region']).' ORDER BY region_pos, region_title;');
			if(db::num_rows($sqlr)>0){
				$region=db::fetch_array_assoc($sqlr);
				$selected['country']=$_REQUEST['country']=$region['region_country'];
				$selected['region']=$region['regionID'];
				$rg_exists=$cr_exists=TRUE;
			}
		}else{

		}
		$sqlr=db::query('SELECT * FROM '.db::table('regions').' WHERE region_country='.intval($_REQUEST['country']).' ORDER BY region_pos, region_title;');
		$rglist=array();
		if(db::num_rows($sqlr)>0) while($r=db::fetch_array_assoc($sqlr)){ $rglist[]=$r;}
		$where='city_country='.intval($_REQUEST['country']).' AND city_region=0';
		if($rg_exists){
			$selected['region']=$_REQUEST['region'];
			$where='(city_country='.intval($_REQUEST['country']).' AND city_region=0)OR(city_country='.$_REQUEST['country'].' AND city_region='.$_REQUEST['region'].')';
		}
		$ctlist=array();
		$sqlr=db::query('SELECT * FROM '.db::table('cities').' WHERE '.$where.' ORDER BY city_title;');
		$ctlist=array();
		$ct_exists=FALSE;
		if(db::num_rows($sqlr)>0) while($r=db::fetch_array_assoc($sqlr)){ $ctlist[]=$r;$ct_exists=($r['cityID']==$_REQUEST['city'] or $ct_exists);};
		if($ct_exists)
		{
			$selected['city']=$_REQUEST['city'];
		}
		$regions='';
		if(count($rglist)!=0){
			$regions='<option value="0">...</option>';
			foreach($rglist as $i=>$region) $regions.='<option value="'.$region['regionID'].'"'.($region['regionID']==$_REQUEST['region']?' selected="true" ':'').'>'.$region['region_title'].'</option>';		
		}
		$cities='';
		if(count($ctlist)!=0){
			$cities='<option value="0">...</option>';
			foreach($ctlist as $i=>$city) $cities.='<option value="'.$city['cityID'].'">'.$city['city_title'].'</option>';
		}
		echo json_encode(array('regions'=>$regions,'cities'=>$cities));	
		
}
chdir('./../../');
define('ADIR','app/');
include(ADIR.'include/core.class.php');
core::run();
?>