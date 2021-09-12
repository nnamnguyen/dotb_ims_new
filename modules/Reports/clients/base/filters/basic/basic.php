<?php


    $viewdefs['Reports']['base']['filter']['basic'] = array(
        'create' => true,
        'quicksearch_field' => array('name'),
        'quicksearch_priority' => 1,
        'quicksearch_split_terms' => false,
        'filters' => array(
            array(
                'id' => 'all_records',
                'name' => 'LBL_LISTVIEW_FILTER_ALL',
                'filter_definition' => array(),
                'editable' => false,
            ),
            array(
                'id' => 'accounting_report',
                'name' => '1. Accounting Report',
                'filter_definition' => array(
                    array('list_of' => array('$contains' => array('Accounting'))),
                ),
                'order' => 1,
                'is_template' => true,
            ),
            array(
                'id' => 'academic_report',
                'name' => '2. Academic Report',
                'filter_definition' => array(
                    array('list_of' => array('$contains' => array('Academic'))),
                ),
                'order' => 2,
                'is_template' => true,
            ),
            array(
                'id' => 'scheduler_report',
                'name' => '3. Scheduler Report',
                'filter_definition' => array(
                    array('list_of' => array('$contains' => array('Scheduler'))),
                ),
                'order' => 3,
                'is_template' => true,
            ),
            array(
                'id' => 'marketing_report',
                'name' => '4. Marketing Report',
                'filter_definition' => array(
                    array('list_of' => array('$contains' => array('Marketing'))),
                ),
                'order' => 4,
                'is_template' => true,
            ),
            array(
                'id' => 'operation_report',
                'name' => '5. Sales Report',
                'filter_definition' => array(
                    array('list_of' => array('$contains' => array('Operation'))),
                ),
                'order' => 5,
                'is_template' => true,
            ),
            array(
                'id' => 'bod_report',
                'name' => '6. BOD Report',
                'filter_definition' => array(
                    array('list_of' => array('$contains' => array('BOD'))),
                ),
                'order' => 6,
                'is_template' => true,
            ),
            array(
                'id' => 'favorites',
                'name' => 'LBL_FAVORITES',
                'filter_definition' => array(
                    '$favorite' => '',
                ),
                'editable' => false,
            ),
            array(
                'id' => 'recently_viewed',
                'name' => 'LBL_RECENTLY_VIEWED',
                'filter_definition' => array(
                    '$tracker' => '-7 DAY',
                ),
                'editable' => false,
            ),
            array(
                'id' => 'recently_created',
                'name' => 'LBL_NEW_RECORDS',
                'filter_definition' => array(
                    'date_entered' => array(
                        '$dateRange' => 'last_7_days',
                    ),
                ),
                'editable' => false,
            ),

        ),
    );
