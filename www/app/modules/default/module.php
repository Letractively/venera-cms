<?php
include(MDIR.'include/eac.inc.php');
include(MDIR.'include/element.class.php');
include(MDIR.'include/comment.class.php');
function init_breadcrumbs(){
				breadcrumbs::$items=array();
				if(MODE=='admin'){
					breadcrumbs::$items=array(array('url'=>l('admin'),'title'=>lt('crumb_admin')),array('url'=>l('admin/default'),'title'=>lt('crumb_default')));
				}else breadcrumbs::add(l(''),lt('crumb_main'));
			}
function init_module(){
            	$options=venus_options_load('default','json'); 
				$items=array('moderate'=>0,'moderate_comments'=>1,'view_comments'=>2,'post_comments'=>3,'edit_comments'=>4,'delete_comments'=>5);
				venus_ac_table($options['value']->a,$items);
				core::$options['moderation']=$options['value']->o[0];
				core::$options['comments_moderation']=$options['value']->o[1];
			}
function default_load_bcrumbs($elid){
				init_breadcrumbs();
				$bc=array();
				$p=$elid;
				while($p!=0){
						$elrow=db::select_array('SELECT ePID,eFurl,title FROM '.db::table('elements').' WHERE eID="'.$p.'";');
						$bc[sizeof($bc)]=array(l((MODE=='admin'?'admin/':'').'default/element/'.$elrow['eFurl']),$elrow['title']);
						$p=$elrow['ePID'];
					}
				if(count($bc>0)) for($i=sizeof($bc)-1;$i>=0;$i--) breadcrumbs::add($bc[$i][0],$bc[$i][1]);
			}
function module_index(){
				if(!isAdmin() or MODE!='admin') throw new AccessException();
				init_breadcrumbs();
				//--set template------------------------------------------------------------------------------------
            	venus_ctpl(TDIR.'views/default/index.php');
				$pNum=$pCount=$chCount=0;$elements=array();
				$pNum=(isset(core::$query[2]) and is_numeric(core::$query[2]))?intval(core::$query[2]):0;
				$pCount=(isset(core::$query[3]) and is_numeric(core::$query[3]))?intval(core::$query[3]):20;
				$l1=$pNum*$pCount;
				$query='SELECT count(*) as count FROM '.db::table('elements').' WHERE ePID=0 and eActive=1 and eNoindex=0;';
				$arr=db::select_array($query);
				$chCount=$arr['count'];
				if($chCount>0){
						$query='SELECT eID,eType FROM '.db::table('elements').' WHERE ePID=0 and  eActive=1 and eNoindex=0 ORDER BY eID DESC LIMIT '.$l1.','.$pCount.';';
						$r=db::query($query);
						while($elrow=db::fetch_array_assoc($r)){
								$e=load_element($elrow['eID'],'*',$elrow['eType']);
								$elements[]=$e;				
							}
					}
				venus_set('pCount',$pCount);
				venus_set('pNum',$pNum);
				venus_set('child_elements_count',$chCount);
				venus_set('child_elements_list',$elements);
			}
