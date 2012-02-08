<div class="element_list_item">
<?php echo __l('default/element/'.$element->eFurl,$element->title,'_blank');?><br/>
<?php echo $element->eData['description'];?><br/>
<?php echo lt('created').':'.date('d/m/Y H:i:s',$element->eCDate);?>
<?php
if($element->eCDate!=$element->eUDate){		echo ' '.lt('updated').':'.date('d/m/y h:i:s',$element->eUDate);
	}
?>
</div>