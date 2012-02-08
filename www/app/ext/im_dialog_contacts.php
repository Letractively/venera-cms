<?php
define('EXTENSION',1);


function im_contacts(){
	if(isGuest()){ echo 'error'; return;}
	$sql='SELECT count(*) as `count` FROM `'.db::table('friends').'`  WHERE `friend1`='.core::$user['uID'].' OR `friend2`='.core::$user['uID'].';';
	$sqlr=db::query($sql);
	$count=db::fetch_array($sqlr);
	$count=$count['count'];
	$sql='SELECT t2.uID,t2.gender,t2.name,t2.sername,t2.login,t2.lvisit FROM `'.db::table('friends').'` t1,`'.db::table('users').'` t2 WHERE (t1.friend1='.core::$user['uID'].'  AND t1.friend2=t2.uID) OR (t1.friend2='.core::$user['uID'].' AND t1.friend1=t2.uID) LIMIT 1000;';
	$sqlr=db::query($sql);
	$f=array();
	if(db::num_rows($sqlr)>0) while($friend=db::fetch_array_assoc($sqlr)){
		$friend['userpic']=(file_exists('uploads/avatar_'.$friend['uID'].'.jpg')?BASEURL.'uploads/avatar_'.$friend['uID'].'.jpg':THEME.'img/default_avatar_'.$friend['gender'].'.jpg');
		$friend['userlink']=l('userspace/'.$friend['uID']);
		$friend['online']=($friend['lvisit']>time()-180);
		$friend['username']=$friend['name'].' '.$friend['login'].' '.$friend['sername'];
		$friend['unreaded']=0;
		$f[]=$friend;
	}
	$new=db::select_array_collection('SELECT COUNT(*) as `msg_count`,`fromID` as `contactid` FROM `'.db::table('im').'` WHERE `toID`='.core::$user['uID'].' AND `readed`=0 GROUP BY `fromID`;');
	$userpic=(file_exists('uploads/avatar_'.core::$user['uID'].'.jpg')?BASEURL.'uploads/avatar_'.core::$user['uID'].'.jpg':THEME.'img/default_avatar_'.core::$user['gender'].'.jpg');
	echo json_encode(array('newmsg'=>$new,'contacts'=>$f,'count'=>$count,'userlink'=>l('userspace/'.core::$user['uID']),'uID'=>core::$user['uID'],'userpic'=>$userpic,'username'=>core::$user['name'].' '.core::$user['login'].' '.core::$user['sername']));	

}
function extension(){
		venus_output('direct');	
		im_contacts();
		
		
}
chdir('./../../');
define('ADIR','app/');
include(ADIR.'include/core.class.php');
core::run();
?>