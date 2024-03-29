<?php
class EForm extends CForm{
	public function _password_form(){
			/////////////////////////////////////////////
			$this->fields=array();
			$field=array(
				'caption'=>lt('epassword'),
				'name'=>'ePassword',
				'type'=>PASSWORD_FIELD_TYPE,
				'validation'=>TEXT_TYPE,
				'filters'=>'size',
				'minsize'=>1,
				'maxsize'=>255,
				'help'=>lt('epasswordd')
			);
			$this->add_field($field);
			/////////////////////////////////////////////
			$this->action=l(((MODE=='admin')?'admin/':'').'default/element/'.core::$query[2]);
			$this->target="_self";
			$this->autoframe=FALSE;
			venus_set('html_form',&$this);
		}
	public function make($e,$a='add'){
			//$this->tabs=array('main'=>null,'seo'=>null,'content'=>null,'access'=>null);
			$this->fields=array();
			$this->init($e);
			$this->sec();
			$this->action=($a=='add')?l(((MODE=='admin')?'admin/':'').'default/action/add/'.core::$query[3].'/'.core::$query[4].'/create'):l(((MODE=='admin')?'admin/':'').'default/action/edit/'.core::$query[3].'/update');
			$this->target="_self";
			$this->autoframe=FALSE;
			venus_set('html_form',&$this);
		}

