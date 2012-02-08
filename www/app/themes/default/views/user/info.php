<?
$avatar=file_exists('uploads/avatar_'.$user_data['uID'].'.jpg')?BASEURL.'uploads/avatar_'.$user_data['uID'].'.jpg':THEME.'img/default_avatar_'.$user_data['gender'].'.jpg';
$gender=($user_data['gender']==1)?lt('gender_male'):lt('gender_female');
?>
<table cellpadding="5px">
<tr><td colspan="2"><h2><?=$user_data['name'].' '.$user_data['login'].' '.$user_data['sername'];?></h2></td></tr>
<tr><td valign="top">
<img src="<?=$avatar;?>" width="200px"/>
<br/>
<? if(!isGuest() and $user_data['uID']==core::$user['uID']): ?>
<ul style="margin:10;padding:10px;">
<li><a href="<?=l('user/action/profile');?>"><?=lt('edit');?></a></li>
<li><a href="<?=l('im');?>"><?=lt('im_inmessages');?></a></li>
</ul>
<? elseif(!isGuest()): ?>
<ul style="margin:10;padding:10px;">
<li><a href="<?=l('im/history/'.$user_data['uID']);?>"><?=lt('im_newmsg');?></a></li>
</ul>
<? endif; ?>
</td>
<td  valign="top">
<font color="#555555"><?=lt('birthdate');?>:</font> <?=$user_data['birthday'];?>/<?=$user_data['birthmonth'];?>/<?=$user_data['birthyear'];?><br/>
<font color="#555555"><?=lt('gender');?>:</font> <?=$gender;?><br/>
<font color="#555555"><?=lt('city');?>:</font> <?=($user_data['city']!='0'?$user_data['city']:'...');?><br/>
<font color="#555555"><?=lt('about');?>:</font> <?=($user_data['about']==''?'...':$user_data['about']);?>
</td></tr>
</table>