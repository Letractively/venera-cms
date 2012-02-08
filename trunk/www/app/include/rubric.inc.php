<?php
/**
 * Функции для упрощения организации рубрикации
 * 
 * @category   Rubrication
 * @package    Rubrication
 * @author     Ildar Usmanov <wajox@mail.ru>
 * @copyright  Copyright (c) 2009-2012 Wajox Software (http://wajox.myglonet.com)
 * 
 */
 
/**
 * Функция для получения дерева родителей в виде массива идентификаторов
 * @param mixed $selected строка или массив идентификаторов выбранных родительских элементов
 * @param string $table таблица рубрик
 * @return array
 */
function venus_rubric_ptree_load($selected,$table){
		$selected=(is_array($selected) and count($selected)>1)?implode(',',$selected):$selected;
		$table=db::table($table);
		$parents=db::select_array_collection('SELECT eID,ptree FROM '.$table.' WHERE eID IN('.$selected.')');	
		$ptree=array();
		if(count($parents)>0)
			foreach($parents as $k=>$parent){		
					if(!empty($parent['ptree'])){
							$parent['ptree']=explode(',',$parent['ptree']);
							if(count($parent['ptree'])>0 and !empty($parent['ptree'])) foreach($parent['ptree'] as $k=>$v) $ptree[]=$v;
						}
					$ptree[]=$parent['eID'];
				
				}
		return $ptree;				
}

/**
 * Функция получения списка родителей в виде элементов для select поля формы
 * @param string $table
 * @param int $notid
 * @param int $cid
 * @param int $step
 * @param array $list
 * @param string $prefix
 * @param int $ePID
 * @return array
 */
function venus_rubric_ptree_select($table,$notid=-1,$cid=0,$step=0,$list=array(),$prefix='',$ePID=-1){
			if($cid==0){
				$list=array(array('value'=>0,'caption'=>'...'));
			}
			$l=db::select_array_collection('SELECT * FROM '.db::table($table).' as t1,'.db::table('elements').' as t2 WHERE t2.ePID=? AND t1.eID=t2.eID AND t1.parentID=? ORDER BY t1.position;',array($ePID,$cid));
			if($l==null) return $list;
			foreach($l as $i=>&$v){		
					if($notid!=$v['eID']){
						$list[]=array('value'=>$v['eID'],'caption'=>$prefix.$v['title']);
						$list=venus_rubric_ptree_select($table,$notid,$v['eID'],$step+1,$list,$prefix.'&nbsp;&nbsp;',$ePID);
					}
				}
			return $list;
				
		}

?>