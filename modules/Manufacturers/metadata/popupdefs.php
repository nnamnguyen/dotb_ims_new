<?php


$popupMeta = array(
    'moduleMain' => 'Manufacturer',
    'varName' => 'MANUFACTURER',
    'className' => 'Manufacturer',
    'orderBy' => 'manufacturers.name',
    'whereClauses' =>
        array('name' => 'manufacturers.name'),
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