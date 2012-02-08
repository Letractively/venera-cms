<?php
class  CountryForm extends CForm{
	public function form($data=array()){
			$field=array(
				'caption'=>lt('countrytitle'),
				'name'=>'country_title',
				'type'=>TEXT_FIELD_TYPE,
				'validation'=>TEXT_TYPE,
				'minsize'=>1,
				'maxsize'=>255,
				'value'=>$data['country_title'],
				'help'=>lt('countrytitled')
			);
			$this->add_field($field);
			$field=array(
				'caption'=>lt('countrypos'),
				'name'=>'country_pos',
				'type'=>TEXT_FIELD_TYPE,
				'validation'=>NUMERIC_TYPE,
				'minsize'=>1,
				'maxsize'=>100000,
				'value'=>$data['country_pos'],
				'help'=>lt('countryposd')
			);
			$this->add_field($field);
			$this->sec();
			$this->target="_self";
			$this->autoframe=FALSE;
			venus_set('html_country_form',&$this);
		}
	}
class  RegionForm extends CForm{
	public function form($data=array()){
			$field=array(
				'caption'=>lt('regiontitle'),
				'name'=>'region_title',
				'type'=>TEXT_FIELD_TYPE,
				'validation'=>TEXT_TYPE,
				'minsize'=>1,
				'maxsize'=>255,
				'value'=>$data['region_title'],
				'help'=>lt('regiontitled')
			);
			$this->add_field($field);
			$field=array(
				'caption'=>lt('regionpos'),
				'name'=>'region_pos',
				'type'=>TEXT_FIELD_TYPE,
				'validation'=>NUMERIC_TYPE,
				'minsize'=>1,
				'maxsize'=>100000,
				'value'=>$data['region_pos'],
				'help'=>lt('regionposd')
			);
			$this->add_field($field);
			$this->sec();
			$this->target="_self";
			$this->autoframe=FALSE;
			venus_set('html_region_form',&$this);
		}
	}
class  CityForm extends CForm{
	public function form($data=array()){
			$field=array(
				'caption'=>lt('citytitle'),
				'name'=>'city_title',
				'type'=>TEXT_FIELD_TYPE,
				'validation'=>TEXT_TYPE,
				'minsize'=>1,
				'maxsize'=>255,
				'value'=>$data['city_title'],
				'help'=>lt('citytitled')
			);
			$this->add_field($field);
			$field=array(
				'caption'=>lt('citypos'),
				'name'=>'city_pos',
				'type'=>TEXT_FIELD_TYPE,
				'validation'=>NUMERIC_TYPE,
				'minsize'=>1,
				'maxsize'=>100000,
				'value'=>$data['city_pos'],
				'help'=>lt('cityposd')
			);
			$this->add_field($field);
			$this->sec();
			$this->target="_self";
			$this->autoframe=FALSE;
			venus_set('html_city_form',&$this);
		}
	}
