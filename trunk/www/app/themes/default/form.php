<? $form_id=CFormID::get();?>
<div class="form">
<form name="<?=$this->name;?>"action="<?=$this->action;?>" enctype="<?=$this->enctype;?>" target="<?=$this->target;?>" method="<?=$this->method;?>">
<div id="form_tabs_<?=$form_id;?>">
<ul>
<? $index=1; foreach($this->tabs as $name=>$fields):?>
		<li><a href="#form_tabs_<?=$form_id;?>-<?=$index;?>"><?=lt($name);?></a></li>
<? $index++; endforeach;?>
</ul>
<? $index=1;foreach($this->tabs as $name=>$fields): ?>
<div id="form_tabs_<?=$form_id;?>-<?=$index;?>">
<? foreach($fields as $k=>$i): $field=$this->fields[$i];?>
<fieldset>
<legend class="form_field_legend">
<?=$field->caption.($field->minsize!=0?'*':'');?>
</legend>
<div class="form_field_help"><?=$field->help;?></div>
<div class="form_field_data"><?=$field->get_html();?></div>
</fieldset>
<? endforeach; ?>
</div>
<? $index++;endforeach;?>
</div>
<?=$this->get_hidden();?>
<input type="submit">
<input type="reset">
</form>
<?if($this->autoframe): ?><iframe style="display:none;" name="<?=$this->target;?>"></iframe><? endif; ?>
<div style="clear:both;"></div>
</div>
<div style="clear:both;"></div>
<script type="text/javascript">
	$(function() {
		$("#form_tabs_<?=$form_id;?>").tabs();
	});
</script>