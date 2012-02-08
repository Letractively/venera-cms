<div>
<h2><?=lt('searchsite');?></h2>
<form action="<?php _l('default/search');?>" method="post"><input type="text" name="search_string" style="width:350px;font-size:18px;" value="<?=$search;?>"/><input type="submit" value="<?=lt('find');?>"/></form>
<br/>
<?php
if($elements_count>0){
	echo '<p>'.lt('byyoursearchquery').' &laquo;'.$search.'&raquo; '.lt('found').' '.$elements_count.'</p>';
	if(count($results_list)>0)
		foreach($results_list as $i=>&$result){
			$p=mb_strpos($result['data'],venus_get('search'));
			$text=str_replace(venus_get('search'),'<b>'.$search.'</b>',mb_substr($result['data'],($p-32>0)?$p-32:0,$p+mb_strlen($search)+32,core::$settings['interface']['encoding']));
			echo __l('default/element/'.$result['eFurl'],$result['title'],'_blank');
				
			echo '<br/><small style="color:silver;">'.$text.'</small>';
			echo '<br/><small>'.lt('updated').': '.date('d.m.Y h:i',$result['eUDate']).'</small>';
			echo '<br/><br/>';
		}
	}else{
if($search=='')
	echo '<p>'.lt('insertsearchquery').'</p>';
else
	echo '<p>'.lt('byyoursearchquery').' &laquo;'.$search.'&raquo; '.lt('nobodynotfound').'</p>';
}

echo venus_nav_links('default/search/'.$search.'/{%page%}',array('pagenow'=>$pNum,'maxpage'=>ceil($elements_count/$pCount)-1));
?>
</div>