<?php


$viewdefs['Accounts']['base']['filter']['basic']['filters'] = array(
    array(
        'id' => 'all_records',
        'name' => 'LBL_LISTVIEW_FILTER_ALL',
        'filter_definition' => array(),
        'editable' => false,
        'order' => 1,
    ),
//    array(
//        'id' => 'last_call_status_0',
//        'name' => 'LBL_LAST_CALL_STATUS_0',
//        'filter_definition' => array(
//            'last_call_status' => array(
//                '$in' => array('', null),
//            ),
//        ),
//        'editable' => false,
//        'order' => 2,
//    ),
//    array(
//        'id' => 'last_call_status_1',
//        'name' => 'LBL_LAST_CALL_STATUS_1',
//        'filter_definition' => array(
//            'last_call_status' => array(
//                '$in' => array('Held'),
//            ),
//        ),
//        'editable' => false,
//        'order' => 3,
//    ),
//    array(
//        'id' => 'last_call_status_2',
//        'name' => 'LBL_LAST_CALL_STATUS_2',
//        'filter_definition' => array(
//            'last_call_status' => array(
//                '$in' => array('Planned'),
//            ),
//        ),
//        'editable' => false,
//        'order' => 4,
//    ),
    array(
        'id' => 'favorites',
        'name' => 'LBL_FAVORITES',
        'filter_definition' => array(
            '$favorite' => '',
        ),
        'editable' => false,
        'order' => 5,
    )
);
