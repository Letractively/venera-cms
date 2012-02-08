<?php
define('TAAM_PROJECT_ADMIN',300);
define('TEAM_PROJECT_MANAGER',100);
define('TEAM_PROJECT_USER',200);
function module_init(){
	$user=db::select_array('SELECT * FROM '.db::table('team_project_users').' WHERE uID='.core::$user['uID'].';');
	if(!$user) throw new AccessException();
	define('TEAM_PROJECT_MYTEAMID',$user['team']);
	define('TEAM_PROJECT_MYGROUPID',$user['group']);
	venus_set('team_projet_user',$user);
}
function module_index(){
//вывод назначенных мне активных задач
//вывод уведомлений
	$pCount=20;
	$pNum=(isset(core::$query[2]) and is_numeric(core::$query[2]))?intval(core::$query[2]):0;
	$l1=$pNum*$pCount;
	$task_list=db::select_array_collaction('SELECT * FROM '.db::table('team_projct_tasks').' WHERE to='.core::$user['uID'].' AND active=1 ORDER BY taskID DESC LIMIT '.$l1.','.$pCount.';');

}
function module_list(){
//вывод списка всех задач назначенных мне
	$pCount=20;
	$pNum=(isset(core::$query[2]) and is_numeric(core::$query[2]))?intval(core::$query[2]):0;
	$l1=$pNum*$pCount;	
	$task_list=db::select_array_collaction('SELECT * FROM '.db::table('team_projct_tasks').' WHERE to='.core::$user['uID'].' ORDER BY taskID DESC LIMIT '.$l1.','.$pCount.';');

}
function module_task(){
	$taskID=intval(core::$query[2]);
	$task=db::select_array('SELECT * FROM '.db::table('team_projct_tasks').' WHERE taskID='.$taskID.';');
	if(!$task) throw new NotFoundException();
	$comments=db::select_array_collection('SELECT * FROM '.db::table('team_projct_task_comments').' WHERE task='.$task['taskID'].' ORDER BY commentID ASC;');
	venus_set('task',$task);
	venus_set('comments',$comments);
}
function module_team(){
//вывод моего отдела
	if(TEAM_PROJECT_MYGROUPID==TEAM_PROJECT_MANAGER and ) define('MANAGER',1);
	elseif(TEAM_PROJECT_MYGROUPID!=TEAM_PORJECT_ADMIN) define('ADMIN')
	$users=db::select_array_collection('SELECT * FROM '.db::table('users').' t1, '.db::table('team_project_users').' t2 WHERE t2.uID=t1.uID WHERE team='.TEAM_PROJECT_MYTEAMID.';');
}
function module_manage(){
//управление отделами и сотрудниками
}
function team_project_post_comment($taskID){
	if(isset($_POST['comment'])){
		$comment=$_POST['comment'];
		db::query('INSERT INTO '.db::table('team_project_task_comments').' SET taskID=?,comment=?,time=?,user=?;',array($taskID.$comment,$time,core::$user['uID']));
	}
}
function team_project_drop_comment($commentID){
	db::query('DELETE FROM '.db::table('team_project_task_comments').' WHERE commentID=?;',array($commentID));
}
function team_project_add_team(){
	if(TEAM_PROJECT_MYGROUPID!=TEAM_PORJECT_ADMIN) return FALSE;
	$title=htmlspecialchars($_POST['title']);
	db::query('INSERT INTO '.db::table('team_project_teams').' SET title=?;',array($title));
}
function team_project_update_team(){
	if(TEAM_PROJECT_MYGROUPID!=TEAM_PORJECT_ADMIN) return FALSE;
	$title=htmlspecialchars($_POST['title']);]
	$team=intval($_POST['team']);
	db::query('INSERT INTO '.db::table('team_project_teams').' SET title='.$title.' WHERE team='.$team.';');

}
function team_project_setusergroup($user,$group){
	if(TEAM_PROJECT_MYGROUPID!=TEAM_PORJECT_ADMIN) return FALSE;
	db::query('UPDATE '.db::table('team_project_users').' SET group='.$group.' WHERE uID='.$user.';');
}
function team_project_setuserteam($user,$team){
	if(TEAM_PROJECT_MYGROUPID!=TEAM_PORJECT_ADMIN) return FALSE;
	db::query('UPDATE '.db::table('team_project_users').' SET team='.$team.' WHERE uID='.$user.';');
}
function team_project_teams_get($show=0){
            	$sqlres=db::query('SELECT * FROM '.db::table('departments').' WHERE pID='.$show.' ORDER BY teamID ASC;');
            	if(db::num_rows($sqlres)==0) return array();
            	$items=array();
            	while($item=db::fetch_array($sqlres)){
                    			$item['childs']=menuf_get_items($item['teamID']);
                    			$items[count($items)]=$item;
            		}
            	return $items;
			}
?>