<h2><?php echo lt('im_inmessages').' | '.__l('im/out',lt('im_outmessages'));?></h2>
<?php 
if($msg_count==0){ echo lt('im_nomsg');return;}
?>
<form action="<?php _l('im/delete');?>" method="post">
<?php
foreach($msg_list as $i=>&$val){
	$userpic=(file_exists('uploads/avatar_'.$val['uID'].'.jpg')?BASEURL.'uploads/avatar_'.$val['uID'].'.jpg':THEME.'img/default_avatar_'.$val['gender'].'.jpg');
	echo '<div><div style="float:left;width:200px;margin-right:5px;"><div style="float:left;overflow:hidden;width:50px;margin:5px;"><img width="50px" src="'.$userpic.'"/></div>
	<small>'.lt('im_from').': '.$val['name'].' '.$val['login'].' '.$val['sername'].'<br/>'.date('d.m.Y H:i:s',$val['datetime']).'</small>
	</div>
	<u>'.$val['theme'].'</u><br/><small>'.substr($val['text'],0,200).'</small><div style="clear:both;"></div>
	<a href="'.l('im/history/'.$val['fromID']).'">['.lt('im_view').'/'.lt('im_reply').']</a><br/>
	'.($val['readed']==1?lt('im_statread'):lt('im_notstatread')).'
	<br/><input type="checkbox" name="mid[]"  value="'.$val['mID'].'"></div><div class="hline"></div>';
}
?>
<input type="submit" value="<?php echo lt('delete');?>">
</form>
<br/>
<?php echo venus_nav_links('im/index/{%page%}',array('pagenow'=>$pNum,'maxpage'=>ceil($msg_count/$pCount)-1));?>