function module_element(){		
				if(!isset(core::$query[2]) or core::$query[2]=='0') throw new AccessException();
				$pID=htmlspecialchars(core::$query[2]);
				
				$elrow=db::select_array('SELECT eID,eType FROM '.db::table('elements').' WHERE eFurl=? and  eActive=1 LIMIT 1;',array($pID));
				if($elrow==null) throw new NotFoundException();
				$element=load_element($elrow['eID'],'*',$elrow['eType']);	
				if(method_exists($element,'redirect')) return $element->redirect();
				$element->view();
				default_load_bcrumbs($element->ePID);
				breadcrumbs::add(l((MODE=='admin'?'admin/':'').'default/element/'.$element->eFurl),$element->title);
				//comment add form---------------------------------------------------------------------------------      			
				if($element->access('comment') and access('post_comments')){
						include_once(MDIR.'include/comment.form.php');
						$comment=new comment();
						$comment->cEID=$element->eID;
						$comment->c_add();
					}
       			//-------------------------------------------------------------------------------------------------
				if(!$element->access('read')) throw new AccessException();
				if(!empty($element->ePassword) and !isAdmin() and core::$user['uID']!=$element->eAID)
						if(!default_checkpass(&$element)){
								venus_ctpl(TDIR.'views/default/forms/password.php');
								return $element->e_passform();
							};
				$pID=$element->eID;
				venus_set('element',$element);
				venus_set('page_title',$element->eTitle);
				venus_set('page_meta_description',$element->eMDescription);
				venus_set('page_meta_keywords',$element->eMKeywords);
					
				//--set template------------------------------------------------------------------------------------
				$template=$element->eFurl.'.php';
				$tplpath=TDIR.'views/default/';
				if(!file_exists($tplpath.$template)){
						if(file_exists($tplpath.$element->eType.'.type.php') and $pID!=0) 
							$template=$element->eType.'.type.php';
						else
							$template = ($pID!=0)?'element.php':'index.php';
					}
            	venus_ctpl($tplpath.$template);
				$pNum=(isset(core::$query[3]) and is_numeric(core::$query[3]))?intval(core::$query[3]):0;
				//$pCount=(isset(core::$query[4]) and is_numeric(core::$query[4]) and core::$query[4]>0)?intval(core::$query[4]):20;
				$element->e_load_childs($pNum);
				venus_set('pCount',$element->e4page);
				venus_set('pNum',$pNum);
				$comments=array();
				if(MODE!='admin' and access('view_comments') and $pID!='0'){
					if(isset(core::$query[3]) and core::$query[3]=='comments'){
						$cpNum=(isset(core::$query[4]) and is_numeric(core::$query[4]))?intval(core::$query[4]):0;
						$cpCount=$element->c4page;//(isset(core::$query[5]) and is_numeric(core::$query[5]))?intval(core::$query[5]):30;
					}else{
						$cpNum=0;
						$cpCount=30;
					}
					$l1=$cpNum*$cpCount;
					$query='SELECT * FROM '.db::table('comments').' WHERE cEID="'.$pID.'" AND cActive=1 ORDER BY cID ASC LIMIT '.$l1.','.$cpCount.';';
					$r=db::query($query);
					while($row=db::fetch_array_assoc($r)){
							$comment=new comment();
							$comment->c_load_array($row);
							$comments[]=$comment;
						}
					$query='SELECT count(*) as count  FROM '.db::table('comments').' WHERE cEID="'.$pID.'" AND cActive=1;';
					$r=db::select_array($query);
					venus_set('cpCount',$cpCount);
					venus_set('cpNum',$cpNum);
					venus_set('comments_count',$r['count']);
					venus_set('comments_list',$comments);
				}

			}
//---------------------------------------------
function module_tag(){
				venus_ctpl(TDIR.'views/default/tag.php');
				init_breadcrumbs();
				if(!isset(core::$query[2])) throw new NotFoundException();
				$tag=htmlspecialchars(mb_convert_case(core::$query[2], MB_CASE_LOWER, ENCODING));
				$query='SELECT tag FROM '.db::table('tags').' WHERE tag =?;';
				$row=db::select_array($query,array($tag));
				if(!$row) throw new NotFoundException();
                venus_set('tag',$row['tag']);
				venus_set('page_title',$row['tag']);
				venus_set('page_meta_description',$row['tag']);
				venus_set('page_meta_keywords',$row['tag']);
				$pNum=$pCount=$eCount=0;$elements=array();
				$pNum=(isset(core::$query[4]) and is_numeric(core::$query[4]))?intval(core::$query[4]):0;
				$pCount=30;//(isset(core::$query[3]) and is_numeric(core::$query[3]))?intval(core::$query[3]):20;
				$l1=$pNum*$pCount;
				$query='SELECT count(*) as cs FROM '.db::table('elements').' t1 WHERE t1.eActive=1 AND t1.eNoindex!=1 AND t1.eTags LIKE ?;';
				$arr=db::select_array($query,array('%'.$tag.'%'));
				$eCount=$arr['cs'];

				if($eCount>0){
						$query='SELECT t1.eID,t1.eType,t1.eFurl FROM '.db::table('elements').' t1 WHERE t1.eActive=1  AND t1.eNoindex!=1  AND t1.eTags LIKE ? ORDER BY t1.eID DESC LIMIT '.$l1.','.$pCount.';';
						$r=db::query($query,array('%'.$tag.'%'));
						while($elrow=db::fetch_array_assoc($r)){
								$e=load_element($elrow['eID'],'*',$elrow['eType']);
								$elements[]=$e;				
							}
					}
				venus_set('pCount',$pCount);
				venus_set('pNum',$pNum);
				venus_set('elements_count',$eCount);
				venus_set('elements_list',$elements);
			}
