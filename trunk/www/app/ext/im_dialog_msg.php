<?php
define('EXTENSION',1);

function im_friends($id1,$id2){
	$r=db::query('SELECT * FROM `'.db::table('friends').'` WHERE (`friend1`="'.$id1.'" and `friend2`="'.$id2.'")or(`friend1`="'.$id2.'" and `friend2`="'.$id1.'");');
	if(db::num_rows($r)==0)  return FALSE;
	return TRUE;
}
function im_history(){
	if(isGuest()){ echo 'error'; return;}
	if(!isset($_REQUEST['user']) or !is_numeric($_REQUEST['user'])) {echo 'error';return;}
	if(abs(intval($_REQUEST['user']))==core::$user['uID']) {echo 'error';return;};
	$r=db::query('SELECT * FROM `'.db::table('users').'` WHERE `uID`="'.abs(intval($_REQUEST['user'])).'";');

	$user_from=db::fetch_array_assoc($r);
	if($user_from==null) {echo 'error';return;};
	$user_from['online']=($user_from['lvisit']>time()-60);
	//----------ACCESS LIST--------------------------------------------
	$is_friend=im_friends($user_from['uID'],core::$user['uID']);
	//access  to send IM
	if($user_from['access_im']==0) $actable['im']=FALSE;
	else if($user_from['access_im']==2 and $is_friend) $actable['im']=TRUE;
	else if($user_from['access_im']==1) $actable['im']=TRUE;
	else $actable['im']=FALSE;
	venus_set_ac_table($actable);
	//------------------------------------------------------
	if(db::num_rows($r)==0){echo 'error';return;}
	if(isset($_REQUEST['send']) and access('im')){
			$_REQUEST['setreaded']=1;
			$attach='';
			if(isset($_REQUEST['attach']) and is_numeric($_REQUEST['attach'])){
				$file=db::select_array('SELECT * FROM `'.db::table('myfiles').'` WHERE `fileID`="'.intval($_REQUEST['attach']).'" and `user`="'.core::$user['uID'].'";');
				if($file!=null){
					$attach=addslashes(json_encode(array($file)));				
				}
			}
			$form=new ImMsgForm();
			$form->form();
			$form->validate($_POST);
			if(!$form->validated){
					venus_error(lt('incorrect_data'));	
			}else{
				db::query('INSERT INTO `'.db::table('im').'` SET `fromID`='.core::$user['uID'].', `toID`='.$user_from['uID'].','
				.'`theme`="'.$_REQUEST['theme'].'",`text`="'.addslashes(venus_hyperlink($_REQUEST['text'])).'",`attach`="'.$attach.'",`datetime`='.time().';');
				db::query('UPDATE `'.db::table('users').'` SET `newmsg`=`newmsg`+1 WHERE `uID`='.$user_from['uID'].';');
				venus_message(lt('im_msgsended'));
				
			}
			
	}
	$pNum=(isset($_REQUEST['page']) and is_numeric($_REQUEST['page']))?intval($_REQUEST['page']):0;
	$pCount=30;
	$l1=$pNum*$pCount;
	$sqlr=db::query('SELECT count(*) as `count` FROM `'.db::table('im').'` WHERE (`toID`='.core::$user['uID'].' AND `fromID`='.$user_from['uID'].' AND `deleted`<>1) OR (`fromID`='.core::$user['uID'].' AND `toID`='.$user_from['uID'].' AND `deleted`<>2);');
	$count=db::fetch_array($sqlr);
	$count=$count['count'];
	if(isset($_REQUEST['setreaded'])){
		db::query('UPDATE `'.db::table('im').'` SET `readed`=1 WHERE  toID='.core::$user['uID'].' AND `fromID`='.$user_from['uID'].' AND `readed`=0;');
		$c=db::affected_rows();
		db::query('UPDATE `'.db::table('users').'` SET `newmsg`=`newmsg`-'.$c.' WHERE `uID`='.core::$user['uID'].';');
	}
	$last_id=(isset($_REQUEST['last_id']) and is_numeric($_REQUEST['last_id']))?abs(intval($_REQUEST['last_id'])):0;
	$sqlr=db::query('SELECT * FROM `'.db::table('im').'` WHERE ((`toID`='.core::$user['uID'].' AND `fromID`='.$user_from['uID'].' AND `deleted`<>1) OR (`fromID`='.core::$user['uID'].' AND `toID`='.$user_from['uID'].' AND `deleted`<>2)) AND `mID`>'.$last_id.' ORDER BY `mID` DESC LIMIT '.$l1.','.$pCount.';');
	$l=array();
	if(db::num_rows($sqlr)>0) while($m=db::fetch_array_assoc($sqlr)) $l[]=$m;

	//venus_set('msg_list',$l);
	//venus_set('msg_count',$count);
	venus_set('pNum',$pNum);
	venus_set('pCount',$pCount);
	//venus_set('user_from',$user_from);
	echo json_encode(array('syserr'=>venus_have_errors()?implode('. ',core::$errors):'','sysmsg'=>venus_get('message'),'list'=>$l,'msg_count'=>$count,'user_from'=>$user_from));		

}
function extension(){
class ImMsgForm extends CForm{
	public function form($data=array()){
			$field=array(
				'caption'=>lt('im_msgtheme'),
				'name'=>'theme',
				'type'=>TEXT_FIELD_TYPE,
				'validation'=>TEXT_TYPE,
				'filters'=>'htmlspecialchars,size,stripwhitespaces',
				'minsize'=>0,
				'maxsize'=>255,
				'value'=>$data['theme'],
				'help'=>lt('im_msgthemed')
			);
			$this->add_field($field);
			$field=array(
				'caption'=>lt('im_msgtext'),
				'name'=>'text',
				'type'=>TEXTAREA_FIELD_TYPE,
				'validation'=>TEXT_TYPE,
				'filters'=>'htmlspecialchars,size,stripwhitespaces,trim',
				'minsize'=>1,
				'maxsize'=>1000,
				'options'=>array('cols'=>35,'rows'=>7),
				'value'=>$data['text'],
				'help'=>lt('im_msgtextd')
			);
			$this->add_field($field);
			//$this->sec();
			$this->sec=FALSE;
			$this->target="_self";
			$this->autoframe=FALSE;
		}
	}
		venus_output('direct');	
		im_history();
		
		
}
chdir('./../../');
define('ADIR','app/');
include(ADIR.'include/core.class.php');
core::run();
?>