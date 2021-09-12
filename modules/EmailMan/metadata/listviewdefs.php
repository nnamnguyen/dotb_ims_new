<?php



$listViewDefs['EmailMan'] = array(
    'CAMPAIGN_NAME' => array(
        'width' => '10', 
        'label' => 'LBL_LIST_CAMPAIGN', 
        'link' => true,
		'customCode' => '<a href="index.php?module=Campaigns&action=DetailView&record={$CAMPAIGN_ID}">{$CAMPAIGN_NAME}</a>',
        'default' => true),
    'RECIPIENT_NAME' => array(
		'sortable' => false,
        'width' => '10', 
        'label' => 'LBL_LIST_RECIPIENT_NAME',
		'customCode' => '<a href="index.php?module={$RELATED_TYPE}&action=DetailView&record={$RELATED_ID}">{$RECIPIENT_NAME}</a>', 
        'default' => true),
    'RECIPIENT_EMAIL' => array(
		'sortable' => false,
        'width' => '10', 
        'label' => 'LBL_LIST_RECIPIENT_EMAIL',
		'customCode' => '{$EMAIL_LINK}{$RECIPIENT_EMAIL}</a>',
        'default' => true),
    'MESSAGE_NAME' => array(
		'sortable' => false,
        'width' => '10', 
        'label' => 'LBL_LIST_MESSAGE_NAME',
		'customCode' => '<a href="index.php?module=EmailMarketing&action=DetailView&record={$MARKETING_ID}">{$MESSAGE_NAME}</a>',
        'default' => true),
    'SEND_DATE_TIME' => array(
        'width' => '10', 
        'label' => 'LBL_LIST_SEND_DATE_TIME', 
        'default' => true),
    'SEND_ATTEMPTS' => array(
        'width' => '10', 
        'label' => 'LBL_LIST_SEND_ATTEMPTS', 
        'default' => true),
    'IN_QUEUE' => array(
        'width' => '10', 
        'label' => 'LBL_LIST_IN_QUEUE', 
        'default' => true),
);
