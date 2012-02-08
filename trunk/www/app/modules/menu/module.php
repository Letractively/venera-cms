<?php
class MenuItemForm extends CForm{
	public function _add_form(){
			$this->tabs=array('main'=>null,'show'=>null,'access'=>null);
			$this->initAdd();
			$this->sec();
			$this->action=l('admin/menu/action/add_item/'.core::$query[3].'/create');
			$this->target="_self";
			$this->autoframe=FALSE;
			venus_set('html_form',&$this);
		}
	public function _edit_form($i){
			$this->initEdit($i);
			$this->sec();
			$this->action=l('admin/menu/action/edit_item/'.core::$query[3].'/update');
			$this->target="_self";
			$this->autoframe=FALSE;
			venus_set('html_form',&$this);
		}
	public function initAdd(){
			$field=array(
				'tab'=>'main',
				'caption'=>lt('mititle').'*',
				'name'=>'iTitle',
				'type'=>TEXT_FIELD_TYPE,
				'validation'=>TEXT_TYPE,
				'minsize'=>1,
				'maxsize'=>255,
				'help'=>lt('mititled')
			);
			$this->add_field($field);
			$field=array(
				'tab'=>'main',
				'caption'=>lt('midescription'),
				'name'=>'iDescription',
				'type'=>TEXT_FIELD_TYPE,
				'validation'=>TEXT_TYPE,
				'minsize'=>0,
				'maxsize'=>255,
				'help'=>lt('midescriptiond')
			);
			$this->add_field($field);
			$field=array(
				'tab'=>'main',
				'caption'=>lt('miurl').'*',
				'name'=>'iUrl',
				'type'=>TEXT_FIELD_TYPE,
				'validation'=>URL_TYPE,
				'minsize'=>1,
				'maxsize'=>255,
				'value'=>'',
				'help'=>lt('miurld')
			);
			$this->add_field($field);
			$field=array(
				'tab'=>'show',
				'caption'=>lt('miindex').'*',
				'name'=>'iIndex',
				'type'=>TEXT_FIELD_TYPE,
				'validation'=>INT_TYPE,
				'minsize'=>1,
				'maxsize'=>255,
				'value'=>0,
				'help'=>lt('miindexd')
			);
			$this->add_field($field);
			$field=array(
				'tab'=>'show',
				'caption'=>lt('mishowon'),
				'name'=>'iShowOn',
				'type'=>TEXT_FIELD_TYPE,
				'validation'=>TEXT_TYPE,
				'minsize'=>1,
				'maxsize'=>255,
				'value'=>'*',
				'help'=>lt('mishowond')
			);
			$this->add_field($field);
			$field=array(
				'tab'=>'main',
				'caption'=>lt('miname'),
				'name'=>'iName',
				'type'=>TEXT_FIELD_TYPE,
				'validation'=>TEXT_TYPE,
				'minsize'=>0,
				'maxsize'=>255,
				'help'=>lt('minamed')
			);
			$this->add_field($field);
			$field=array(
				'tab'=>'access',
				'caption'=>lt('miag0'),
				'name'=>'iAG0',
				'type'=>CHECKBOX_FIELD_TYPE,
				'validation'=>BOOL_TYPE,
				'help'=>lt('miag0d'),
			);
			$this->add_field($field);
			$field=array(
				'tab'=>'access',
				'caption'=>lt('miag1'),
				'name'=>'iAG1',
				'type'=>CHECKBOX_FIELD_TYPE,
				'validation'=>BOOL_TYPE,
				'help'=>lt('miag1d'),
			);
			$this->add_field($field);
			$field=array(
				'tab'=>'access',
				'caption'=>lt('miag2'),
				'name'=>'iAG2',
				'type'=>CHECKBOX_FIELD_TYPE,
				'validation'=>BOOL_TYPE,
				'help'=>lt('miag2d'),
			);
			$this->add_field($field);
			$field=array(
				'tab'=>'access',
				'caption'=>lt('miag3'),
				'name'=>'iAG3',
				'type'=>CHECKBOX_FIELD_TYPE,
				'validation'=>BOOL_TYPE,
				'help'=>lt('miag3d'),
			);
			$this->add_field($field);
		}
	public function initEdit($i){
			$field=array(
				'tab'=>'main',
				'caption'=>lt('mititle').'*',
				'name'=>'iTitle',
				'type'=>TEXT_FIELD_TYPE,
				'validation'=>TEXT_TYPE,
				'minsize'=>0,
				'maxsize'=>255,
				'value'=>$i->iTitle,
				'help'=>lt('mititled')
			);
			$this->add_field($field);
			$field=array(
				'tab'=>'main',
				'caption'=>lt('midescription'),
				'name'=>'iDescription',
				'type'=>TEXT_FIELD_TYPE,
				'validation'=>TEXT_TYPE,
				'minsize'=>0,
				'maxsize'=>255,
				'value'=>$i->iDescription,
				'help'=>lt('midescriptiond')
			);
			$this->add_field($field);
			$field=array(
				'tab'=>'main',
				'caption'=>lt('miurl').'*',
				'name'=>'iUrl',
				'type'=>TEXT_FIELD_TYPE,
				'validation'=>TEXT_TYPE,
				'minsize'=>0,
				'maxsize'=>255,
				'value'=>$i->iUrl,
				'help'=>lt('miurld')
			);
			$this->add_field($field);
			$field=array(
				'tab'=>'show',
				'caption'=>lt('miindex').'*',
				'name'=>'iIndex',
				'type'=>TEXT_FIELD_TYPE,
				'validation'=>TEXT_TYPE,
				'minsize'=>1,
				'maxsize'=>255,
				'value'=>$i->iIndex,
				'help'=>lt('miindexd')
			);
			$this->add_field($field);
			$field=array(
				'tab'=>'show',
				'caption'=>lt('mishowon'),
				'name'=>'iShowOn',
				'type'=>TEXT_FIELD_TYPE,
				'validation'=>TEXT_TYPE,
				'minsize'=>1,
				'maxsize'=>255,
				'value'=>$i->iShowOn,
				'help'=>lt('mishowond')
			);
			$this->add_field($field);
			$field=array(
				'tab'=>'main',
				'caption'=>lt('miname'),
				'name'=>'iName',
				'type'=>TEXT_FIELD_TYPE,
				'validation'=>TEXT_TYPE,
				'minsize'=>0,
				'maxsize'=>255,
				'value'=>$i->iName,
				'help'=>lt('minamed')
			);
			$this->add_field($field);
			$field=array(
				'tab'=>'access',
				'caption'=>lt('miag0'),
				'name'=>'iAG0',
				'type'=>CHECKBOX_FIELD_TYPE,
				'validation'=>BOOL_TYPE,
				'help'=>lt('miag0d'),
				'options'=>array('checked'=>($i->iAG0==1))
			);
			$this->add_field($field);
			$field=array(
				'tab'=>'access',
				'caption'=>lt('miag1'),
				'name'=>'iAG1',
				'type'=>CHECKBOX_FIELD_TYPE,
				'validation'=>BOOL_TYPE,
				'help'=>lt('miag1d'),
				'options'=>array('checked'=>($i->iAG1==1))
			);
			$this->add_field($field);
			$field=array(
				'tab'=>'access',
				'caption'=>lt('miag2'),
				'name'=>'iAG2',
				'type'=>CHECKBOX_FIELD_TYPE,
				'validation'=>BOOL_TYPE,
				'help'=>lt('miag2d'),
				'options'=>array('checked'=>($i->iAG2==1))
			);
			$this->add_field($field);
			$field=array(
				'tab'=>'access',
				'caption'=>lt('miag3'),
				'name'=>'iAG3',
				'type'=>CHECKBOX_FIELD_TYPE,
				'validation'=>BOOL_TYPE,
				'help'=>lt('miag3d'),
				'options'=>array('checked'=>($i->iAG3==1))
			);
			$this->add_field($field);
		}
	private function get_perms_list($selected=3){
			$result=array();
			$result[0]=array('value'=>'3','caption'=>'Admin only','selected'=>($selected==3));
			$result[1]=array('value'=>'2','caption'=>'Moderators','selected'=>($selected==2));
			$result[2]=array('value'=>'1','caption'=>'Users','selected'=>($selected==1));
			$result[3]=array('value'=>'0','caption'=>'Guests','selected'=>($selected==0));
			return $result;
		}

	}