//---------------------------------------------
function module_search(){
				venus_ctpl(TDIR.'views/default/search.php');
				init_breadcrumbs();
				venus_set('pCount',30);
				venus_set('search','');
				venus_set('pNum',0);
				venus_set('elements_count',0);
				venus_set('results_list',array());
				if(isset($_POST['search_string'])) $str=htmlspecialchars($_POST['search_string']);
				elseif(isset($_GET['search_string'])) $str=htmlspecialchars($_GET['search_string']);
				elseif(isset(core::$query[2])) $str=htmlspecialchars(core::$query[2]);
				else return;
				$str=strip_tags(preg_replace('/([\/]|\s{2}|[\n])/','',$str));
				if(mb_strlen($str)<2 or mb_strlen($str)>100){ return venus_error(lt('incorrect_data'));}
				venus_set('page_title',$str.' - '.lt('searchsite'));
				venus_set('page_meta_description',$str);
				venus_set('page_meta_keywords',$str);
				
				$pNum=$pCount=$eCount=0;$elements=array();
				$pNum=(isset(core::$query[3]) and is_numeric(core::$query[3]))?intval(core::$query[3]):0;
				$pCount=30;//(isset(core::$query[4]) and is_numeric(core::$query[4]))?intval(core::$query[4]):30;
				$l1=$pNum*$pCount;
				$st=mb_convert_case($str, MB_CASE_LOWER, ENCODING);
				$query='SELECT count(*) as count FROM '.db::table('search').' t1,'.db::table('elements').' t3  WHERE  t3.eActive=1 AND t3.eID=t1.eID AND data LIKE ?;';
				$arr=db::select_array($query,array('%'.$st.'%'));
				$eCount=$arr['count'];
				$results=array();
				if($eCount>0){
						$query='SELECT t1.eID,t1.ePID,t1.eUDate,t1.eCDate, t1.eType, t1.eFurl,t1.title,t3.data  FROM '.db::table('elements').' t1, '.db::table('search').' t3  WHERE  t1.eActive=1 AND t1.eID=t3.eID AND t3.data LIKE ?  ORDER BY t1.eID DESC LIMIT '.$l1.','.$pCount.';';
						$results=db::select_array_collection($query,array('%'.$st.'%'));
					}
				venus_set('pCount',$pCount);
				venus_set('search',$str);
				venus_set('pNum',$pNum);
				venus_set('elements_count',$eCount);
				venus_set('results_list',$results);
			}
//---------------------------------------------
function module_comments(){
				if(!access('view_comments')) throw new AccessException();
				venus_ctpl(TDIR.'views/default/comments.php');			
				init_breadcrumbs();
				$element=load_element(core::$query[2]);
				default_load_bcrumbs($element->eID);
				breadcrumbs::add(l((MODE=='admin'?'admin/':'').'default/comments/'.core::$query[2]),lt('crumb_defaultclist'));
            	$pNum=(isset(core::$query[4]) and is_numeric(core::$query[3]))?intval(core::$query[3]):0;
            	$pCount=$element->c4page;//(isset(core::$query[3]) and is_numeric(core::$query[4]))?intval(core::$query[4]):20;
            	$l1=$pNum*$pCount;
            	$query='SELECT t1.*,t2.title as cETitle,t2.eFurl as cEFurl FROM '.db::table('comments').' t1,'.db::table('elements').' t2 WHERE t1.cEID='.$element->eID.' AND t1.cActive=1 AND t1.cEID=t2.eID ORDER BY t1.cID ASC LIMIT '.$l1.','.$pCount.';';
				$r=db::query($query);
				while($row=db::fetch_array_assoc($r)){
						$comment=new comment();
						$comment->c_load_array($row);
						$comments[]=$comment;
					}
				venus_set('element',$element);
				venus_set('pCount',$pCount);
				venus_set('pNum',$pNum);
				venus_set('comments_count',$element->eCCount);
				venus_set('comments_list',$comments);
			}
