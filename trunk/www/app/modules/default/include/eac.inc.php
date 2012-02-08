<?php
function default_eac_load($eID,$gID,$uID=0){
				$sqlr=db::query('SELECT * FROM `'.db::table('elements_access').'` WHERE `eID`="'.$eID.'" AND `gID`="'.$gID.'" AND (`uID`="0" OR `uID`="'.$uID.'");');
				if(db::num_rows($sqlr)==0) return;
				$r=db::fetch_array($sqlr);
				return $r;
			}
function default_eac_create($eID,$gID,$uID,$read,$edit,$delete,$category,$add,$comment){
				db::query('INSERT INTO `'.db::table('elements_access').'` SET `grant_read`="'.$read.'",`grant_edit`="'.$edit.'",`grant_delete`="'.$delete.'",`grant_category`="'.$category.'",`grant_add`="'.$add.'",`grant_comment`="'.$comment.'",`eID`="'.$eID.'", `gID`="'.$gID.'", `uID`="'.$uID.'";');
			}		
function default_eac_update($eID,$gID,$uID,$read,$edit,$delete,$category,$add,$comment){
				db::query('UPDATE `'.db::table('elements_access').'` SET `grant_read`="'.$read.'",`grant_edit`="'.$edit.'",`grant_delete`="'.$delete.'",`grant_category`="'.$category.'",`grant_add`="'.$add.'",`grant_comment`="'.$comment.'" WHERE `eID`="'.$eID.'" AND `gID`="'.$gID.'" AND `uID`="'.$uID.'";');
			}
function default_eac_delete($eID){
				db::query('DELETE FROM `'.db::table('elements_access').'`  WHERE `eID`="'.$eID.'";');
			}
?>