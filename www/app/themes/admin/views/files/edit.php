<h2><?php echo venus_get('file');?></h2>
<form action="<?php echo l('admin/files/edit/'.urlencode(venus_get('file')));?>" method="post">
<input type="hidden" name="save" value="1"/>
<textarea name="content" style="width:100%;height:500px;"><?php echo venus_get('content');?></textarea>  <br/>
<input type="submit" value="save"/>
</form>
<?php echo __l('admin/files/dir/'.urlencode(venus_get('path')),'back to '.venus_get('path'));?>