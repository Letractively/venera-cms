<?php
class UserForm extends CForm{
	public function _profile_form(){
			$this->initProfile();
			$this->sec();
			$this->action=l(((MODE=='admin')?'admin/':'').'user/action/profile/update');
			$this->target="_self";
			$this->autoframe=FALSE;
			venus_set('profile_form',&$this);
		}
	public function _profile_pwd_form(){
			$this->initProfilePwd();
			$this->sec();
			$this->action=l(((MODE=='admin')?'admin/':'').'user/action/profile/changepwd');
			$this->target="_self";
			$this->autoframe=FALSE;
			venus_set('profile_pwd_form',&$this);
		}
	public function _profile_access_form(){
			$this->initProfileAccess();
			$this->sec();
			$this->action=l(((MODE=='admin')?'admin/':'').'user/action/profile/update_access');
			$this->target="_self";
			$this->autoframe=FALSE;
			venus_set('profile_access_form',&$this);
		}
	public function _reg_form($act=false){
			$this->captcha=TRUE;
			$this->initReg();
			$this->sec();
			$this->action=l(((MODE=='admin')?'admin/':'').'user/action/reg/form/send');
			$this->target="_self";
			$this->autoframe=FALSE;
			if($act!=false) $this->action=$act;
			venus_set('html_form',&$this);
		}
	public function _add_form(){
			$this->initAdd();
			$this->sec();
			$this->action=l(((MODE=='admin')?'admin/':'').'user/action/add/create');
			$this->target="_self";
			$this->autoframe=FALSE;
			venus_set('html_form',&$this);
		}
	public function _edit_form($user){
			$this->initEdit($user);
			$this->sec();
			$this->action=l(((MODE=='admin')?'admin/':'').'user/action/edit/'.$user->uID.'/update');
			$this->target="_self";
			$this->autoframe=FALSE;
			venus_set('html_form',&$this);
		}
	public function _chp_form($uID){
			$this->initChp();
			$this->sec();
			$this->action=l(((MODE=='admin')?'admin/':'').'user/action/chpform/'.$uID.'/update');
			$this->target="_self";
			$this->autoframe=FALSE;
			venus_set('changepwd_form',&$this);
		}
	public function initReg(){
			$field=array(
				'caption'=>lt('email'),
				'name'=>'email',
				'type'=>TEXT_FIELD_TYPE,
				'validation'=>EMAIL_TYPE,
				'filters'=>'htmlspecialchars,stripwhitespaces,size',
				'minsize'=>5,
				'maxsize'=>255,
				'help'=>lt('emaild')
			);
			$this->add_field($field);
			$field=array(
				'caption'=>lt('name'),
				'name'=>'name',
				'type'=>TEXT_FIELD_TYPE,
				'validation'=>TEXT_TYPE,
				'filters'=>'htmlspecialchars,stripwhitespaces,size',
				'minsize'=>1,
				'maxsize'=>255,
				'help'=>lt('named')
			);
			$this->add_field($field);
			$field=array(
				'caption'=>lt('sername'),
				'name'=>'sername',
				'type'=>TEXT_FIELD_TYPE,
				'validation'=>TEXT_TYPE,
				'filters'=>'htmlspecialchars,stripwhitespaces,size',
				'minsize'=>1,
				'maxsize'=>255,
				'help'=>lt('sernamed')
			);
			$this->add_field($field);
			$field=array(
				'caption'=>lt('birthdate'),
				'name'=>'birthdate',
				'type'=>DATE_FIELD_TYPE,
				'validation'=>DATE_TYPE,
				'options'=>array('day'=>date('d'),'month'=>date('m'),'year'=>date('Y'),'start_year'=>intval(date('Y'))-100,'end_year'=>date('Y')),
				'help'=>lt('birthdated')
			);
			$this->add_field($field);
			$field=array(
				'caption'=>lt('gender'),
				'name'=>'gender',
				'type'=>RADIOCOLLECTION_FIELD_TYPE,
				'validation'=>NUMERIC_TYPE,
				'filters'=>'htmlspecialchars,stripwhitespaces,size,int',
				'minsize'=>1,
				'maxsize'=>1,
				'value'=>1,
				'options'=>array('items'=>array(array('caption'=>lt('gender_male'),'value'=>1),array('caption'=>lt('gender_female'),'value'=>0))),
				'help'=>lt('genderd')
			);
			$this->add_field($field);
			$field=array(
				'caption'=>lt('password'),
				'name'=>'password',
				'type'=>PASSWORD_FIELD_TYPE,
				'validation'=>TEXT_TYPE,
				'minsize'=>5,
				'maxsize'=>255,
				'help'=>lt('passwordd')
			);
			$this->add_field($field);
			$field=array(
				'caption'=>lt('password2'),
				'name'=>'password2',
				'type'=>PASSWORD_FIELD_TYPE,
				'validation'=>TEXT_TYPE,
				'minsize'=>5,
				'maxsize'=>255,
				'help'=>lt('password2d')
			);
			$this->add_field($field);

		}
	public function initAdd(){
			$field=array(
				'caption'=>lt('email'),
				'name'=>'email',
				'type'=>TEXT_FIELD_TYPE,
				'validation'=>EMAIL_TYPE,
				'filters'=>'htmlspecialchars,stripwhitespaces,size',
				'minsize'=>5,
				'maxsize'=>255,
				'help'=>lt('emaild')
			);
			$this->add_field($field);
			$field=array(
				'caption'=>lt('name'),
				'name'=>'name',
				'type'=>TEXT_FIELD_TYPE,
				'validation'=>TEXT_TYPE,
				'filters'=>'htmlspecialchars,stripwhitespaces,size',
				'minsize'=>1,
				'maxsize'=>255,
				'help'=>lt('named')
			);
			$this->add_field($field);
			$field=array(
				'caption'=>lt('sername'),
				'name'=>'sername',
				'type'=>TEXT_FIELD_TYPE,
				'validation'=>TEXT_TYPE,
				'filters'=>'htmlspecialchars,stripwhitespaces,size',
				'minsize'=>1,
				'maxsize'=>255,
				'help'=>lt('sernamed')
			);
			$this->add_field($field);
			$field=array(
				'caption'=>lt('login'),
				'name'=>'login',
				'type'=>TEXT_FIELD_TYPE,
				'validation'=>TEXT_TYPE,
				'filters'=>'htmlspecialchars,stripwhitespaces,size',
				'minsize'=>0,
				'maxsize'=>255,
				'help'=>lt('logind')
			);

			$this->add_field($field);
			$field=array(
				'caption'=>lt('password'),
				'name'=>'password',
				'type'=>PASSWORD_FIELD_TYPE,
				'validation'=>TEXT_TYPE,
				'minsize'=>5,
				'maxsize'=>255,
				'help'=>lt('passwordd')
			);
			$this->add_field($field);
			$field=array(
				'caption'=>lt('active'),
				'name'=>'active',
				'type'=>CHECKBOX_FIELD_TYPE,
				'validation'=>BOOL_TYPE,
				'value'=>'ON',
				'help'=>lt('actived')
			);
			$this->add_field($field);
			$field=array(
				'caption'=>lt('group'),
				'name'=>'gID',
				'type'=>SELECT_FIELD_TYPE,
				'validation'=>NUMERIC_TYPE,
				'help'=>lt('groupd'),
				'options'=>array(
						'size'=>1,
						'items'=>$this->get_group_list()
					),
			);
			$this->add_field($field);
		}