//---------------------------------------------
function module_mod_elements(){
				if(!access('moderate')) throw new AccessException();
				venus_ctpl(TDIR.'views/default/mod_elements.php');				
				init_breadcrumbs();
				breadcrumbs::add(l((MODE=='admin'?'admin/':'').'default/mod_elements'),lt('crumb_defaultmelist'));
				$pNum=$pCount=$eCount=0;$elements=array();
				$query='SELECT count(*) as cs FROM '.db::table('elements').' WHERE eActive=0;';
				$arr=db::select_array($query);
				$eCount=$arr['cs'];
				$pNum=(isset(core::$query[4]) and is_numeric(core::$query[3]))?intval(core::$query[3]):0;
				$pCount=(isset(core::$query[3]) and is_numeric(core::$query[4]))?intval(core::$query[4]):20;
				$l1=$pNum*$pCount;
				$query='SELECT count(*) as count FROM '.db::table('elements').' WHERE eActive=0;';
				$arr=db::select_array($query);
				$eCount=$arr['count'];
				if($eCount>0){
						$query='SELECT eID,eType FROM '.db::table('elements').' WHERE eActive=0  AND eID>0 ORDER BY eID DESC LIMIT '.$l1.','.$pCount.';';
						$r=db::query($query);
						while($elrow=db::fetch_array_assoc($r)){
								$e=load_element($elrow['eID'],'*',$elrow['eType']);
								$elements[]=$e;				
							}
					}
				venus_set('pCount',$pCount);
				venus_set('pNum',$pNum);
				venus_set('elements_count',$eCount);
				venus_set('elements_list',$elements);
			}
//---------------------------------------------
function module_mod_comments(){
				if(!access('moderate_comments')) throw new AccessException();
				venus_ctpl(TDIR.'views/default/mod_comments.php');
				
				init_breadcrumbs();
				breadcrumbs::add(l((MODE=='admin'?'admin/':'').'default/mod_comments'),lt('crumb_defaultmclist'));	
            	$pNum=(isset(core::$query[3]) and is_numeric(core::$query[3]))?intval(core::$query[3]):0;
            	$pCount=(isset(core::$query[4]) and is_numeric(core::$query[4]))?intval(core::$query[4]):20;
            	$l1=$pNum*$pCount;
            	$query='SELECT t1.*,t2.title as cETitle,t2.eFurl as cEFurl FROM '.db::table('comments').' t1,'.db::table('elements').' t2 WHERE t1.cActive=0 AND t1.cEID=t2.eID ORDER BY t1.cID ASC LIMIT '.$l1.','.$pCount.';';
				$r=db::query($query);
				while($row=db::fetch_array_assoc($r)){
						$comment=new comment();
						$comment->c_load_array($row);
						$comments[]=$comment;
					}
				$query='SELECT count(*) as count FROM '.db::table('comments').' WHERE cActive="0";';
				$arr=db::select_array($query);
				venus_set('pCount',$pCount);
				venus_set('pNum',$pNum);
				venus_set('comments_count',$arr['count']);
				venus_set('comments_list',$comments);
			}
//---------------------------------------------
function module_action(){
				include(MDIR.'include/element.form.php');
				include(MDIR.'include/comment.form.php');
				init_breadcrumbs();
				$act=core::$query[2];
				if(!function_exists('default_action_'.$act) or $act=='action') throw new NotFoundException('Action not found!');
				call_user_func('default_action_'.$act);
			}
