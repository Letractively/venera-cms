<h2><?php echo  __l('im',lt('im_inmessages')).' | '.__l('im/out',lt('im_outmessages'));?></h2>
<?php 
$userpic1=(file_exists('uploads/avatar_'.$user_from['uID'].'.jpg')?BASEURL.'uploads/avatar_'.$user_from['uID'].'.jpg':THEME.'img/default_avatar_'.$user_from['gender'].'.jpg');
$userpic2=(file_exists('uploads/avatar_'.core::$user['uID'].'.jpg')?BASEURL.'uploads/avatar_'.core::$user['uID'].'.jpg':THEME.'img/default_avatar_'.core::$user['gender'].'.jpg');
echo '<h3>'.lt('im_messagingwith').' '.$user_from['name'].' '.$user_from['login'].' '.$user_from['sername'].'</h3>';
?>
<div id="im_history">
<?php
if(access('im')) echo '<div style="background:#E5e5e5;border-style:solid;border-width:1px;border-color:#AAAAAA;padding:10px;">'.$html_immsg_form->html().'</div>';
if($msg_count==0){
	echo lt('im_nomsg');
}else{
?>
<form action="<?php _l('im/delete');?>" method="post">
<?php
foreach($msg_list as $i=>&$val){
	echo '<div style="background:'.(core::$user['uID']==$val['fromID']?($val['readed']==1?'#EEFEFE':'#EEEEEE'):'#FEFEFE').';padding:20px;margin:10px;"><div style="float:left;width:100px;margin:5px;">'.date('d.m.Y H:i:s',$val['datetime']).'</small></div>
	<u>'.$val['theme'].'</u><br/><small>'.$val['text'].'</small><div style="clear:both;"></div>
	<input type="checkbox" name="mid[]"  value="'.$val['mID'].'">
	</div><div style="clear:both;"></div>';
}
?>
<input type="submit" value="<?php echo lt('delete');?>">

</form>
<hr/>
<?php 
echo venus_nav_links('im/history/'.$user_from['uID'].'/{%page%}',array('pagenow'=>$pNum,'maxpage'=>ceil($msg_count/$pCount)-1));
}
?>
</div>
