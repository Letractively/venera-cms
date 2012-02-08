<?php
function venus_plugin_whoonline(){
		$sql='DELETE FROM '.db::table('whoonline').' WHERE time<'.intval(time()-300).' OR ( uID=? AND ip=? );';
		db::query($sql,array(core::$user['uID'],ip2long($_SERVER['REMOTE_ADDR'])));
		$name=isGuest()?core::$user['login']:core::$user['name'].' '.core::$user['login'].' '.core::$user['sername'];
		$sql='INSERT INTO '.db::table('whoonline').' SET name=?, uID=?,gID=?,ip=?,time=?;';
		db::query($sql,array($name,core::$user['uID'],core::$user['gID'],ip2long($_SERVER['REMOTE_ADDR']),time()));
        $online=array();
        $r=db::query('SELECT * FROM '.db::table('whoonline').';');
        if(db::num_rows($r)>0)
        	while($row=db::fetch_array($r)) $online[]=$row;
		include(TDIR.'views/plugins/whoonline.php');
	}
?>