<?php


$popupMeta = array(
    'moduleMain' => 'Shipper',
    'varName' => 'SHIPPER',
    'className' => 'Shipper',
    'orderBy' => 'shippers.name',
    'whereClauses' =>
        array('name' => 'shippers.name'),
    'listviewdefs' => array(
        'NAME' => array(
            'width' => '50',
            'label' => 'LBL_NAME',
            'link' => true,
            'default' => true),
        'STATUS' => array(
            'width' => '50',
            'label' => 'LBL_STATUS',
            'default' => true),
    ),
    'searchdefs'   => array(
        'name'
    )
);
?>
