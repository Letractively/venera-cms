<?php
function venus_plugin_menu_st($showon){
				if($showon=='*') return TRUE;
				$pages=explode(';',$showon);
				foreach($pages as $k=>&$page){
					$page=str_replace('/*','',$page);
					$q=implode('/',core::$query);
					$q=(MODE=='admin')?'admin/'.$q:'index/'.$q;
			    	if(substr($q,0,strlen($page))==$page) return TRUE;
				}
			    return FALSE;
		}

function venus_plugin_menu(){
	try{
		$sql='SELECT * FROM '.db::table('menu').' WHERE iAG'.core::$user['gID'].'=1 ORDER BY iIndex,iID;';
		$sqlres=db::query($sql);
        if(db::num_rows($sqlres)==0) return;
        $items=array();
        while($item=db::fetch_array($sqlres)){
            	if(venus_plugin_menu_st($item['iShowOn'])){
							$item['q']=$item['iUrl'];
							if(substr($item['iUrl'],0,3)=='?q='){
									$item['q']=$item['iUrl']=substr($item['iUrl'],3);
									if(MODE=='admin') $item['iUrl']='admin'.((trim($item['iUrl'])=='')?'':'/').$item['iUrl'];
									$item['iUrl']=l($item['iUrl']);
								}
							if(!isset($items[$item['ipID']])) $items[$item['ipID']]=array();
            				$items[$item['ipID']][count($items[$item['ipID']])]=$item;
            			}
            }
	}catch(Exception $e){return;}
		if(count($items[0])>0)
			foreach($items[0] as $index=>$item)
				include(TDIR.'views/plugins/menu.php');
	}

?>