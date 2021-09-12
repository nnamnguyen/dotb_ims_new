<?php

$viewdefs['Products']['DetailView'] = array(
'templateMeta' => array('maxColumns' => '2',
                        'form' => array('buttons'=>array('EDIT',
                            'DUPLICATE',
                            'DELETE',
                            'AUDIT',
                        )),
                        'widths' => array(
                                        array('label' => '10', 'field' => '30'), 
                                        array('label' => '10', 'field' => '30')
                                        ),
                        ),
'panels' =>array (
  'default' =>array(
  array (
    'name',
    'status',
  ),
  
  array (
    'quote_name',
    'contact_name',
  ),
  
  array (
    'account_name',
  ),
  
  array (
    'quantity',
    'date_purchased',
  ),
  
  array (
    'serial_number',
    'date_support_starts',
  ),
  
  array (
    'asset_number',
    'date_support_expires',
  ),

  ),
array(
    
  array (
    'currency_id',
  ),
  
  array (    
    array (
      'name' => 'cost_price',
      'label' => '{$MOD.LBL_COST_PRICE|strip_semicolon} ({$CURRENCY})',
    ),
    ''
  ),
  
  array (
    
    array (
      'name' => 'list_price',
      'label' => '{$MOD.LBL_LIST_PRICE|strip_semicolon} ({$CURRENCY})',
    ),
    
    array (
      'name' => 'book_value',
      'label' => '{$MOD.LBL_BOOK_VALUE|strip_semicolon} ({$CURRENCY})',
    ),
  ),
  
  array (
    
    array (
      'name' => 'discount_price',
      'label' => '{$MOD.LBL_DISCOUNT_PRICE|strip_semicolon} ({$CURRENCY})',
    ),
    'book_value_date',
  ),
  
  array (    
    array (
      'name' => 'discount_amount',
      'customCode' => '{if $fields.discount_select.value}{dotb_number_format var=$fields.discount_amount.value}%{else}{$fields.currency_symbol.value}{dotb_number_format var=$fields.discount_amount.value}{/if}',
    ),
    ''
  ),
),
array(
  array (
    array('name'=>'website', 'type'=>'link'),
    'tax_class',
  ),
  
  array (
    'manufacturer_name',
    'weight',
  ),
  
  array (
    'mft_part_num',
     array('name'=>'category_name', 'type'=>'text'),
  ),
  
  array (
    'vendor_part_num',
  	'type_name',
  ),
  
  array (
    'description',
  ),
      
  array (
    'support_name',
    'support_contact',
  ),
  
  array (
    'support_description',
    'support_term',
  ),
),
),


   
);
?>