function init_module(){
	if(!isAdmin() or MODE!='admin') throw new AccessException();
	init_breadcrumbs();
}
function init_breadcrumbs(){
				breadcrumbs::$items=array();
				breadcrumbs::$items=array(array('url'=>l('admin'),'title'=>lt('crumb_admin')),array('url'=>l('admin/regions/country'),'title'=>lt('crumb_regions_crlist')));
}
function module_index(){
	module_country();
}
function module_country(){
	venus_ctpl(TDIR.'views/regions/forms/country.php');
	$a=isset(core::$query[2])?core::$query[2]:'';
	switch($a){
		case 'add':
				breadcrumbs::add(l('admin/regions/country/add'),lt('crumb_regions_cnadd'));
				if(isset(core::$query[3])){
					try{
						$form=new CountryForm();
						$form->form();
						$form->validate($_POST);
						if(!$form->validated) throw new MessageException(lt('incorect_data'));
						$sql='INSERT INTO '.db::table('countries').' SET country_title=?,'
						.'country_pos='.$_POST['country_pos'].';';
						db::query($sql,array($_POST['country_title']));
						venus_message(lt('countrycreated'));
					}catch(Exception $e){
						venus_error($e->get_message());
					}
				}
				$form=new CountryForm();
				$form->action=l('admin/regions/country/add/save');
				$form->form();
			break;
		case 'edit':
				if(!isset(core::$query[3]) or !is_numeric(core::$query[3])) throw new NotFoundException();
				$cid=core::$query[3];
				$sqlr=db::query('SELECT * FROM '.db::table('countries').' WHERE countryID='.$cid.';');
				if(db::num_rows($sqlr)==0)  throw new NotFoundException();
				$country=db::fetch_array_assoc($sqlr);
				breadcrumbs::add(l('admin/regions/country/edit/'.$cid),$country['country_title']);
				if(isset(core::$query[4])){
					try{
						$form=new CountryForm();
						$form->form();
						$form->validate($_POST);
						if(!$form->validated) throw new MessageException(lt('incorect_data'));
						$sql='UPDATE '.db::table('countries').' SET country_title=?,'
						.'country_pos='.$_POST['country_pos'].' WHERE countryID='.$cid.';';
						db::query($sql,array($_POST['country_title']));
						venus_message(lt('updated'));
					}catch(Exception $e){
						venus_error($e->get_message());
					}
				}
				$sqlr=db::query('SELECT * FROM '.db::table('countries').' WHERE country_id='.$cid.';');
				$data=db::fetch_array_assoc($sqlr);
				$form=new CountryForm();
				$form->action=l('admin/country/edit/'.$cid.'/save');
				$form->form($data);
			break;
		case 'delete':
				if(!isset(core::$query[3]) or !is_numeric(core::$query[3])) throw new NotFoundException();
				$cid=core::$query[3];
				$sqlr=db::query('SELECT * FROM '.db::table('countries').' WHERE countryID='.$cid.';');	
				if(db::num_rows($sqlr)==0)  return venus_error(lt('notfound'));	
				if(!db::query('DELETE FROM  '.db::table('cities').' WHERE city_country='.$cid.';')) return venus_error(lt('cantdelete'));
				if(!db::query('DELETE FROM  '.db::table('regions').' WHERE region_country='.$cid.';')) return venus_error(lt('cantdelete'));
				if(!db::query('DELETE FROM  '.db::table('countries').' WHERE countryID='.$cid.';')) return venus_error(lt('cantdelete'));
				venus_message(lt('deleted'));
		default:
			venus_ctpl(TDIR.'views/regions/countries.php');
			$sql='SELECT * FROM '.db::table('countries').' ORDER BY country_pos,country_title;';
			$sqlr=db::query($sql);
			$cl=array();
			if(db::num_rows($sqlr)>0)
				while($r=db::fetch_array_assoc($sqlr)) $cl[]=$r;
			venus_set('clist',$cl);
		;//list
	}
}

