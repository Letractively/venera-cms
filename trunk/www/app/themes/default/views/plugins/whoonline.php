<div>
<div style="padding:0px;margin:0px;">
<p>Now online <strong><?php echo count($online);?></strong> users:
<?php
$rc=$gc=0;
foreach($online as $i=>&$user){
	if(isGuest()){
		echo 'Guest('.long2ip($user['ip']).')';
		$gc++;
	}else{
		$rc++;
		echo $user['name'];
	}
	echo ($i+1==count($online)?'':', ');
}
?>
<div style="clear:both;"></div>
</div>
Registered:<?php echo $rc?>, Guests:<?php echo $gc;?>
</div>
