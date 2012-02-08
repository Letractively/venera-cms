<style type="text/css">
#upload_form{
border-style:solid;
border-width:1px;
border-color:#AAA;
background:#FFF;
display:none;
padding:10px;
}
#upload_form_files{
}
</style>
<script type="text/javascript">
function show_upload_form(){
	if(document.getElementById('upload_form').style.display!='block')
		document.getElementById('upload_form').style.display='block';
	else
		document.getElementById('upload_form').style.display='none'
}
function upload_form_addfield(){
	document.getElementById('upload_form_files').innerHTML+='<input type="file" name="f[]"/><br/>';
}
</script>
<h2><?php echo venus_get('path');?></h2>
<hr/>
<table><tr><td>name</td><td>size</td><td></td></tr>
<?php
foreach(venus_get('files') as $i=>$file){
echo '<tr><td>';
echo ($file['type']=='dir')?__l('admin/files/dir/'.$file['path'],$file['name']):$file['name'];
echo '</td><td>';
echo $file['size'];
echo '</td><td>';
echo ($file['type']!='dir')?'['.__l('admin/files/edit/'.$file['path'],lt('edit')).']':'';
echo ($file['type']!='dir')?'['.__l('admin/files/drop/'.$file['path'],lt('delete')).']':'';
echo '</td></tr>';
}

?>
</table>
<h2>Options:</h2>
<a href="javascript:show_upload_form();">[upload files here]</a>
<div id="upload_form">
<a href="javascript:upload_form_addfield();">[add field]</a>
<form action="<?php echo l('admin/files/upload/'.urlencode(venus_get('path')));?>" method="post" enctype="multipart/form-data">
<div id="upload_form_files"><input type="file" name="f[]"/><br/>
</div>
<br/><input type="submit" value="upload"/>
</form>
</div>