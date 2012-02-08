<?php
function create_element($cls,$vars=null){
		if(!class_exists('t'.$cls)){
				//if(!file_exists('app/etypes/'.$cls.'.php') or !in_array($cls, core::$settings['etypes'])) throw new NotFoundException('Element type '.$cls.' not found');
				if(!file_exists('app/etypes/'.$cls.'.php')) throw new NotFoundException('Element type '.$cls.' not found');
				include_once('app/etypes/'.$cls.'.php');
			}
		$cls='t'.$cls;
		if($vars==null) return new $cls();
		$e=new $cls();
		foreach($vars as $k=>$v){
			$e->$k=$v;
		}
		return $e;
	}
function load_element($eID,$data='*',$eType='',$vars=null){
		if(!is_numeric($eID)) return FALSE;
		if($eType==''){
				$elrow=db::select_array('SELECT eType FROM '.db::table('elements').' WHERE eID='.intval($eID).' LIMIT 1;');
				if($elrow==null) return FALSE;
				$eType=$elrow['eType'];
		}
		
		$c=create_element($eType,$vars);
		$c->e_load_full($eID);
		if($c->eID==0) return FALSE;
		return $c;
	}
abstract class stdel{
/*standart type element data*/
		public $form='EForm';
		public $table='content_categories';
		public $fields=array();
		public $search_fields=array('description');//data using in search engine
		public $eType='category';
		public $eID=0;
		public $ePID=0;
		public $ePTree='';
		public $eAID=0;
		public $eCDate;
		public $eUDate;
		public $ePassword='';
		public $eFurl='';
		public $eTags='';
		public $eData;
		public $eTitle='';
		public $eMDescription='';
		public $eMKeywords='';
		public $eCCount=0;
		public $eActive=1;
		public $eNoindex=0;
		public $eViews=0;
		public $title;
//access
		public $accessGID=3;
		public $defaultAccess=array('read'=>UT_GUEST,'edit'=>UT_ADMIN,'delete'=>UT_ADMIN,'add'=>UT_ADMIN,'add_category'=>UT_ADMIN,'comment'=>UT_ADMIN);//'033333';
		public $grant_read=null;
		public $grant_edit=null;
		public $grant_delete=null;
		public $grant_add=null;
		public $grant_category=null;
		public $grant_comment=null;
//subtypes
		public $subtypes=array();
//
		public $c4page=30;//comments count for element page
		public $e4page=20;//child elements count for element page
		public function __construct(){
			$this->fields=array(
	 			'description'=>array(
						'caption'=>lt('eldescription').'*',
						'name'=>'description',
						'type'=>TEXTAREA_FIELD_TYPE,
						'validation'=>TEXT_TYPE,
						'filters'=>'size',
						'minsize'=>1,
						'maxsize'=>255,
						'help'=>lt('eldescriptiond'),
	 					'options'=>array(
	 						'cols'=>40,
	 						'rows'=>3
	 					)
	 				),
			);
		}
		public function e_load_childs($pNum=0,$pCount=null){
				$pCount=($pCount==null)?$this->e4page:$pCount;
				$chCount=0;$el=array();
				if(count($this->subtypes)>0){		
						$l1=$pNum*$pCount;
						$sqlcount1='SELECT count(*) as count FROM '.db::table('elements').'  WHERE ePID=? and eActive=1 and eNoindex=0 and eType=?;';
						$arr=db::select_array($sqlcount1,array($this->eID,$this->subtypes[0]));
						$catCount=$arr['count'];
						$sqlcount2='SELECT count(*) as count FROM '.db::table('elements').'  WHERE ePID=? and eActive=1 and eNoindex=0 and eType=?;';
						$arr=db::select_array($sqlcount2,array($this->eID,$this->subtypes[1]));
						$conCount=$arr['count'];
						$chCount=$conCount+$catCount;
						$ctcount=$catCount;
						if($catCount>0){
								$cat=create_element($this->subtypes[0]);
								$er=db::query('SELECT * FROM '.db::table('elements').' t1, '.db::table('elements_access').' t2, '.db::table($cat->table).' t3 WHERE t1.eID=t2.eID AND t3.eID=t1.eID AND  t2.gID=? AND t1.ePID=? and  t1.eActive=1 and t1.eNoindex=0 and t1.eType=? ORDER BY t1.eID DESC LIMIT '.$l1.','.$pCount.';',array(core::$user['gID'],$this->eID,$cat->eType));
								$ctcount=db::num_rows($er);
								if($ctcount>0) while($elrow=db::fetch_array_assoc($er)){$cat=create_element($this->subtypes[0]);$cat->e_load_full_array($elrow);$el[]=$cat;};
							}
						if($ctcount<$pCount and $conCount>0){
								$cnl1=($ctcount<$pCount and $ctcount!=0)? 0 : $pNum*$pCount-$catCount;
								$cnpCount=$pCount-$ctcount;
								$con=create_element($this->subtypes[1]);
								$er=db::query('SELECT * FROM '.db::table('elements').' t1, '.db::table('elements_access').' t2, '.db::table($con->table).' t3 WHERE t1.eID=t2.eID AND t3.eID=t1.eID AND t2.gID=? AND t1.ePID=?  and  t1.eActive=1  and eNoindex=0  and t1.eType=? ORDER BY t1.eID DESC LIMIT '.$cnl1.','.$cnpCount.';',array(core::$user['gID'],$this->eID,$con->eType));
								$cncount=db::num_rows($er);
								if($cncount>0) while($elrow=db::fetch_array_assoc($er)){$con=create_element($this->subtypes[1]);$con->e_load_full_array($elrow);$el[]=$con;};
							}
					}
				venus_set('child_elements_count',$chCount);
				venus_set('child_elements_list',$el);
			}
		public function e_ptree_load(){
			if($this->ePID<=0){
				$this->ePTree='';
				return $this->ePTree;
			}
			$p=db::select_array('SELECT eID,ePTree FROM '.db::table('elements').' WHERE eID='.$this->ePID.';');		
			if(!empty($p['ePTree'])){
				$this->ePTree=$p['eID'].','.$p['ePTree'];
				return $this->ePTree;
			}
			$this->ePTree=$p['eID'];
			return $this->ePTree;;				
		}
		public function e_check_data(){		
				if($this->accessGID>core::$user['gID']){
							$_POST['ereadac']=$this->defaultAccess['read'];
							$_POST['eeditac']=$this->defaultAccess['edit'];
							$_POST['edeleteac']=$this->defaultAccess['delete'];
							$_POST['esubac']=$this->defaultAccess['add'];
							$_POST['esubcatac']=$this->defaultAccess['add_category'];
							$_POST['ecommentac']=$this->defaultAccess['comment'];
					}
				$_POST['eTags']=trim(mb_convert_case(isset($_POST['eTags'])?$_POST['eTags']:'', MB_CASE_LOWER, ENCODING));
				$_POST['eFurl']=trim(mb_convert_case(isset($_POST['eFurl'])?$_POST['eFurl']:'', MB_CASE_LOWER, ENCODING));
				$eForm=new $this->form();
            	$eForm->make(&$this);
				foreach($eForm->fields as $name=>$field){
            			if($field->type==CHECKBOX_FIELD_TYPE){
								if($field->validation==BOOL_TYPE)
									$_POST[$field->name]=(boolean) isset($_POST[$field->name]);
								else
									$_POST[$field->name]=isset($_POST[$field->name])?$_POST[$field->name]:'';
						}elseif($field->type==FILE_FIELD_TYPE or $field->type==IMAGE_FILE_FIELD_TYPE) $_POST[$field->name]=$this->eData[$field->name];
						if($field->validation==BOOL_TYPE) $_POST[$field->name]=(boolean) $_POST[$field->name];
						elseif($field->validation!=HTML_TYPE and $field->validation!=DATE_TYPE) $_POST[$field->name]=htmlspecialchars($_POST[$field->name]);
						if(!get_magic_quotes_gpc() and $field->type!=DATE_FIELD_TYPE) $_POST[$field->name]=addslashes($_POST[$field->name]);	
            		}
            	$eForm->validate($_POST);
            	if(!$eForm->validated) throw new MessageException(lt('incorrect_data'),MT_ERROR);
				$this->e_ptree_load();
			}
		public function e_load_full($eID){
				$er=db::select_array('SELECT * FROM '.db::table('elements').' t1,'.db::table('elements_access').' t2,'.db::table($this->table).' t3 WHERE t1.eID=t2.eID AND t3.eID=t1.eID AND t2.gID=? AND t1.eID=?;',array(core::$user['gID'],$eID));
				if($er==null) return;
				$this->e_load_full_array(&$er);
			}
		public function e_load_full_array($data){
				if(!is_array($data)) return FALSE;
				foreach($data as $name=>&$value){
						if(property_exists($this,$name)){
								$this->$name=$value;
								unset($data[$name]);
							}
					}
				$this->grant_read=($this->grant_read or (core::$user['uID']==$this->eAID and !isGuest()));
				$this->grant_edit=($this->grant_edit or  (core::$user['uID']==$this->eAID and !isGuest()));
				$this->grant_delete=($this->grant_delete or (core::$user['uID']==$this->eAID and !isGuest()));
				$this->grant_add=$this->grant_add;
				$this->grant_category=$this->grant_category;
				$this->grant_comment=($this->grant_comment and access('post_comments'));
				$this->eData=$data;	
			}
		public function e_add(){
            	$eForm=new $this->form();
            	$eForm->make(&$this);
			}
		public function e_create(){
            	$this->e_check_data();
            	$time=time();
				$fields=$this->fields;
				$fn=array();
				$fv=array();
                foreach($fields as $name=>$value){
					$fn[]=$name.'=?';
					$fv[]=$_POST[$name];
				}
                 $this->eActive=(access('moderate'))?intval($_POST['eActive']):abs(intval(core::$options['moderation'])-1);
                //BEGIN MySQL TRANSACTION
            	db::start_ta();
                /*********************************/
            	db::query('INSERT INTO '.db::table('elements').'(
            	eType,ePID,eAID,eCDate,eUDate,ePassword,eTags,eActive,eTitle,'.
            	'eMDescription,eMKeywords,title,eNoindex)VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?);',
				array($this->eType,$this->ePID,core::$user['uID'],$time,$time,
            	$_POST['ePassword'],$_POST['eTags'],$this->eActive,$_POST['eTitle'],
				$_POST['eMDescription'],$_POST['eMKeywords'],$_POST['title'],$this->eNoindex));
            	$eID=db::insert_id();
				$this->eID=$eID=$eID['eID'];
				
   				db::query('INSERT INTO '.db::table($this->table).'
   				 SET eID='.$this->eID.', '.implode(', ',$fn).';',$fv);
   				$this->e_set_furl();
				$this->e_create_tags();	
				$this->e_create_access();
				$this->e_create_search();
   				/*********************************/
   				db::commit_ta();
   				//END MySQL TRANSACTION

			}
		public function e_edit(){
				$eForm=new $this->form();
            	$eForm->make(&$this,'edit');
			}
		public function e_update(){
				$this->e_check_data();
				$fields=$this->fields;
				$fn=array();
				$fv=array();
                foreach($fields as $name=>$value){
					$fn[]=$name.'=?';
					$fv[]=$_POST[$name];
				}
                $this->eActive=(access('moderate'))?intval($_POST['eActive']):abs(intval(core::$options['moderation'])-1);
                //BEGIN MySQL TRANSACTION
            	db::start_ta();
                /*********************************/
                db::query('UPDATE '.db::table('elements').' SET eUDate=?,ePassword=?,eTags=?,eActive=?,eTitle=?,eMDescription=?,eMKeywords=?,title=? WHERE eID=?;',
				array(time(),$_POST['ePassword'],$_POST['eTags'],$this->eActive,$_POST['eTitle'],$_POST['eMDescription'],$_POST['eMKeywords'],$_POST['title'],$this->eID));

                db::query('UPDATE '.db::table($this->table).'
                SET '.implode(', ',$fn).' WHERE eID="'.$this->eID.'";',$fv);
                $this->e_update_tags();
                $this->e_update_furl();
				$this->e_update_access();
				$this->e_update_search();
   				/*********************************/
   				db::commit_ta();
   				//END MySQL TRANSACTION

			}
		public function e_delete(){
                //BEGIN MySQL TRANSACTION
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

        public function e_create_tags(){
				if($this->eNoindex==1)  return;
        		$tags=explode(',',$_POST['eTags']);
        		foreach($tags as $key=>$tag){
        				$tag=trim($tag);
        				if(!empty($tag)){
        						$sql='SELECT tID FROM '.db::table('tags').' WHERE tag=?;';
         						if(!db::select_array($sql,array($tag))){
        								db::query('INSERT INTO '.db::table('tags').' SET tag=?, count=1;',array($tag));
                        		}else{
                        				db::query('UPDATE '.db::table('tags').' SET count=count+1 WHERE tag=?;',array($tag));
                        		}
                        	}
        			}
        	}
        public function e_update_tags(){
				if($this->eNoindex==1)  return;
        		if($_POST['eTags']==$this->eTags) return TRUE;
        		$this->e_delete_tags();
        		$this->e_create_tags();
        	}
        public function e_delete_tags(){
				if($this->eNoindex==1)  return;
        		$tags=explode(',',$this->eTags);
        		foreach($tags as $key=>$tag){
        					$tag=trim($tag);
        					if(!empty($tag)){
        							db::query('DELETE FROM '.db::table('tags').' WHERE  tag=? AND count=1;',array($tag));
                        			db::query('UPDATE '.db::table('tags').' SET count=count-1 WHERE tag=? AND count>1;',array($tag));
                        		}
                        }
        	}
		public function e_set_furl(){
				$this->eFurl=$_POST['eFurl'];
				$r=db::select_array('SELECT count(*) as count FROM '.db::table('elements').' WHERE eFurl=?;',array($this->eFurl));				
				$eFurl=(($r['count']!=0 OR is_numeric($this->eFurl))?$this->eID:'"'.$this->eFurl.'"');
				db::query('UPDATE '.db::table('elements').' SET eFurl=? WHERE eID=?;',array($eFurl,$this->eID));
			}
		public function e_update_furl(){
				$this->eFurl=$_POST['eFurl'];
				$r1=db::select_array('SELECT count(*) as count FROM '.db::table('elements').' WHERE eFurl=? AND eID!=?;',array($this->eFurl,$this->eID));				
				if($r1['count']!=0 or is_numeric($this->eFurl)) $this->eFurl=$this->eID;
				db::query('UPDATE '.db::table('elements').' SET eFurl=? WHERE eID=?;',array($this->eFurl,$this->eID));
			}
		public function e_search_data(){
				$data=$_POST['title'];
				foreach($this->search_fields as $k=>$v){$data.='.'.strip_tags(preg_replace('/([\/]|\s{2}|[\n])/','',$_POST[$v]));}
				return mb_convert_case($data, MB_CASE_LOWER, ENCODING);
			}
		public function e_create_search(){
				db::query('INSERT INTO '.db::table('search').' SET eID=?, data=?";',array($this->eID,$this->e_search_data()));
			}
		public function e_update_search(){
				db::query('UPDATE '.db::table('search').' SET data=? WHERE eID=?;',array($this->e_search_data(),$this->eID));
			}
		public function e_delete_search(){
				db::query('DELETE FROM '.db::table('search').' WHERE eID='.$this->eID.';');
			}
        public function e_passform(){
				$eForm=new $this->form();
            	$eForm->_password_form();
			}
		public function e_create_access(){
				default_eac_create($this->eID,0,0,intval($_POST['ereadac']<=0),intval($_POST['eeditac']<=0),intval($_POST['edeleteac']<=0),intval($_POST['esubcatac']<=0),intval($_POST['esubac']<=0),intval($_POST['ecommentac']<=0));
				default_eac_create($this->eID,1,0,intval($_POST['ereadac']<=1),intval($_POST['eeditac']<=1),intval($_POST['edeleteac']<=1),intval($_POST['esubcatac']<=1),intval($_POST['esubac']<=1),intval($_POST['ecommentac']<=1));
				default_eac_create($this->eID,2,0,intval($_POST['ereadac']<=2),intval($_POST['eeditac']<=2),intval($_POST['edeleteac']<=2),intval($_POST['esubcatac']<=2),intval($_POST['esubac']<=2),intval($_POST['ecommentac']<=2));
				default_eac_create($this->eID,3,0,intval($_POST['ereadac']<=3),intval($_POST['eeditac']<=3),intval($_POST['edeleteac']<=3),intval($_POST['esubcatac']<=3),intval($_POST['esubac']<=3),intval($_POST['ecommentac']<=3));
			}
		public function e_update_access(){
				default_eac_update($this->eID,0,0,intval($_POST['ereadac']<=0),intval($_POST['eeditac']<=0),intval($_POST['edeleteac']<=0),intval($_POST['esubcatac']<=0),intval($_POST['esubac']<=0),intval($_POST['ecommentac']<=0));
				default_eac_update($this->eID,1,0,intval($_POST['ereadac']<=1),intval($_POST['eeditac']<=1),intval($_POST['edeleteac']<=1),intval($_POST['esubcatac']<=1),intval($_POST['esubac']<=1),intval($_POST['ecommentac']<=1));
				default_eac_update($this->eID,2,0,intval($_POST['ereadac']<=2),intval($_POST['eeditac']<=2),intval($_POST['edeleteac']<=2),intval($_POST['esubcatac']<=2),intval($_POST['esubac']<=2),intval($_POST['ecommentac']<=2));
				default_eac_update($this->eID,3,0,intval($_POST['ereadac']<=3),intval($_POST['eeditac']<=3),intval($_POST['edeleteac']<=3),intval($_POST['esubcatac']<=3),intval($_POST['esubac']<=3),intval($_POST['ecommentac']<=3));
			}
		public function access($item,$ac=array()){
				//if(!isGuest() and ($this->eAID==core::$user['uID'] or isAdmin())) return TRUE;
				if($this->grant_read==null){
						if(sizeof($ac)==0) $ac=default_eac_load($this->eID,core::$user['gID']);
						$this->grant_read=($ac['grant_read'] or (core::$user['uID']==$this->eAID and !isGuest())  or isAdmin());
						$this->grant_edit=($ac['grant_edit'] or  (core::$user['uID']==$this->eAID and !isGuest())  or isAdmin());
						$this->grant_delete=($ac['grant_delete'] or (core::$user['uID']==$this->eAID and !isGuest()) or isAdmin());
						$this->grant_add=$ac['grant_add'];
						$this->grant_category=$ac['grant_category'];
						$this->grant_comment=($ac['grant_comment'] and access('post_comments'));
					}
				switch($item){
						case 'read':return $this->grant_read;
						case 'edit':return $this->grant_edit;
						case 'delete':return $this->grant_delete;
						case 'add':return $this->grant_add;
						case 'category':return $this->grant_category;
						case 'comment':return $this->grant_comment;
						default:return FALSE;
					}
			}
		public function gaccess($item){
				$r=db::select_array('SELECT min(gID) as gID,count(*) as count FROM '.db::table('elements_access').' WHERE eID='.$this->eID.' AND grant_'.$item.'=1;');
				if($r==null or $r['count']==0) return 4;
				return $r['gID'];
			}
		public function view(){
			db::query('UPDATE '.db::table('elements').' SET eViews=eViews+1 WHERE eID='.$this->eID.';');
		}
	}

?>