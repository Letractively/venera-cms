<?php
//MODULE OPTIONS FORM
class UserModuleOptForm extends CForm{

	public function _edit_form(){
			$this->initEdit();
			$this->sec();
			$this->action=l(((MODE=='admin')?'admin/':'').'user/action/options/update');
			$this->target="_self";
			$this->autoframe=FALSE;
			venus_set('html_form',&$this);
		}
	public function initEdit(){
			$items=array('view_user'=>0,'add_user'=>1,'edit_user'=>2,'delete_user'=>3);
			$options=venus_options_load('user','json'); 
           	$field=array(
				'caption'=>lt('ureg').'*',
				'name'=>'registration',
				'type'=>CHECKBOX_FIELD_TYPE,
				'validation'=>BOOL_TYPE,
				'help'=>lt('uregd'),
				'options'=>array(
						'checked'=>($options['value']->o[0]=='1'?' checked="true" ':'')
					),
			);
			$this->add_field($field);
           	$field=array(
				'caption'=>lt('uactivate').'*',
				'name'=>'activation',
				'type'=>CHECKBOX_FIELD_TYPE,
				'validation'=>BOOL_TYPE,
				'help'=>lt('uactivated'),
				'options'=>array(
						'checked'=>($options['value']->o[1]=='1'?' checked="true" ':'')
					),
			);
			$this->add_field($field);
           	$field=array(
				'caption'=>lt('uview').'*',
				'name'=>'view_user',
				'type'=>SELECT_FIELD_TYPE,
				'validation'=>NUMERIC_TYPE,
				'help'=>lt('uviewd'),
				'options'=>array(
						'size'=>1,
						'items'=>$this->get_perms_list(venus_ac_byitem('view_user',$options['value']->a,$items))
					),
			);
			$this->add_field($field);
           	$field=array(
				'caption'=>lt('uadd').'*',
				'name'=>'add_user',
				'type'=>SELECT_FIELD_TYPE,
				'validation'=>NUMERIC_TYPE,
				'help'=>lt('uaddd'),
				'options'=>array(
						'size'=>1,
						'items'=>$this->get_perms_list(venus_ac_byitem('add_user',$options['value']->a,$items))
					),
			);
			$this->add_field($field);
			$field=array(
				'caption'=>lt('uedit').'*',
				'name'=>'edit_user',
				'type'=>SELECT_FIELD_TYPE,
				'validation'=>NUMERIC_TYPE,
				'help'=>lt('ueditd'),
				'options'=>array(
						'size'=>1,
						'items'=>$this->get_perms_list(venus_ac_byitem('edit_user',$options['value']->a,$items))
					),
			);
			$this->add_field($field);
			$field=array(
				'caption'=>lt('udelete').'*',
				'name'=>'delete_user',
				'type'=>SELECT_FIELD_TYPE,
				'validation'=>NUMERIC_TYPE,
				'help'=>lt('udeleted'),
				'options'=>array(
						'size'=>1,
						'items'=>$this->get_perms_list(venus_ac_byitem('delete_user',$options['value']->a,$items))
					),
			);
			$this->add_field($field);
		}
	private function get_perms_list($selected=3){
			$result=array();
			$result[0]=array('value'=>'0','caption'=>'Guest','selected'=>($selected==0)?'selected="true"':'');
			$result[1]=array('value'=>'1','caption'=>'User','selected'=>($selected==1)?'selected="true"':'');
			$result[2]=array('value'=>'2','caption'=>'Moderator','selected'=>($selected==2)?'selected="true"':'');
			$result[3]=array('value'=>'3','caption'=>'Admin','selected'=>($selected==3)?'selected="true"':'');
			return $result;
		}
	}
//------------------------------//
?>