function default_action_add(){
				try{
					if(!in_array(core::$query[4],core::$settings['etypes'])) throw new MessageException(lt('incorrect_data'),MT_ERROR);
					if(intval(core::$query[3])!=0){
						if(!$pelement=load_element(core::$query[3],'eID,eType,title,eFurl'))  throw new MessageException(lt('incorrect_data'),MT_ERROR);
						if(count($pelement->subtypes)==0 or !in_array(core::$query[4],$pelement->subtypes))  throw new MessageException(lt('incorrect_data'),MT_ERROR);
						if((!$pelement->access('add') or $pelement->subtypes[1]=='') and $pelement->subtypes[1]==core::$query[4]) throw new AccessException();
						if((!$pelement->access('category') or $pelement->subtypes[0]=='') and $pelement->subtypes[0]==core::$query[4]) throw new AccessException();							
						default_load_bcrumbs($pelement->eID);
					}else
						if(!isAdmin())  throw new AccessException();
					breadcrumbs::add(l((MODE=='admin'?'admin/':'').'default/action/add/'.core::$query[3].'/'.core::$query[4]),lt('crumb_defaultadd'));
					$thfile=file_exists(TDIR.'views/default/forms/el_'.core::$query[4].'.php')?'el_'.core::$query[4]:'element';
					venus_ctpl(TDIR.'views/default/forms/'.$thfile.'.php');
					try{
						$element=create_element(core::$query[4]);
						$element->ePID=$_POST['ePID']=core::$query[3];
						if(isset(core::$query[5]) and core::$query[5]=='create'){
								$element->e_create();
								venus_message(lt('element_created'));
								venus_set('element',$element);
								$thfile=file_exists(TDIR.'views/default/'.$element->eType.'_created.php')?$element->eType.'_created.php':'created.php';
								venus_ctpl(TDIR.'views/default/'.$thfile);
								return;
							}
						$element->e_add();
					}catch(Exception $e){						
						venus_error($e->get_message());
						$element=create_element(core::$query[4]);
						$element->e_add();
					}
				}catch(Exception $e){
					venus_error($e->get_message());
					core::$query=array('default');
					module_index();
				}
			}
function default_action_edit(){
				try{
					if(!$element=load_element(core::$query[3]))  throw new MessageException(lt('incorrect_data'),MT_ERROR);
    				if(!$element->access('edit')) throw new AccessException();
					default_load_bcrumbs($element->eID);
					breadcrumbs::add(l((MODE=='admin'?'admin/':'').'default/action/edit/'.core::$query[3]),lt('crumb_defaultedit'));
					$thfile=file_exists(TDIR.'views/default/forms/el_'.$element->eType.'.php')?'el_'.$element->eType:'element';
					venus_ctpl(TDIR.'views/default/forms/'.$thfile.'.php');
					try{
						if(isset(core::$query[4]) and core::$query[4]=='update'){
								$element->e_update();
								venus_message(lt('element_updated'));
								$element=load_element(core::$query[3]);
							}
					default_load_bcrumbs($element->eID);
					$element->e_edit();
					}catch(Exception $e){
						venus_error($e->get_message());
						$element->e_edit();
					}
				}catch(Exception $e){
					venus_error($e->get_message());
					core::$query=array('default');
					module_index();
				}
			}
function default_action_approve(){
				try{
					if(!$element=load_element(core::$query[3],'eID,eType,eFurl'))  throw new MessageException(lt('incorrect_data'),MT_ERROR);
					if(!access('moderate')) throw new AccessException();
					db::query('UPDATE '.db::table('elements').' SET eActive="1" WHERE eID="'.$element->eID.'";');
					venus_message(lt('element_approved'));
					core::$query=array('default','mod_elements');
					module_mod_elements();
				}catch(Exception $e){
					venus_error($e->get_message());
					core::$query=array('default','mod_elements');
					module_mod_elements();
				}
			}