function module_region(){
	breadcrumbs::add(l('admin/regions/region'),lt('crumb_regions_rglist'));
	venus_ctpl(TDIR.'views/regions/forms/region.php');
	$a=isset(core::$query[2])?core::$query[2]:'';
	switch($a){
		case 'add':
				if(!isset(core::$query[3]) or !is_numeric(core::$query[3])) throw new NotFoundException();
				$cid=core::$query[3];
				$sqlr=db::query('SELECT * FROM '.db::table('countries').' WHERE countryID='.$cid.';');
				if(db::num_rows($sqlr)==0)  throw new NotFoundException();
				$country=db::fetch_array_assoc($sqlr);
				breadcrumbs::add(l('admin/regions/region/'.$cid),$country['country_title']);
				breadcrumbs::add(l('admin/regions/region/add/'.$cid),lt('crumb_regions_rgadd'));
				if(isset(core::$query[4])){
					try{
						$form=new RegionForm();
						$form->form();
						$form->validate($_POST);
						if(!$form->validated) throw new MessageException(lt('incorect_data'));
						$sql='INSERT INTO '.db::table('regions').' SET region_title=?,'
						.'region_pos='.$_POST['region_pos'].',region_country='.$cid.';';
						db::query($sql,array($_POST['region_title']));
						venus_message(lt('created'));
					}catch(Exception $e){
						venus_error($e->get_message());
					}
				}
				$form=new RegionForm();
				$form->action=l('admin/regions/region/add/'.$cid.'/save');
				$form->form();
			break;
		case 'edit':
				if(!isset(core::$query[3]) or !is_numeric(core::$query[3])) throw new NotFoundException();
				$rid=core::$query[3];
				$sqlr=db::query('SELECT * FROM '.db::table('regions').' t1,'.db::table('countries').' t2 WHERE t1.regionID='.$rid.' AND t1.region_country=t2.countryID;');
				if(db::num_rows($sqlr)==0)  throw new NotFoundException();
				$region=db::fetch_array_assoc($sqlr);
				breadcrumbs::add(l('admin/regions/region/'.$region['countryID']),$region['country_title']);
				breadcrumbs::add(l('admin/regions/region/edit/'.$rid),$region['region_title']);
				if(isset(core::$query[4])){
					try{
						$form=new RegionForm();
						$form->form();
						$form->validate($_POST);
						if(!$form->validated) throw new MessageException(lt('incorect_data'));
						$sql='UPDATE '.db::table('regions').' SET region_title=?,'
						.'region_pos='.$_POST['region_pos'].' WHERE regionID='.$rid.';';
						db::query($sql,array($_POST['region_title']));
						venus_message(lt('updated'));
					}catch(Exception $e){
						venus_error($e->get_message());
					}
				}
				$sqlr=db::query('SELECT * FROM '.db::table('regions').' WHERE regionID='.$rid.';');
				$data=db::fetch_array_assoc($sqlr);
				$form=new RegionForm();
				$form->action=l('admin/regions/region/edit/'.$rid.'/save');
				$form->form($data);
			break;
		case 'delete':
				if(!isset(core::$query[3]) or !is_numeric(core::$query[3])) throw new NotFoundException();
				$cid=core::$query[3];
				$sqlr=db::query('SELECT * FROM '.db::table('regions').' WHERE regionID='.$cid.';');	
				if(db::num_rows($sqlr)==0)  return venus_error(lt('notfound'));	
				$region=db::fetch_array_assoc($sqlr);
				if(!db::query('DELETE FROM  '.db::table('cities').' WHERE city_region='.$cid.';')) return venus_error(lt('cantdelete'));
				if(!db::query('DELETE FROM  '.db::table('regions').' WHERE regionID='.$cid.';')) return venus_error(lt('cantdelete'));
				venus_message(lt('deleted'));
				core::$query=array('regions','region',$region['region_country']);
		default:
			if(core::$query[2]!=0 and is_numeric(core::$query[2]))
			$where=' WHERE region_country='.intval(core::$query[2]).' ';
			$pNum=(isset(core::$query[3]) and is_numeric(core::$query[3]))?abs(intval(core::$query[3])):0;
			venus_ctpl(TDIR.'views/regions/regions.php');
			$pCount=100;
			$l1=$pNum*$pCount;
			$r=array();	
			$r=db::select_array('SELECT count(*) as count FROM '.db::table('regions').''.$where.';');
			$count=$r['count'];
			if($r['count']>0){
				$sql='SELECT * FROM '.db::table('regions').''.$where.' ORDER BY region_pos,region_title LIMIT '.$l1.','.$pCount.';';
				$sqlr=db::query($sql);
				if(db::num_rows($sqlr)>0)while($r=db::fetch_array_assoc($sqlr)) $rl[]=$r;
			}
			venus_set('rlist',$rl);
			venus_set('pNum',$pNum);
			venus_set('pCount',$pCount);
			venus_set('count',$count);
			venus_set('countryID',abs(intval(core::$query[2])));
		//list
	}
}



