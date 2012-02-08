<?php
class comment{
		public $cEID;
		public $cAID;
		public $cID;
		public $cCDate;
		public $cUDate;
		public $cAName;
		public $cAEmail;
		public $cText;
		public $cActive;
		public $cETitle;
		public $cEFurl;
		public function c_load_id($cID,$data='*'){
		    	if(!is_numeric($cID)) return FALSE;
		    	$r=db::select_array('SELECT '.$data.' FROM '.db::table('comments').' WHERE cID=? LIMIT 1;',array($cID));
		    	if(!$r) return FALSE;
		    	$this->c_load_array($r);
		    	return TRUE;
			}
		public function c_load_array($arr){
				if(!is_array($arr)) return FALSE;
				foreach($arr as $name=>$value){
						if(property_exists($this,$name)){
								$this->$name=htmlspecialchars($value);
							}
					}
			}
		public function ca_check_data(){
            	$cForm=new CommentForm();
            	$cForm->_add_form($this);
            	$cForm->validate($_POST);
            	if(!$cForm->validated) throw new MessageException(lt('incorrect_data'),MT_ERROR);
			}
		public function ce_check_data(){
            	$cForm=new CommentForm();
            	$cForm->_edit_form($this);
            	$_POST['cActive']=isset($_POST['cActive']);
            	$cForm->validate($_POST);
            	if(!$cForm->validated) throw new MessageException(lt('incorrect_data'),MT_ERROR);
			}
		public function c_add(){
            	$cForm=new CommentForm();
            	$cForm->_add_form($this);
			}
		public function c_create(){
            	$this->ca_check_data();
				
				$time=time();
				$this->cActive=(access('moderate_comments'))?1:abs(intval(core::$options['comments_moderation'])-1);
				$query='INSERT INTO '.db::table('comments').' SET cEID=?, cAID=?,cCDate=?,cUDate=?,cAName=?,cAEmail=?,cText=?,cActive=?;';
				db::query($query,array($this->cEID,$this->cAID,$time,$time,$this->cAName,$this->cAEmail,$this->cText,$this->cActive));
				
			}
		public function c_edit(){
            	$cForm=new CommentForm();
            	$cForm->_edit_form($this);
			}
		public function c_update(){
            	$this->ce_check_data();
				$time=time();
				$this->cActive=(access('moderate_comments'))?1:abs(intval(core::$options['comments_moderation'])-1);
				$query='UPDATE '.db::table('comments').' SET cAID=?,cUDate=?,cAName=?,cAEmail=?,cText=?,cActive=? WHERE cID=?;';
            	db::query($query,array($this->cAID,$time,$this->cAName,$this->cAEmail,$this->cText,$this->cActive,$this->cID));
			}
		public function c_drop(){
				$query='DELETE FROM '.db::table('comments').' WHERE cID='.$this->cID.';';
            	db::query($query);
			}
//-----------------------------------------------
	}
?>