class MenuItem{
	public $iID;
	public $ipID;
	public $iTitle;
	public $iDescription;
	public $iUrl;
	public $iIndex;
	public $iShowOn;
	public $iName;
	public $iAG0;
	public $iAG1;
	public $iAG2;
	public $iAG3;
	public function load(){
			$sqlres=db::query('SELECT * FROM '.db::table('menu').' WHERE iID ='.intval($this->iID).';');
			if(db::num_rows($sqlres)!=1) return FALSE;
			$this->load_array(db::fetch_array($sqlres));
			return TRUE;
		}
	public function load_array($arr){
			if(!is_array($arr)) return FALSE;
			foreach($arr as $name=>$value){
					if(property_exists($this,$name)){
							$this->$name=$value;
						}
				}
			return TRUE;
		}
	public function validate(){
			$form=new MenuItemForm();
			$form->_add_form();
			$form->validate($_POST);
			return $form->validated;
		}
	public function add_form(){
			$form=new MenuItemForm();
			$form->_add_form();
		}
	public function create(){
			if(!$this->validate()) throw new MessageException(lt('incorrect_data'),MT_ERROR);
			$sql='INSERT INTO '.db::table('menu').'(iTitle, iDescription, iUrl, iIndex, ipID, iName, iAG0, iAG1, iAG2,iAG3,iShowOn)VALUES(?,?,?,?,?,?,?,?,?,?,?);';
			db::query($sql,array($this->iTitle,$this->iDescription,$this->iUrl,$this->iIndex,$this->ipID,$this->iName,$this->iAG0,$this->iAG1,$this->iAG2,$this->iAG3,$this->iShowOn));
			venus_message(lt('mi_created'));
		}
	public function edit_form(){
			$this->load();
			$form=new MenuItemForm();
			$form->_edit_form(&$this);
		}
	public function update(){
			if(!$this->validate()) throw new MessageException(lt('incorrect_data'),MT_ERROR);
			$sql='UPDATE '.db::table('menu').' SET  iTitle=?, iDescription=?,iUrl =?,iIndex =?,ipID =?,iName =?,iAG0 =?,iAG1 =?,iAG2 =?,iAG3 =?,iShowOn =? WHERE  iID ='.$this->iID.';';
			db::query($sql,array($this->iTitle,$this->iDescription,$this->iUrl,$this->iIndex,$this->ipID,$this->iName,$this->iAG0,$this->iAG1,$this->iAG2,$this->iAG3,$this->iShowOn));
			venus_message(lt('mi_updated'));
		}
	public function drop(){
			db::query('DELETE FROM '.db::table('menu').' WHERE  iID ='.$this->iID.';');
			venus_message(lt('mi_deleted'));
		}
}

