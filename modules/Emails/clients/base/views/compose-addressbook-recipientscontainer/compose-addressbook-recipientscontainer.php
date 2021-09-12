<?php



$viewdefs['Emails']['base']['view']['compose-addressbook-recipientscontainer'] = array(
    'template' => 'record',
    'panels' => array(
        array(
            'name' => 'selected_recipients',
            'columns' => 1,
            'labels' => true,
            'labelsOnTop' => true,
            'placeholders' => true,
            'fields' => array(
                array(
                    'name' => 'to_collection',
                    'type' => 'email-recipients',
                    'label' => 'LBL_SELECTED_RECIPIENTS',
                    'readonly' => true,
                    'span' => 12,
                ),
            ),
        ),
    ),
);

