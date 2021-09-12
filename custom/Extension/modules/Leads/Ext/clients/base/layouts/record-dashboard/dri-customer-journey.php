<?php

$newRows = array ();
$oldRows = isset($viewdefs['Leads']['base']['layout']['record-dashboard']['metadata']['components'][0]['rows'])
    ? $viewdefs['Leads']['base']['layout']['record-dashboard']['metadata']['components'][0]['rows']
    : array ();

$panel = array (
    array (
        'view' => array (
            'label' => 'LBL_DEFAULT_DRI_CUSTOMER_JOURNEY_DASHLET_TITLE',
            'type' => 'dri-customer-journey-dashlet',
        ),
        'width' => 12,
    ),
);

$newRows[] = $panel;

$newRows = array_merge($newRows, $oldRows);

$viewdefs['Leads']['base']['layout']['record-dashboard']['metadata']['components'][0]['rows'] = $newRows;
