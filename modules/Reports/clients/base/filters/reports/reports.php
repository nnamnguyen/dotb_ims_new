<?php


$viewdefs['Reports']['base']['filter']['reports'] = array(
    'filters' => array(
        array(
            'id' => 'by_module',
            'name' => 'LBL_FILTER_BY_MODULE',
            'filter_definition' => array(
                array(
                    'module' => array(
                        '$in' => array(),
                    ),
                ),
            ),
            'editable' => true,
            'is_template' => true,
        ),
        array(
            'id' => 'with_charts',
            'name' => 'LBL_FILTER_WITH_CHARTS',
            'filter_definition' => array(
                array(
                    'chart_type' => array(
                        '$not_equals' => 'none',
                    ),
                ),
            ),
            'editable' => false,
            'is_template' => true,
        ),
    ),
);
