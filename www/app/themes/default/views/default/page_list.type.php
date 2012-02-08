<div class="element_list_item">
<?=__l('default/element/'.$element->eFurl,$element->title,'_blank');?><br/>
<?=mb_substr(strip_tags($element->eData['text']),0,255,core::$settings['interface']['encoding']);?><br/>
<?=lt('created').':'.date('d/m/Y H:i:s',$element->eCDate);?>
<?php
if($element->eCDate!=$element->eUDate){		echo ' '.lt('updated').':'.date('d/m/y h:i:s',$element->eUDate);
	}
?>
</div>