<div class="ui-widget-content"  style="width:320px;float:left;padding:10px;margin:10px;">
<img src="<?php echo THEME.'/img/whoonline.png';?>" style="float:left;"/>
<p>Now online <strong><?php echo count($online);?></strong> users:
<?php
$rc=$gc=0;
foreach($online as $i=>&$user){
	if($user['gID']==UT_GUEST){
		echo 'Guest('.long2ip($user['ip']).')';
		$gc++;
	}else{
		$rc++;
		echo $user['name'];
	}
	echo ($i+1==count($online)?'':', ');
}
?>
<br/>
Registered:<?php echo $rc?>, Guests:<?php echo $gc;?><div style="clear:both;"></div>
</div>
