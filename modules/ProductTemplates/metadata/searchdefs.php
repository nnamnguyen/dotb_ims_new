<?php


$searchdefs['ProductTemplates'] = array(
			'templateMeta' => array(
					'maxColumns' => '3', 
                    'maxColumnsBasic' => '4', 
                    'widths' => array('label' => '10', 'field' => '30'),                 
                   ),
            'layout' => array(  					
				'basic_search' => array(
				 	'name',					
				),
				'advanced_search' => array(
					'name',
					'tax_class',
					array('name'=>'type_id', 'label'=>'LBL_TYPE', 'type'=>'multienum', 'function' => array('name'=>'getProductTypes', 'returns'=>'html', 'include'=>'modules/ProductTemplates/ProductTemplate.php', 'preserveFunctionValue'=>true)),
					array('name'=>'manufacturer_id', 'label'=>'LBL_MANUFACTURER', 'type'=>'multienum', 'function' => array('name'=>'getManufacturers', 'returns'=>'html', 'include'=>'modules/ProductTemplates/ProductTemplate.php', 'preserveFunctionValue'=>true)),
					'mft_part_num',
					array('name' => 'discount_price_date', 'label'=>'LBL_DISCOUNT_PRICE_DATE'),
					'vendor_part_num',
					array('name'=>'category_id', 'label'=>'LBL_CATEGORY', 'type'=>'multienum', 'function' => array('name'=>'getCategories', 'returns'=>'html', 'include'=>'modules/ProductTemplates/ProductTemplate.php', 'preserveFunctionValue'=>true)),
					array('name' => 'contact_name', 'label' => 'LBL_CONTACT_NAME'),
					'date_available',
					array('name' => 'url', 'label' => 'LBL_URL'),
					'support_term',
				),												
			),
);
?>