function default_action_drop(){
				try{
					if(!$element=load_element(core::$query[3],'eID,ePID,eType,eTags,eAID,eFurl'))  throw new MessageException(lt('incorrect_data'),MT_ERROR);
    				if(!$element->access('delete')) throw new AccessException();
					try{
						$element->e_delete();
						venus_message(lt('element_deleted'));
						if($element->ePID==0){
								core::$query=array('default');
								module_index();
								return;
							}
						$element=load_element($element->ePID,'eFurl,eType');
						core::$query=array('default','element',$element->eFurl);
						module_element();

					}catch(Exception $e){
						venus_error($e->get_message());
						if($element->ePID==0){
								core::$query=array('default');
								module_index();
								return;
							}
						$element=load_element($element->ePID,'eFurl,eType');
						core::$query=array('default','element',$element->eFurl);
						module_element();
					}
				}catch(Exception $e){
					venus_error($e->get_message());
					core::$query=array('default');
					module_index();
				}
			}
function default_action_post_comment(){
				venus_ctpl(TDIR.'views/default/forms/comment.php');
				$comment=new comment();
				if(!$element=load_element(core::$query[3],'eID,eFurl,eType'))  throw new MessageException(lt('incorrect_data'),MT_ERROR);
    			if(!$element->access('comment') or !access('post_comments')) throw new AccessException();
				default_load_bcrumbs($element->eID);
				breadcrumbs::add(l((MODE=='admin'?'admin/':'').'default/comments/'.core::$query[3]),lt('crumb_defaultclist'));
				breadcrumbs::add(l((MODE=='admin'?'admin/':'').'default/action/post_comment/'.core::$query[3]),lt('crumb_defaultpc'));	
				try{
						if(isset(core::$query[4]) and core::$query[4]=='create'){
								$comment->c_load_array($_POST);
								$comment->cEID=$element->eID;
								$comment->cAID=core::$user['uID'];
								$comment->cAName=$comment->cAName=core::$user['name'].' '.core::$user['login'].' '.core::$user['sername'];
								$comment->cAEmail=core::$user['email'];
								if(isGuest()){
						    			$comment->cAName=htmlspecialchars($_POST['cAName']);
						    			$comment->cAEmail=htmlspecialchars($_POST['cAEmail']);
									}
								$comment->c_create();
								db::query('UPDATE '.db::table('elements').' SET eCCount=eCCount+1 WHERE eID="'.$element->eID.'";');
								venus_message(lt('comment_created'));
								if(MODE!='admin'){
									core::$query=array('default','element',$element->eFurl);
									module_element();
									return;
								}
								core::$query=array('default','comments',$element->eID);
								module_comments();
								return;
							}
						$comment->c_add();
					}catch(Exception $e){
						venus_error($e->get_message());
						$comment->c_add();
					}

			}
function default_action_edit_comment(){
				venus_ctpl(TDIR.'views/default/forms/comment.php');
				$comment=new comment();
				if(!$comment->c_load_id(core::$query[3]))  throw new MessageException(lt('incorrect_data'),MT_ERROR);
    			if(!access('edit_comments') and (core::$user['uID']!=$comment->cAID or (core::$user['uID']==$comment->cAID and core::$user['gID']==UT_GUEST))) throw new AccessException();
				default_load_bcrumbs($comment->cEID);
				breadcrumbs::add(l((MODE=='admin'?'admin/':'').'default/comments/'.$comment->cEID),lt('crumb_defaultclist'));
				breadcrumbs::add(l((MODE=='admin'?'admin/':'').'default/action/edit_comment/'.core::$query[3]),lt('crumb_defaultec'));
				try{
						if(isset(core::$query[4]) and core::$query[4]=='update'){
								$comment->c_load_array($_POST);
								$comment->cAID=core::$user['uID'];
								$comment->cAName=core::$user['name'].' '.core::$user['login'].' '.core::$user['sername'];
								$comment->cAEmail=core::$user['email'];
								if(isGuest()){
						    			$comment->cAName=htmlspecialchars($_POST['cAName']);
						    			$comment->cAEmail=htmlspecialchars($_POST['cAEmail']);
									}
								$comment->c_update();
								venus_message(lt('comment_updated'));
							}
						$comment->c_load_id(core::$query[3]);
						$comment->c_edit();
					}catch(Exception $e){
						venus_error($e->get_message());
						$comment->c_load_id(core::$query[3]);
						$comment->c_edit();
					}

			}