function module_city(){
	venus_ctpl(TDIR.'views/regions/forms/city.php');
	$a=isset(core::$query[2])?core::$query[2]:'';
	switch($a){
		case 'addtoregion':
				if(!isset(core::$query[3]) or !is_numeric(core::$query[3])) throw new NotFoundException();
				$rid=core::$query[3];
				$sqlr=db::query('SELECT * FROM '.db::table('regions').' t1, '.db::table('countries').' t2 WHERE t1.regionID='.$rid.' AND t1.region_country=t2.countryID;');
				if(db::num_rows($sqlr)==0)  throw new NotFoundException();
				$region=db::fetch_array_assoc($sqlr);
				breadcrumbs::add(l('admin/regions/region/'.$region['countryID']),$region['country_title']);
				breadcrumbs::add(l('admin/regions/city/'.$region['countryID'].'/'.$rid),$region['region_title']);
				breadcrumbs::add(l('admin/regions/city/addtoregion/'.$rid),lt('crumb_regions_ctadd'));
				if(isset(core::$query[4])){
					try{
						$form=new CityForm();
						$form->form();
						$form->validate($_POST);
						if(!$form->validated) throw new MessageException(lt('incorect_data'));
						$sql='INSERT INTO '.db::table('cities').' SET city_title=?,'
						.'city_pos='.$_POST['city_pos'].',city_country='.$region['countryID'].',city_region='.$region['regionID'].';';
						db::query($sql,array($_POST['city_title']));
						venus_message(lt('created'));
					}catch(Exception $e){
						venus_error($e->get_message());
					}
				}
				$form=new CityForm();
				$form->action=l('admin/regions/city/addtoregion/'.$region['regionID'].'/save');
				$form->form();
			break;
		case 'addtocountry':
				if(!isset(core::$query[3]) or !is_numeric(core::$query[3])) throw new NotFoundException();
				$cid=core::$query[3];
				$sqlr=db::query('SELECT * FROM '.db::table('countries').' WHERE countryID='.$cid.';');
				if(db::num_rows($sqlr)==0)  throw new NotFoundException();
				$country=db::fetch_array_assoc($sqlr);
				breadcrumbs::add(l('admin/regions/region/'.$country['countryID'].'/'.$cid),$country['country_title']);
				breadcrumbs::add(l('admin/regions/city/addtocountry/'.$cid),lt('crumb_regions_ctadd'));
				if(isset(core::$query[4])){
					try{
						$form=new CityForm();
						$form->form();
						$form->validate($_POST);
						if(!$form->validated) throw new MessageException(lt('incorect_data'));
						$sql='INSERT INTO '.db::table('cities').' SET city_title=?,'
						.'city_pos='.$_POST['city_pos'].',city_country='.$country['countryID'].',city_region=0;';
						db::query($sql,array($_POST['city_title']));
						venus_message(lt('created'));
					}catch(Exception $e){
						venus_error($e->get_message());
					}
				}
				$form=new CityForm();
				$form->action=l('admin/regions/city/addtocountry/'.$country['countryID'].'/save');
				$form->form();
			break;
		case 'edit':
				if(!isset(core::$query[3]) or !is_numeric(core::$query[3])) throw new NotFoundException();
				$cid=core::$query[3];
				$sqlr=db::query('SELECT * FROM '.db::table('cities').' WHERE cityID='.$cid.';');
				if(db::num_rows($sqlr)==0)  throw new NotFoundException();
				if(isset(core::$query[4])){
					try{
						$form=new CityForm();
						$form->form();
						$form->validate($_POST);
						if(!$form->validated) throw new MessageException(lt('incorect_data'));
						$sql='UPDATE '.db::table('cities').' SET city_title='.$_POST['city_title'].','
						.'city_pos='.$_POST['city_pos'].' WHERE cityID='.$cid.';';
						db::query($sql);
						venus_message(lt('updated'));
					}catch(Exception $e){
						venus_error($e->get_message());
					}
				}
				$sqlr=db::query('SELECT * FROM '.db::table('cities').' WHERE cityID='.$cid.';');
				$data=db::fetch_array_assoc($sqlr);
				if($data['city_region']==0){
					$region=db::select_array('SELECT * FROM '.db::table('regions').' t1,'.db::table('countries').' t2 WHERE t1.regionID='.$data['city_region'].' AND t1.region_country=t2.countryID;');
					breadcrumbs::add(l('admin/regions/region/'.$region['countryID']),$region['country_title']);
					breadcrumbs::add(l('admin/regions/city/'.$region['countryID'].'/'.$region['regionID']),$region['region_title']);
				}elseif($data['city_country']!=0){
					$country=db::select_array('SELECT * FROM '.db::table('countries').' WHERE countryID='.$data['city_country'].';');
					breadcrumbs::add(l('admin/regions/region/'.$country['countryID']),$country['country_title']);					
				}
				breadcrumbs::add(l('admin/regions/city/edit/'.$data['cityID']),$data['city_title']);
				$form=new CityForm();
				$form->action=l('admin/regions/city/edit/'.$cid.'/save');
				$form->form($data);
			break;
		case 'delete':
				if(!isset(core::$query[3]) or !is_numeric(core::$query[3])) throw new NotFoundException();
				$cid=core::$query[3];
				$sqlr=db::query('SELECT * FROM '.db::table('cities').' WHERE cityID='.$cid.';');	
				if(db::num_rows($sqlr)==0)  return venus_error(lt('notfound'));	
				if(!db::query('DELETE FROM  '.db::table('cities').' WHERE cityID='.$cid.';')) return venus_error(lt('cantdelete'));
				venus_message(lt('deleted'));
				core::$query=array('regions','city');
		default:
			$where='';
			$cid=(isset(core::$query[2]) and core::$query[2]!=0 and is_numeric(core::$query[2]))?core::$query[2]:0;
			$rid=(isset(core::$query[3]) and  core::$query[3]!=0 and is_numeric(core::$query[3]))?core::$query[3]:0;
			if($rid!=0 and $cid!=0){
					$region=db::select_array('SELECT * FROM '.db::table('regions').' t1,'.db::table('countries').' t2 WHERE t1.regionID='.$rid.' AND t1.region_country=t2.countryID;');
					breadcrumbs::add(l('admin/regions/region/'.$region['countryID']),$region['country_title']);
					breadcrumbs::add(l('admin/regions/city/'.$region['countryID'].'/'.$region['regionID']),$region['region_title']);
			}elseif($cid!=0){
					$country=db::select_array('SELECT * FROM '.db::table('countries').' WHERE countryID='.$cid.';');
					breadcrumbs::add(l('admin/regions/region/'.$country['countryID']),$country['country_title']);					
				}
			breadcrumbs::add(l('admin/regions/city/'.$cid.'/'.$rid),lt('crumb_regions_ctlist'));	
			venus_ctpl(TDIR.'views/regions/cities.php');
			$pNum=(isset(core::$query[4]) and is_numeric(core::$query[4]))?abs(intval(core::$query[4])):0;
			$pCount=200;
			$l1=$pNum*$pCount;
			$count=db::select_array('SELECT count(*) as count FROM '.db::table('cities').' WHERE city_country="'.$cid.'" AND city_region="'.$rid.'" ORDER BY city_pos;');
			
			$sql='SELECT * FROM '.db::table('cities').' WHERE city_country="'.$cid.'" AND city_region="'.$rid.'" ORDER BY city_pos,city_title LIMIT '.$l1.','.$pCount.';';
			$sqlr=db::query($sql);
			$cl=array();
			if(db::num_rows($sqlr)>0)
				while($r=db::fetch_array_assoc($sqlr)) $cl[]=$r;
			venus_set('ctlist',$cl);
			venus_set('pNum',$pNum);
			venus_set('count',$count['count']);
			venus_set('pCount',$pCount);
			venus_set('countryID',$cid);
			venus_set('regionID',$rid);
		//list
	}
}
?>