	public function initEdit($user){
			$field=array(
				'caption'=>lt('email'),
				'name'=>'email',
				'type'=>TEXT_FIELD_TYPE,
				'validation'=>EMAIL_TYPE,
				'filters'=>'htmlspecialchars,stripwhitespaces,size',
				'minsize'=>5,
				'maxsize'=>255,
				'value'=>$user->email,
				'help'=>lt('emaild')
			);
			$this->add_field($field);
			$field=array(
				'caption'=>lt('name'),
				'name'=>'name',
				'type'=>TEXT_FIELD_TYPE,
				'validation'=>TEXT_TYPE,
				'filters'=>'htmlspecialchars,stripwhitespaces,size',
				'minsize'=>1,
				'maxsize'=>255,
				'value'=>$user->name,
				'help'=>lt('named')
			);
			$this->add_field($field);
			$field=array(
				'caption'=>lt('sername'),
				'name'=>'sername',
				'type'=>TEXT_FIELD_TYPE,
				'validation'=>TEXT_TYPE,
				'filters'=>'htmlspecialchars,stripwhitespaces,size',
				'minsize'=>1,
				'maxsize'=>255,
				'value'=>$user->sername,
				'help'=>lt('sernamed')
			);
			$this->add_field($field);
			$field=array(
				'caption'=>lt('login'),
				'name'=>'login',
				'type'=>TEXT_FIELD_TYPE,
				'validation'=>TEXT_TYPE,
				'filters'=>'htmlspecialchars,stripwhitespaces,size',
				'minsize'=>0,
				'maxsize'=>255,
				'value'=>$user->login,
				'help'=>lt('logind')
			);
			$this->add_field($field);
			$field=array(
				'caption'=>lt('active'),
				'name'=>'active',
				'type'=>CHECKBOX_FIELD_TYPE,
				'validation'=>BOOL_TYPE,
				'value'=>'ON',
				'options'=>array('checked'=>($user->active)),
				'help'=>lt('actived')
			);
			$this->add_field($field);
			$field=array(
				'caption'=>lt('group'),
				'name'=>'gID',
				'type'=>SELECT_FIELD_TYPE,
				'validation'=>NUMERIC_TYPE,
				'help'=>lt('groupd'),
				'options'=>array(
						'size'=>1,
						'items'=>$this->get_group_list($user->gID)
					),
			);
			$this->add_field($field);
		}
	public function initChp(){
			$field=array(
				'caption'=>lt('newpassword'),
				'name'=>'password',
				'type'=>PASSWORD_FIELD_TYPE,
				'validation'=>TEXT_TYPE,
				'minsize'=>5,
				'maxsize'=>255,
				'value'=>'',
				'help'=>lt('newpasswordd')
			);
			$this->add_field($field);
			$field=array(
				'caption'=>lt('cpassword'),
				'name'=>'cpassword',
				'type'=>PASSWORD_FIELD_TYPE,
				'validation'=>TEXT_TYPE,
				'minsize'=>5,
				'maxsize'=>255,
				'value'=>'',
				'help'=>lt('cpasswordd')
			);
			$this->add_field($field);
		}	
	public function initProfilePwd(){
			$field=array(
				'caption'=>lt('oldpassword'),
				'name'=>'oldpassword',
				'type'=>PASSWORD_FIELD_TYPE,
				'validation'=>TEXT_TYPE,
				'minsize'=>5,
				'maxsize'=>255,
				'help'=>lt('oldpasswordd')
			);
			$this->add_field($field);
			$field=array(
				'caption'=>lt('newpassword'),
				'name'=>'password',
				'type'=>PASSWORD_FIELD_TYPE,
				'validation'=>TEXT_TYPE,
				'minsize'=>5,
				'maxsize'=>255,
				'help'=>lt('newpasswordd')
			);
			$this->add_field($field);
			$field=array(
				'caption'=>lt('cpassword'),
				'name'=>'cpassword',
				'type'=>PASSWORD_FIELD_TYPE,
				'validation'=>TEXT_TYPE,
				'minsize'=>5,
				'maxsize'=>255,
				'help'=>lt('cpasswordd')
			);
			$this->add_field($field);
	}
	public function initProfile(){
			$field=array(
				'caption'=>lt('email'),
				'name'=>'email',
				'type'=>TEXT_FIELD_TYPE,
				'validation'=>EMAIL_TYPE,
				'filters'=>'htmlspecialchars,stripwhitespaces,size',
				'minsize'=>5,
				'maxsize'=>255,
				'value'=>core::$user['email'],
				'help'=>lt('emaild')
			);
			$this->add_field($field);
			$field=array(
				'caption'=>lt('name'),
				'name'=>'name',
				'type'=>TEXT_FIELD_TYPE,
				'validation'=>TEXT_TYPE,
				'filters'=>'htmlspecialchars,stripwhitespaces,size',
				'minsize'=>1,
				'maxsize'=>255,
				'value'=>core::$user['name'],
				'help'=>lt('named')
			);
			$this->add_field($field);
			$field=array(
				'caption'=>lt('sername'),
				'name'=>'sername',
				'type'=>TEXT_FIELD_TYPE,
				'validation'=>TEXT_TYPE,
				'filters'=>'htmlspecialchars,stripwhitespaces,size',
				'minsize'=>1,
				'maxsize'=>255,
				'value'=>core::$user['sername'],
				'help'=>lt('sernamed')
			);
			$this->add_field($field);
			$field=array(
				'caption'=>lt('login'),
				'name'=>'login',
				'type'=>TEXT_FIELD_TYPE,
				'validation'=>TEXT_TYPE,
				'filters'=>'htmlspecialchars,stripwhitespaces,size',
				'minsize'=>0,
				'maxsize'=>255,
				'value'=>core::$user['login'],
				'help'=>lt('logind')
			);

			$this->add_field($field);
			$field=array(
				'caption'=>lt('birthdate'),
				'name'=>'birthdate',
				'type'=>DATE_FIELD_TYPE,
				'validation'=>DATE_TYPE,
				'options'=>array('day'=>core::$user['birthday'],'month'=>core::$user['birthmonth'],'year'=>core::$user['birthyear'],'start_year'=>intval(date('Y'))-100,'end_year'=>date('Y')),
				'help'=>lt('birthdated')
			);
			$this->add_field($field);
			$field=array(
				'caption'=>lt('gender'),
				'name'=>'gender',
				'type'=>RADIOCOLLECTION_FIELD_TYPE,
				'validation'=>NUMERIC_TYPE,
				'minsize'=>1,
				'maxsize'=>1,
				'options'=>array('items'=>array(array('caption'=>lt('gender_male'),'value'=>1),array('caption'=>lt('gender_female'),'value'=>0))),
				'value'=>core::$user['gender'],
				'help'=>lt('genderd')
			);
			$this->add_field($field);
			
			$field=array(
				'caption'=>lt('city'),
				'name'=>'city',
				'type'=>SELECTCITY_FIELD_TYPE,
				'validation'=>CITY_TYPE,
				'minsize'=>0,
				'maxsize'=>255,
				'value'=>core::$user['city'],
				'help'=>lt('cityd')
			);
			$this->add_field($field);	
			$field=array(
				'caption'=>lt('about'),
				'name'=>'about',
				'type'=>TEXTAREA_FIELD_TYPE,
				'validation'=>TEXT_TYPE,
				'filters'=>'htmlspecialchars,stripwhitespaces,size',
				'minsize'=>0,
				'maxsize'=>777,
				'value'=>core::$user['about'],
				'help'=>lt('aboutd'),
				'options'=>array('cols'=>50,'rows'=>7)
			);
			$this->add_field($field);
			$field=array(
				'caption'=>lt('avatar'),
				'name'=>'avatar',
				'type'=>IMAGE_FILE_FIELD_TYPE,
				'validation'=>IMAGE_FILE_TYPE,

				'minsize'=>0,
				'maxsize'=>1024*200,
				'options'=>array('max_width'=>200,'max_height'=>400,'form_width'=>100,'filename'=>'avatar_'.core::$user['uID'].'.jpg','upload_dir'=>'uploads','unique'=>FALSE),
				'value'=>'uploads/avatar_'.core::$user['uID'].'.jpg',
				'help'=>lt('avatard')
			);
			$this->add_field($field);
		}
	private function get_group_list($selected=FALSE){
			$result=array();
			$result[0]=array('value'=>'1','caption'=>'User','selected'=>($selected==1));
			$result[1]=array('value'=>'2','caption'=>'Moderator','selected'=>($selected==2));
			$result[2]=array('value'=>'3','caption'=>'Admin','selected'=>($selected==3));
			return $result;
		}
	}
	?>