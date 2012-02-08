<?php
	class tpage extends stdel{
		public $eType='page';
		public $table='content_pages';
		public $subtypes=array();
		public $search_fields=array('text');
		public function __construct(){
			$this->fields=array(
	 			'text'=>array(
						'caption'=>lt('tpage_text'),
						'name'=>'text',
						'type'=>HTML_TEXTAREA_FIELD_TYPE,
						'validation'=>HTML_TYPE,
						'filters'=>'size',
						'minsize'=>1,
						'maxsize'=>25000,
						'help'=>lt('tpage_textd'),
	 					'options'=>array(
	 						'cols'=>70,
	 						'rows'=>15
	 					)
	 				),
	 			);
			}
		
	}

?>