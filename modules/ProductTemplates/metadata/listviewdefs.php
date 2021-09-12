<?php

$listViewDefs['ProductTemplates'] = array(
    'NAME' => array(
		'width' => '30', 
		'label' => 'LBL_LIST_NAME', 
		'link' => true,
        'default' => true),
 	'TYPE_NAME' => array (
        'width' => '10',
		'label' =>'LBL_LIST_TYPE',
        'link' => false,
        'sortable' => true,
        'default' => true),
	'CATEGORY_NAME' => array (
        'width' => '10',
		'label' =>'LBL_LIST_CATEGORY',
        'link' => false,
        'sortable' => true,
        'default' => true),
	'STATUS' => array (
        'width' => '10',
		'label' =>'LBL_LIST_STATUS',
        'link' => false,
        'default' => true),
    'QTY_IN_STOCK' => array (
        'width' => '10',
		'label' =>'LBL_LIST_QTY_IN_STOCK',
        'link' => false,
        'default' => true),
    'COST_USDOLLAR'  => array (
        'width' => '10',
		'label' =>'LBL_LIST_COST_PRICE',
        'link' => false,
        'default' => true,
        'align' => 'right',
        'related_fields' => array('currency_id'),
        'currency_format' => true),
    'LIST_USDOLLAR' => array (
        'width' => '10',
		'label' =>'LBL_LIST_LIST_PRICE',
        'link' => false,
        'default' => true,
        'align' => 'right',
        'related_fields' => array('currency_id'),
        'currency_format' => true),
    'DISCOUNT_USDOLLAR' => array (
        'width' => '10',
		'label' =>'LBL_LIST_DISCOUNT_PRICE',
        'link' => false,
        'default' => true,
        'align' => 'right',
        'related_fields' => array('currency_id'),
        'currency_format' => true),	    
        
);
?>
