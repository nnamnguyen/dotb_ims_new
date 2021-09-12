<?php


$viewdefs['Reports']['base']['filter']['operators'] = array(
    // all of our enum fields are required so we don't want $empty and $not_empty
    'enum' => array(
        '$in' => 'LBL_OPERATOR_CONTAINS',
        '$not_in' => 'LBL_OPERATOR_NOT_CONTAINS',
    ),
);
