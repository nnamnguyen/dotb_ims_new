<?php


$viewdefs['ReportSchedules']['base']['filter']['reportschedules'] = array(
    'filters' => array(
        array(
            'id' => 'by_report',
            'name' => 'LBL_FILTER_BY_REPORT',
            'filter_definition' => array(
                array(
                    'report_id' => array(
                        '$in' => array(),
                    ),
                ),
            ),
            'editable' => true,
            'is_template' => true,
        ),
    ),
);