function default_action_approve_comment(){
					$comment=new comment();
					if(!$comment->c_load_id(core::$query[3],'cID'))  throw new MessageException(lt('incorrect_data'),MT_ERROR);
    				if(!access('moderate_comments')) throw new AccessException();
					try{
						db::query('UPDATE '.db::table('comments').' SET cActive=1 WHERE cID='.$comment->cID.';');
						venus_message(lt('comment_approved'));
						core::$query=array('default','mod_comments');
						module_mod_comments();

					}catch(Exception $e){
						venus_error($e->get_message());
						core::$query=array('default','mod_comments');
						module_mod_comments();
					}
			}
function default_action_drop_comment(){
					$comment=new comment();
					if(!$comment->c_load_id(core::$query[3],'cEID,cID,cAID'))  throw new MessageException(lt('incorrect_data'),MT_ERROR);
    				if(!access('delete_comments')  and core::$user['uID']!=$comment->cAID) throw new AccessException();
					try{
						$comment->c_drop();
						db::query('UPDATE '.db::table('elements').' SET eCCount=eCCount-1 WHERE eID='.$comment->cEID.';');
						venus_message(lt('comment_deleted'));
						$element=load_element($comment->cEID,'eFurl,eType');
						core::$query=array('default','element',$element->eFurl);
						module_element();

					}catch(Exception $e){
						venus_error($e->get_message());
						$element=load_element($comment->cEID,'eFurl,eType');
						core::$query=array('default','element',$element->eFurl);
						module_element();
					}
			}
//setings
function default_action_options(){
				include(MDIR.'include/options.form.php');
				if(!isAdmin()) throw new AccessException();
				breadcrumbs::add(l((MODE=='admin'?'admin/':'').'default/action/options'),lt('crumb_defaultopt'));
				venus_ctpl(TDIR.'views/default/forms/options.php');
				try{
					if(isset(core::$query[3]) and core::$query[3]=='update'){
							$_POST['moderation']=isset($_POST['moderation']);
							$_POST['comments_moderation']=isset($_POST['comments_moderation']);
							$Form=new DefaultModuleOptForm();
							$Form->_edit_form();
							$Form->validate($_POST);
            				if(!$Form->validated) throw new MessageException(lt('incorrect_data'),MT_ERROR);
        					venus_options_update('default','{\"o\":\"'.intval($_POST['moderation']).intval($_POST['comments_moderation']).'\",\"a\":\"'.default_get_access().'\"}');
            				venus_message(lt('options_updated'));
						}
					$form=new DefaultModuleOptForm();
					$form->_edit_form();
				}catch(Exception $e){
					venus_error($e->get_message());
					$form=new DefaultModuleOptForm();
					$form->_edit_form();
				}
			}
//-----------------------------------------------
function default_checkpass($element){
				if(isset($_SESSION['ePassword_'.$element->eID])){
						if($element->ePassword==$_SESSION['ePassword_'.$element->eID])
								return TRUE;
					}
				if(isset($_POST['ePassword'])){
						if($element->ePassword==$_POST['ePassword']){
									$_SESSION['ePassword_'.$element->eID]=$_POST['ePassword'];
									return TRUE;
							}
					}
				return FALSE;
			}
//-----------------------------------------------
//ACCESS METHODS
function default_get_access(){
               $items=array('moderate'=>0,'moderate_comments'=>1,'view_comments'=>2,'post_comments'=>3,'edit_comments'=>4,'delete_comments'=>5);
			   return venus_ac_bydata($_POST,$items);
			}
?>