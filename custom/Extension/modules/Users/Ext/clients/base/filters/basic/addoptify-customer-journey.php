<?php

$viewdefs['Users']['base']['filter']['basic']['filters'][] = array (
    'id' => 'missing_customer_journey_access',
    'name' => 'LBL_FILTER_MISSING_CUSTOMER_JOURNEY_ACCESS',
    'filter_definition' => array (
        '$and' => array (
            array (
                '$or' => array (
                    array ('customer_journey_access' => 0),
                    array ('customer_journey_access' => array ('$is_null' => 1)),
                ),
            ),
            array (
                '$or' => array (
                    array ('is_group' => 0),
                    array ('is_group' => array ('$is_null' => 1)),
                ),
            ),
            array (
                '$or' => array (
                    array ('portal_only' => 0),
                    array ('portal_only' => array ('$is_null' => 1)),
                ),
            ),
        ),
        'status' => 'Active',
    ),
    'editable' => false,
    'is_template' => true,
);
