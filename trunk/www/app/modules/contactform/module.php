<?php
class ContactFormForm extends CForm{

	public function init(){
				
			$field=array(
				'caption'=>lt('cfname'),
				'name'=>'cfname',
				'type'=>TEXT_FIELD_TYPE,
				'validation'=>TEXT_TYPE,
				'minsize'=>3,
				'maxsize'=>255,
				'help'=>lt('cfnamed')
			);
			$this->add_field($field);
			$field=array(
				'caption'=>lt('email'),
				'name'=>'cfemail',
				'type'=>TEXT_FIELD_TYPE,
				'validation'=>EMAIL_TYPE,
				'minsize'=>5,
				'maxsize'=>255,
				'help'=>lt('emaild')
			);
			$this->add_field($field);
	 		$field=array(
				'caption'=>lt('cfmessage'),
				'name'=>'cfmessage',
				'type'=>TEXTAREA_FIELD_TYPE,
				'validation'=>TEXT_TYPE,
				'minsize'=>1,
				'maxsize'=>65500,
				'help'=>lt('cfmessaged'),
	 			'options'=>array('cols'=>50,'rows'=>7)
	 		);
			$this->add_field($field);
			$this->captcha=FALSE;
			$this->sec=FALSE;
			$this->sec();
			$this->action=l('contactform');
			venus_set('html_form',&$this);	
		}
}
function module_index(){
				if(MODE=='admin') throw new AccessException();
				$f=new ContactFormForm();
				$f->init();
				if(isset($_POST['cfname'])){		
					$f->validate($_POST);
					if(!$f->validated)
						venus_error(lt('incorrect_data'));
					else{
						$e=new email(core::$settings['email']['contactform'],$_POST['cfemail'],$_POST['cfemail']);
						venus_message(lt('cfsended'));
						try{
							$e->send('contact form from web-site',$_POST['cfmessage']);
						}catch(Exception $e){
							venus_error(lt('cfcantsend'));
						}
							
					}
				}
				venus_ctpl(TDIR.'views/contactform/form.php');
			}

	
?>