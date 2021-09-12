<?php


// TODO: remove when LUMIA-236 is ready.
$listViewDefs['KBContents'] = array(
    'NAME' => array(
        'label' => 'LBL_NAME',
        'default' => true,
        'link' => true,
        'width' => '20',
    ),
    'LANGUAGE' => array(
        'label' => 'LBL_LANG',
        'default' => true,
        'link' => true,
        'type' => 'enum-config',
        'module' => 'KBDocuments',
        'key' => 'languages',
        'width' => '5',
    ),
    'STATUS' => array(
        'label' => 'LBL_STATUS',
        'default' => true,
        'type' => 'status',
        'width' => '10',
    ),
    'ACTIVE_DATE' => array(
        'label' => 'LBL_PUBLISH_DATE',
        'type' => 'date',
        'default' => true,
        'width' => '10',
    ),
    'EXP_DATE' => array(
        'label' => 'LBL_EXP_DATE',
        'type' => 'date',
        'default' => true,
        'width' => '10',
    ),
    'DATE_ENTERED' => array(
        'width' => '5',
        'label' => 'LBL_DATE_ENTERED',
        'default' => true,
    ),
);
