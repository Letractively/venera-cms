<?php
class trubric_form extends CForm{
	
	public $table='rubric';
	
	public function make($e){
			$this->table=$e->table;
			$field=array(
				'tab'=>'main',
				'caption'=>lt('emdescription'),
				'name'=>'eMDescription',
				'type'=>TEXT_FIELD_TYPE,
				'validation'=>TEXT_TYPE,
				'filters'=>'htmlspecialchars,stripwhitespaces,size',
				'minsize'=>0,
				'maxsize'=>255,
				'value'=>$e->eMDescription,
				'help'=>lt('emdescriptiond')
			);
			$this->add_field($field);
			$field=array(
				'tab'=>'main',
				'caption'=>lt('emkeywords'),
				'name'=>'eMKeywords',
				'type'=>TEXT_FIELD_TYPE,
				'validation'=>TEXT_TYPE,
				'filters'=>'htmlspecialchars,stripwhitespaces,size',
				'minsize'=>0,
				'maxsize'=>255,
				'value'=>$e->eMKeywords,
				'help'=>lt('emkeywordsd')
			);
			$this->add_field($field);
			$field=array(
				'tab'=>'main',
				'caption'=>lt('rubric_ititle'),
				'name'=>'title',
				'type'=>TEXT_FIELD_TYPE,
				'validation'=>TEXT_TYPE,
				'minsize'=>1,
				'maxsize'=>255,
				'value'=>$e->title,
				'help'=>lt('rubric_ititled')
			);
			$this->add_field($field);
			$field=array(
				'caption'=>lt('rubric_idescription'),
				'name'=>'description',
				'type'=>TEXT_FIELD_TYPE,
				'validation'=>TEXT_TYPE,
				'minsize'=>1,
				'maxsize'=>255,
				'value'=>$e->eData['description'],
				'help'=>lt('rubric_idescriptiond')
			);
			$this->add_field($field);
			$field=array(
				'caption'=>lt('rubric_iparent'),
				'name'=>'parentID',
				'type'=>SELECT_FIELD_TYPE,
				'validation'=>NUMERIC_TYPE,
				'value'=>$e->eData['parentID'],
				'help'=>lt('rubric_iparentd'),
				'options'=>array(
						'size'=>1,
						'items'=>venus_rubric_ptree_select($this->table,$e->eID,0,0,array(),'',$e->ePID)
					),
			);
			$this->add_field($field);
			$field=array(
				'caption'=>lt('rubric_iposition'),
				'name'=>'position',
				'type'=>TEXT_FIELD_TYPE,
				'validation'=>NUMERIC_TYPE,
				'minsize'=>1,
				'maxsize'=>255,
				'value'=>$e->eData['position'],
				'help'=>lt('rubric_ipositiond')
			);
			$this->add_field($field);
			$field=array(
				'name'=>'ptree',
				'type'=>HIDDEN_FIELD_TYPE,
				'validation'=>TEXT_TYPE,
				'minsize'=>0,
				'maxsize'=>255,
				);
			$this->add_field($field);
			$field=array(
				'name'=>'save',
				'type'=>HIDDEN_FIELD_TYPE,
				'validation'=>NUMERIC_TYPE,
				'value'=>1
			);
			$this->add_field($field);
			$this->sec();
			$this->action=$e->save_action;
			$this->target="_self";
			$this->autoframe=FALSE;
			venus_set('html_rubric_form',&$this);
		}
	}	
	class trubric extends stdel{
		public $eNoindex=1;
		public $eType='rubric';
		public $form='trubric_form';
		public $subtypes=array();
		public $table='';
		public $ePID=0;
		public $search_fields=array('title','description');
		public $save_action='';
		public function __construct(){
			$this->fields=array(
			'description'=>array(
				'caption'=>lt('rubric_idescr'),
				'name'=>'description',
				'type'=>TEXT_FIELD_TYPE,
				'validation'=>TEXT_TYPE,
				'minsize'=>1,
				'maxsize'=>255,
				'help'=>lt('rubric_idescrd')
				),
			'parentID'=>array(
				'caption'=>lt('rubric_iparent'),
				'name'=>'parentID',
				'type'=>SELECT_FIELD_TYPE,
				'validation'=>NUMERIC_TYPE,
				'help'=>lt('rubric_iparentd'),
				),
			'position'=>array(
				'caption'=>lt('rubric_ipos'),
				'name'=>'position',
				'type'=>TEXT_FIELD_TYPE,
				'validation'=>NUMERIC_TYPE,
				'minsize'=>1,
				'maxsize'=>255,
				'help'=>lt('rubric_iposd')
				),
			'ptree'=>array(
				'name'=>'ptree',
				'type'=>HIDDEN_FIELD_TYPE,
				'validation'=>TEXT_TYPE,
				'minsize'=>0,
				'maxsize'=>255,
				)
			);
		}
		public function e_check_data(){
				$_POST['eActive']=1;
				$_POST['ePassword']='';
				$_POST['eTitle']=$_POST['title'];
				$_POST['eeditac']=$_POST['edeleteac']=$_POST['esubcatac']=$_POST['esubac']=3;
				$_POST['ereadac']=$_POST['ecommentac']=0;
				$_POST['eFurl']='';
				$ptree=array();
				
				if($_POST['parentID']!=0){
					$parent=db::select_array('SELECT eID,ptree FROM '.db::table($this->table).' WHERE eID='.intval($_POST['parentID']).';');			
					if($parent!=null){
						if(!empty($parent['ptree'])){
							$parent['ptree']=explode(',',$parent['ptree']);
							if(count($parent['ptree'])>0 and !empty($parent['ptree'])) foreach($parent['ptree'] as $k=>$v) $ptree[]=$v;
						}
						$ptree[]=$parent['eID'];
					}
				}
				$_POST['ptree']=implode((count($ptree)>1)?',':'',$ptree);
			}
		public function e_set_furl(){
				$query='UPDATE '.db::table('elements').' SET eFurl='.$this->eID.' WHERE eID='.$this->eID.';';
				db::query($query);
			}
		public function e_update_furl(){
				//$this->e_set_furl();
			}
		public function e_delete(){
                //BEGIN MySQL TRANSACTION
				$data=db::select_array('SELECT ptree FROM '.db::table($this->table).' WHERE eID='.$this->eID.';');
            	db::start_ta();
                /*********************************/
                $this->eID=intval($this->eID);
				db::query('DELETE FROM '.db::table('elements').' WHERE eID='.$this->eID.';');
				db::query('DELETE FROM '.db::table($this->table).' WHERE eID='.$this->eID.';');
				$this->e_delete_tags();
				db::query('DELETE FROM '.db::table('comments').' WHERE cEID='.$this->eID.';');
				default_eac_delete($this->eID);
				$this->e_delete_search();
   				/*********************************/
   				db::commit_ta();
   				//END MySQL TRANSACTION
   				foreach($this->fields as $name=>$field){//delete all files of this element

   				    	if(($field['type']==FILE_FIELD_TYPE or $field['type']==IMAGE_FILE_FIELD_TYPE) and file_exists($this->eData[$name])) 
						{
							unlink($this->eData[$name]);

						}
				}
			}
		public function e_create_search(){
				;//db::query('INSERT INTO '.db::table('search').' SET eID="'.$this->eID.'", data="'.$this->e_search_data().'";');
			}
		public function e_update_search(){
				;//db::query('UPDATE '.db::table('search').' SET data="'.$this->e_search_data().'" WHERE eID="'.$this->eID.'";');
			}
		public function e_delete_search(){
				;//db::query('DELETE FROM '.db::table('search').' WHERE eID="'.$this->eID.'";');
			}
	}
?>