function init_module(){
			if(MODE!='admin') throw new AccessException();
			breadcrumbs::$items=array(array('url'=>l('admin'),'title'=>lt('crumb_admin')),array('url'=>l('admin/menu'),'title'=>lt('crumb_menu')));
		}
function module_index (){
				module_action('items');
			}
function module_action($act=FALSE){
					if(!isAdmin()) throw new AccessException();
					$act=($act==FALSE)?core::$query[2]:$act;
					if(!function_exists('menu_'.$act)) throw new NotFoundException('Action not found!');
					call_user_func('menu_'.$act);
				}
function menu_items(){
				venus_set('menu_items',menuf_get_items());
				venus_ctpl(TDIR.'views/menu/items.php');
			}
function menuf_get_items($show=0){
            	$sqlres=db::query('SELECT * FROM '.db::table('menu').' WHERE ipID='.$show.' ORDER BY iIndex,iID;');
            	if(db::num_rows($sqlres)==0) return array();
            	$items=array();
            	while($item=db::fetch_array($sqlres)){
                    			$item['childs']=menuf_get_items($item['iID']);
                    			$items[count($items)]=$item;
            		}
            	return $items;
			}
function menu_add_item(){
				venus_ctpl(TDIR.'views/menu/forms/item.php');
				try{
					$mi=new MenuItem();
					if(isset(core::$query[4]) and core::$query[4]=='create'){
							$_POST['iAG0']=isset($_POST['iAG0']);
							$_POST['iAG1']=isset($_POST['iAG1']);
							$_POST['iAG2']=isset($_POST['iAG2']);
							$_POST['iAG3']=isset($_POST['iAG3']);
							$_POST['ipID']=intval($mi->iID=core::$query[3]);
							$_POST['iIndex']=intval($_POST['iIndex']);
							$_POST['iID']=0;
							$mi->load_array($_POST);
							$mi->create();
							menu_items();
							return TRUE;
						}
					$mi->add_form();
				}catch(Exception $e){
					venus_error($e->get_message());
					$mi->add_form();
				}
			}
function menu_edit_item(){
				venus_ctpl(TDIR.'views/menu/forms/item.php');
				try{
					$mi=new MenuItem();
					$mi->iID=intval(core::$query[3]);
					$mi->load();
					if(isset(core::$query[4]) and core::$query[4]=='update'){
							$_POST['iAG0']=isset($_POST['iAG0']);
							$_POST['iAG1']=isset($_POST['iAG1']);
							$_POST['iAG2']=isset($_POST['iAG2']);
							$_POST['iAG3']=isset($_POST['iAG3']);
							$_POST['iID']=$mi->iID;
							$_POST['ipID']=intval($mi->ipID);
							$_POST['iIndex']=intval($_POST['iIndex']);
							$mi->load_array($_POST);
							$mi->update();
						}
					$mi->load();
					$mi->edit_form();
				}catch(Exception $e){
					venus_error($e->get_message());
					$mi->load();
					$mi->edit_form();
				}
			}
function menu_drop_item(){
				try{
					$mi=new MenuItem();
					if(!is_numeric(core::$query['3'])) throw new MessageException(lt('incorrect_data'),MT_ERROR);
					$mi->iID=intval(core::$query['3']);
					if(!$mi->load()) throw new MessageException(lt('incorrect_data'),MT_ERROR);
					$mi->drop();
					menu_items();
				}catch(Exception $e){
					venus_error($e->get_message());
					menu_items();
				}
			}
	
?>