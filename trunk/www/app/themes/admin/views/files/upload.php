<?php
if(count(venus_get('uploaded'))>0){
?>
<h2>This files was uploaded:</h2>
<?php
	foreach(venus_get('uploaded') as $i=>$name) echo $name.'<br/>';
}
?>
<?php
if(count(venus_get('notuploaded'))>0){
?>
<h2>This files was not uploaded:</h2>
<?php
	foreach(venus_get('notuploaded') as $i=>$name) echo $name.'<br/>';
}
?><br/>
<?php echo __l('admin/files/dir/'.urlencode(venus_get('path')),'back to '.venus_get('path'));?>