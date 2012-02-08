<?php
class ImMsgForm extends CForm{
	public function form($data=array('theme'=>'','text'=>'')){
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
			$this->sec();
			$this->target="_self";
			$this->autoframe=FALSE;
			venus_set('html_immsg_form',&$this);
		}
	}
function init_module(){
	if(isGuest()) throw new NotAuthException();
}
function module_index(){
	$pNum=(isset(core::$query[2]) and is_numeric(core::$query[2]))?intval(core::$query[2]):0;
	$pCount=10;
	$l1=$pNum*$pCount;
	$sqlr=db::query('SELECT count(*) as count FROM '.db::table('im').' WHERE toID='.core::$user['uID'].';');
	$count=db::fetch_array($sqlr);
	$count=$count['count'];
	db::query('UPDATE '.db::table('users').' SET newmsg=0 WHERE uID='.core::$user['uID'].';');
	core::$user['newmsg']=0;
	$sqlr=db::query('SELECT * FROM '.db::table('im').' t1, '.db::table('users').' t2  WHERE t1.toID='.core::$user['uID'].' AND t1.deleted<>1 AND t1.fromID=t2.uID ORDER BY t1.mID DESC LIMIT '.$l1.','.$pCount.';');
	$l=array();
	if(db::num_rows($sqlr)>0){
		db::query('UPDATE '.db::table('im').' SET readed=1 WHERE  toID='.core::$user['uID'].' AND readed=0;');
		while($m=db::fetch_array_assoc($sqlr)) $l[]=$m;
	}
	venus_set('msg_list',$l);
	venus_set('msg_count',$count);
	venus_set('pNum',$pNum);
	venus_set('pCount',$pCount);
	venus_ctpl(TDIR.'views/im/index.php');
}
function module_out(){
	$pNum=(isset(core::$query[2]) and is_numeric(core::$query[2]))?intval(core::$query[2]):0;
	$pCount=10;
	$l1=$pNum*$pCount;
	$sqlr=db::query('SELECT count(*) as count FROM '.db::table('im').' WHERE fromID='.core::$user['uID'].';');
	$count=db::fetch_array($sqlr);
	$count=$count['count'];
	$sqlr=db::query('SELECT * FROM '.db::table('im').' t1, '.db::table('users').' t2  WHERE t1.fromID='.core::$user['uID'].' AND  t1.deleted<>2 AND t1.toID=t2.uID ORDER BY t1.mID DESC LIMIT '.$l1.','.$pCount.';');
	$l=array();
	if(db::num_rows($sqlr)>0) while($m=db::fetch_array_assoc($sqlr)) $l[]=$m;
	venus_set('msg_list',$l);
	venus_set('msg_count',$count);
	venus_set('pNum',$pNum);
	venus_set('pCount',$pCount);
	venus_ctpl(TDIR.'views/im/out.php');
}

function module_delete(){
	if(!isset($_POST['mid'])) throw new MessageException(lt('incorrect_data'));
	$mid_l=array();
	foreach($_POST['mid'] as $k=>$mid){
		if(!is_numeric($mid) or $mid<1) throw new MessageException(lt('incorrect_data'));
		$mid_l[]=intval($mid);
	}
	if(count($mid_l)==0) throw new MessageException(lt('incorrect_data')); 
	$r=db::query('UPDATE '.db::table('im').' SET '.($msg['fromID']==core::$user['uID']?'deleted=2':'deleted=1').' WHERE mID IN ('.implode(',',$mid_l).') AND deleted=0;');
	$r=db::query('DELETE FROM '.db::table('im').' WHERE mID IN ('.implode(',',$mid_l).') AND deleted>0;');
	venus_message(lt('im_msgdeleted'));
	venus_ctpl(TDIR.'views/im/delete.php');
}
function module_history(){
	if(!isset(core::$query[2]) or !is_numeric(core::$query[2])) throw new MessageException(lt('incorrect_data'));
	if(abs(intval(core::$query[2]))==core::$user['uID']) throw new MessageException(lt('incorrect_data'));
	$r=db::query('SELECT * FROM '.db::table('users').' WHERE uID='.abs(intval(core::$query[2])).';');

	$user_from=db::fetch_array_assoc($r);
	if($user_from==null) throw new AccessException();
	$user_from['online']=($user_from['lvisit']>time()-420);
	//----------ACCESS LIST--------------------------------------------

	//access  to send IM
	$actable['im']=true;
	venus_set_ac_table($actable);
	//------------------------------------------------------
	if(db::num_rows($r)==0)  throw new MessageException(lt('incorrect_data'));
	if(isset(core::$query[3]) and core::$query[3]=='send' and access('im')){
			$form=new ImMsgForm();
			$form->form();
			$form->validate($_POST);
			if(!$form->validated){
				venus_error(lt('incorrect_data'));	
			}else{
				db::query('INSERT INTO '.db::table('im').' SET fromID='.core::$user['uID'].', toID='.$user_from['uID'].',theme=?,text=?,datetime=?;',
				array($_POST['theme'],addslashes(venus_hyperlink($_POST['text'])),time()));
				db::query('UPDATE '.db::table('users').' SET newmsg=newmsg+1 WHERE uID='.$user_from['uID'].';');
				venus_message(lt('im_msgsended'));
				
			}
	}
	$pNum=(isset(core::$query[3]) and is_numeric(core::$query[3]))?intval(core::$query[3]):0;
	$pCount=30;
	$l1=$pNum*$pCount;
	$sqlr=db::query('SELECT count(*) as count FROM '.db::table('im').' WHERE (toID='.core::$user['uID'].' AND fromID='.$user_from['uID'].' AND deleted<>1) OR (fromID='.core::$user['uID'].' AND toID='.$user_from['uID'].' AND deleted<>2);');
	$count=db::fetch_array($sqlr);
	$count=$count['count'];
	db::query('UPDATE '.db::table('im').' SET readed=1 WHERE  toID='.core::$user['uID'].' AND fromID='.$user_from['uID'].' AND readed=0;');
	$c=db::affected_rows();
	db::query('UPDATE '.db::table('users').' SET newmsg=newmsg-'.$c.' WHERE uID='.core::$user['uID'].';');
	core::$user['newmsg']-=$c;
	$sqlr=db::query('SELECT * FROM '.db::table('im').' WHERE (toID='.core::$user['uID'].' AND fromID='.$user_from['uID'].' AND deleted<>1) OR (fromID='.core::$user['uID'].' AND toID='.$user_from['uID'].' AND deleted<>2) ORDER BY mID DESC LIMIT '.$l1.','.$pCount.';');
	$l=array();
	if(db::num_rows($sqlr)>0)
		while($m=db::fetch_array_assoc($sqlr)) $l[]=$m;
	if(access('im')){
		$form=new ImMsgForm();
		$form->action=l((MODE=='admin'?'admin/':'').'im/history/'.$user_from['uID'].'/send');
		$form->form();
	}
	venus_set('msg_list',$l);
	venus_set('msg_count',$count);
	venus_set('pNum',$pNum);
	venus_set('pCount',$pCount);
	venus_set('user_from',$user_from);
	venus_ctpl(TDIR.'views/im/history.php');
}

?>