	public function init($e){
			if(access('moderate')){
				$field=array(
						'tab'=>'access',
						'caption'=>lt('eactive'),
						'name'=>'eActive',
						'type'=>CHECKBOX_FIELD_TYPE,
						'validation'=>BOOL_TYPE,
						'help'=>lt('eactived'),
						'value'=>'ON',
						'options'=>array('checked'=>($e->eActive==1))

				);
				$this->add_field($field);
			}
			$field=array(
				'tab'=>'main',
				'caption'=>lt('efurl'),
				'name'=>'eFurl',
				'type'=>TEXT_FIELD_TYPE,
				'validation'=>TEXT_TYPE,
				'filters'=>'htmlspecialchars,stripwhitespaces,size',
				'minsize'=>0,
				'maxsize'=>255,
				'value'=>$e->eFurl,
				'help'=>lt('efurld')
			);

			$this->add_field($field);
			$field=array(
				'tab'=>'main',
				'caption'=>lt('etags'),
				'name'=>'eTags',
				'filters'=>'htmlspecialchars,stripwhitespaces,size',
				'type'=>TEXT_FIELD_TYPE,
				'validation'=>TEXT_TYPE,
				'minsize'=>0,
				'maxsize'=>255,
				'value'=>$e->eTags,
				'help'=>lt('etagsd')
			);
			$this->add_field($field);
			$field=array(
				'tab'=>'seo',
				'caption'=>lt('etitle'),
				'name'=>'eTitle',
				'type'=>TEXT_FIELD_TYPE,
				'validation'=>TEXT_TYPE,
				'filters'=>'htmlspecialchars,stripwhitespaces,size',
				'minsize'=>0,
				'maxsize'=>255,
				'value'=>$e->eTitle,
				'help'=>lt('etitled')
			);
			$this->add_field($field);
			$field=array(
				'tab'=>'seo',
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
				'tab'=>'seo',
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
				'tab'=>'access',
				'caption'=>lt('epassword'),
				'name'=>'ePassword',
				'type'=>PASSWORD_FIELD_TYPE,
				'validation'=>TEXT_TYPE,
				'minsize'=>0,
				'maxsize'=>255,
				'value'=>$e->ePassword,
				'help'=>lt('epasswordd')
			);
			$this->add_field($field);
			if($e->accessGID<=core::$user['gID']){
					$field=array(
						'tab'=>'access',
						'caption'=>lt('earead'),
						'name'=>'ereadac',
						'type'=>SELECT_FIELD_TYPE,
						'validation'=>NUMERIC_TYPE,
						'value'=>$e->gaccess('read'),
						'help'=>lt('eareadd'),
						'options'=>array(
								'size'=>1,
								'items'=>$this->get_perms_list('4')
							),
					);
					$this->add_field($field);
           			$field=array(
           				'tab'=>'access',
						'caption'=>lt('eaedit'),
						'name'=>'eeditac',
						'type'=>SELECT_FIELD_TYPE,
						'validation'=>NUMERIC_TYPE,
						'value'=>$e->gaccess('edit'),
						'help'=>lt('eaeditd'),
						'options'=>array(
								'size'=>1,
								'items'=>$this->get_perms_list('4')
							),
					);
					$this->add_field($field);
					$field=array(
						'tab'=>'access',
						'caption'=>lt('eadelete'),
						'name'=>'edeleteac',
						'type'=>SELECT_FIELD_TYPE,
						'validation'=>NUMERIC_TYPE,
						'value'=>$e->gaccess('delete'),
						'help'=>lt('eadeletedd'),
						'options'=>array(
								'size'=>1,
								'items'=>$this->get_perms_list('4')
							),
					);
					$this->add_field($field);
					$field=array(
						'tab'=>'access',
						'caption'=>lt('easubcat'),
						'name'=>'esubcatac',
						'type'=>SELECT_FIELD_TYPE,
						'validation'=>NUMERIC_TYPE,
						'value'=>$e->gaccess('category'),
						'help'=>lt('easubcatd'),
						'options'=>array(
								'size'=>1,
								'items'=>$this->get_perms_list()
							),
					);
					$this->add_field($field);
					$field=array(
						'tab'=>'access',
						'caption'=>lt('easub'),
						'name'=>'esubac',
						'type'=>SELECT_FIELD_TYPE,
						'validation'=>NUMERIC_TYPE,
						'value'=>$e->gaccess('add'),
						'help'=>lt('easubd'),
						'options'=>array(
								'size'=>1,
								'items'=>$this->get_perms_list()
							),
					);
					$this->add_field($field);
					$field=array(
						'tab'=>'access',
						'caption'=>lt('eacomment'),
						'name'=>'ecommentac',
						'type'=>SELECT_FIELD_TYPE,
						'validation'=>NUMERIC_TYPE,
						'help'=>lt('eacommentd'),
						'value'=>$e->gaccess('comment'),
						'options'=>array(
								'size'=>1,
								'items'=>$this->get_perms_list()
							),
					);
					$this->add_field($field);
				}
				$field=array(
						'tab'=>'content',
						'caption'=>lt('eltitle'),
						'name'=>'title',
						'type'=>TEXT_FIELD_TYPE,
						'validation'=>TEXT_TYPE,
						'filters'=>'htmlspecialchars,stripwhitespaces,size',
						'minsize'=>1,
						'maxsize'=>255,
						'help'=>lt('eltitled'),
						'value'=>$e->title,
	 			);
				$this->add_field($field);
			if(isset($e->fields['ePrice'])) $e->eData['ePrice']=$e->ePrice;
			foreach($e->fields as $title=>$field){
					if($field['type']==CHECKBOX_FIELD_TYPE)
						$field['options']=array('checked'=>$e->eData[$field['name']]);
					elseif($field['type']==DATE_FIELD_TYPE){
						$date=explode('-',$e->eData[$field['name']]);
						
						$field['options']['year']=$date[0];
						$field['options']['month']=$date[1];
						$field['options']['day']=$date[2];
					}else	
						$field['value']=$e->eData[$field['name']];
					$field['tab']=isset($field['tab'])?$field['tab']:'content';
                	$this->add_field($field);
				}
		}
	private function get_perms_list($not=''){
			$r=array(
						'4'=>array('value'=>'4','caption'=>lt('group_nobody')),
						'3'=>array('value'=>'3','caption'=>lt('group_admins')),
						'2'=>array('value'=>'2','caption'=>lt('group_moderators')),
						'1'=>array('value'=>'1','caption'=>lt('group_users')),
						'0'=>array('value'=>'0','caption'=>lt('group_guests'))
					);
			if($not!=''){
				$not=explode(',',$not);
				if(is_array($not)) foreach($not as $k=>&$notval)if(isset($r[$notval])) unset($r[$notval]);
				else if(isset($r[$not])) unset($r[$not]);
			}
			return $r;
		}
	}
?>