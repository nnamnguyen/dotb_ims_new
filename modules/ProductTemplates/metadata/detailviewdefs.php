<?php

$viewdefs['ProductTemplates']['DetailView'] = array(
'templateMeta' => array('maxColumns' => '2', 
                        'widths' => array(
                                        array('label' => '10', 'field' => '30'), 
                                        array('label' => '10', 'field' => '30')
                                        ),
                        ),
'panels' =>array (
  
  array (
    'name',
    'status',
  ),
  
  array (
    
    array (
      'name' => 'website',
      'label' => 'LBL_URL',
      'type' => 'link',
    ),
    'date_available',
  ),
  
  array (
    'tax_class',
    
    array (
      'name' => 'qty_in_stock',
      'label' => 'LBL_QUANTITY',
    ),
  ),
  
  array (
    'manufacturer_id',
    'weight',
  ),
  
  array (
    'mft_part_num',
    
    array (
      'name' => 'category_name',
      'type' => 'varchar',
      'label' => 'LBL_CATEGORY',
    ),
  ),
  
  array (
    'vendor_part_num',
    
    array (
      'name' => 'type_id',
      'type' => 'varchar',
      'label' => 'LBL_TYPE',
    ),
  ),
  
  array (
    'currency_id',
    'support_name',
  ),
  
  array (
    
    array (
      'name' => 'cost_price',
      'label' => '{$MOD.LBL_COST_PRICE|strip_semicolon} ({$CURRENCY})',
    ),
    'support_contact',
  ),
  
  array (
    
    array (
      'name' => 'list_price',
      'label' => '{$MOD.LBL_LIST_PRICE|strip_semicolon} ({$CURRENCY})',
    ),
    'support_description',
  ),
  
  array (
    
    array (
      'name' => 'discount_price',
      'label' => '{$MOD.LBL_DISCOUNT_PRICE|strip_semicolon} ({$CURRENCY})',
    ),
    'support_term',
  ),
  
  array (
    'pricing_formula',
  ),
  
  array (
    array('name'=>'description', 'displayParams'=>array('nl2br'=>true)),
  ),
)


   
);
?>
