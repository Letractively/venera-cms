<?php
function init_module(){
			if(!isAdmin() or MODE!='admin') throw new AccessException();
			breadcrumbs::$items=array(array('url'=>l('admin'),'title'=>lt('crumb_admin')),array('url'=>l('admin/files'),'title'=>lt('crumb_files')));
			chdir('.');
			$ldir=str_replace('\\','/',getcwd());
			venus_set('path',$ldir);
			venus_set('lpath',$ldir);
		}
function module_index(){
			module_dir();
		}
function module_dir(){
			venus_ctpl(TDIR.'views/files/dir.php');
 			files_load_dir_path();
			$dir=venus_get('path');
 			if(!is_dir($dir)) throw new MessageException('is not directory');
 			$d = dir($dir);
 			$files=array();
 			while($name=$d->read()){
 				$path=str_replace('\\','/',getcwd()).'/'.$name;
 				$fname=urlencode($name);
 				$fname=(strlen($fname)>30)?substr($fname,0,26).'...':$fname;
    			$file=array(
    				'name'=>$fname,
    				'type'=>filetype($name),
    				'size'=>filesize($name),
    				'path'=>urlencode($path),
     				'adate'=>date('d.m.Y H:i:s',fileatime($name)),
    				'cdate'=>date('d.m.Y H:i:s',filectime($name)),
    				'mdate'=>date('d.m.Y H:i:s',filemtime($name)),
    			);
    			$files[count($files)]=$file;
    		}
    		files_back_dir();
    		venus_set('files',$files);

		}
function module_upload(){
			venus_ctpl(TDIR.'views/files/upload.php');
			$path=urldecode(implode('/',array_slice(core::$query,2)));
			$notuploaded=$uploaded=array();
			foreach($_FILES['f']['name'] as $i=>$name){
					if($_FILES['f']['error'][$i]!=0) venus_error('can`t upload file #'.$i);
					if(!move_uploaded_file($_FILES['f']['tmp_name'][$i],$path.'/'.$_FILES['f']['name'][$i])){
						venus_error('can`t move file '.$_FILES['f']['name'][$i]);
						$notuploaded[count($notuploaded)]=$_FILES['f']['name'][$i];
					}else{
						$uploaded[count($uploaded)]=$_FILES['f']['name'][$i];
					}
				}
			venus_message('files was uploaded');
			venus_set('uploaded',$uploaded);
			venus_set('unotploaded',$notuploaded);
		}
function module_edit(){
			$file=urldecode(implode('/',array_slice(core::$query,2)));
			if(!file_exists($file)) throw new NotFoundException();
			if(isset($_POST['save'])){
					if(get_magic_quotes_gpc())$_POST["content"]=stripslashes($_POST["content"]);
			    	if(!file_put_contents($file,$_POST['content']))  venus_error('can`t save file '.$file);else venus_message('file was saved');
				}
			venus_ctpl(TDIR.'views/files/edit.php');
			venus_set('file',$file);
			venus_set('path',pathinfo($file,PATHINFO_DIRNAME));
			venus_set('content',file_get_contents($file));
		}
function module_drop(){
			venus_ctpl(TDIR.'views/files/drop.php');
			$file=urldecode(implode('/',array_slice(core::$query,2)));
   			venus_set('path',pathinfo($file,PATHINFO_DIRNAME));
			if(!unlink($file)) venus_error('can`t delete file '.$file);else venus_message('file was deleted');

		}
function files_back_dir(){
			chdir(venus_get('lpath'));
		}
function files_load_dir_path(){
			if(!isset(core::$query[2])) return;
			$newdir=urldecode(implode('/',array_slice(core::$query,2)));
   			chdir($newdir);
   			chdir(getcwd());
   			$dir=str_replace('\\','/',getcwd());
   			venus_set('path',$dir);
		}
?>