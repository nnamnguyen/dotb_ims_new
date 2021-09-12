<?php


    $viewdefs['base']['filter']['operators'] = array(
        'multienum' => array(
            '$contains' => 'LBL_OPERATOR_CONTAINS',
            '$not_contains' => 'LBL_OPERATOR_NOT_CONTAINS',
        ),
        'enum' => array(
            '$in' => 'LBL_OPERATOR_CONTAINS',
            '$not_in' => 'LBL_OPERATOR_NOT_CONTAINS',
            '$empty' => 'LBL_OPERATOR_EMPTY',
            '$not_empty' => 'LBL_OPERATOR_NOT_EMPTY',
        ),
        'varchar' => array(
            '$equals' => 'LBL_OPERATOR_MATCHES',
            '$starts' => 'LBL_OPERATOR_STARTS_WITH',
        ),
        'name' => array(
            '$equals' => 'LBL_OPERATOR_MATCHES',
            '$starts' => 'LBL_OPERATOR_STARTS_WITH',
        ),
        'email' => array(
            '$equals' => 'LBL_OPERATOR_MATCHES',
            '$starts' => 'LBL_OPERATOR_STARTS_WITH',
        ),
        'text' => array(
            '$equals' => 'LBL_OPERATOR_MATCHES',
            '$starts' => 'LBL_OPERATOR_STARTS_WITH',
        ),
        'textarea' => array(
            '$equals' => 'LBL_OPERATOR_MATCHES',
            '$starts' => 'LBL_OPERATOR_STARTS_WITH',
        ),
        'currency' => array(
            '$equals' => 'LBL_OPERATOR_EQUALS',
            '$not_equals' => 'LBL_OPERATOR_NOT_EQUALS',
            '$gt' => 'LBL_OPERATOR_GREATER_THAN',
            '$lt' => 'LBL_OPERATOR_LESS_THAN',
            '$gte' => 'LBL_OPERATOR_GREATER_THAN_OR_EQUALS',
            '$lte' => 'LBL_OPERATOR_LESS_THAN_OR_EQUALS',
            '$between' => 'LBL_OPERATOR_BETWEEN',
        ),
        'int' => array(
            '$equals' => 'LBL_OPERATOR_EQUALS',
            '$not_equals' => 'LBL_OPERATOR_NOT_EQUALS',
            '$in' => 'LBL_OPERATOR_CONTAINS',
            '$gt' => 'LBL_OPERATOR_GREATER_THAN',
            '$lt' => 'LBL_OPERATOR_LESS_THAN',
            '$gte' => 'LBL_OPERATOR_GREATER_THAN_OR_EQUALS',
            '$lte' => 'LBL_OPERATOR_LESS_THAN_OR_EQUALS',
            '$between' => 'LBL_OPERATOR_BETWEEN',
        ),
        'double' => array(
            '$equals' => 'LBL_OPERATOR_EQUALS',
            '$not_equals' => 'LBL_OPERATOR_NOT_EQUALS',
            '$gt' => 'LBL_OPERATOR_GREATER_THAN',
            '$lt' => 'LBL_OPERATOR_LESS_THAN',
            '$gte' => 'LBL_OPERATOR_GREATER_THAN_OR_EQUALS',
            '$lte' => 'LBL_OPERATOR_LESS_THAN_OR_EQUALS',
            '$between' => 'LBL_OPERATOR_BETWEEN',
        ),
        'float' => array(
            '$equals' => 'LBL_OPERATOR_EQUALS',
            '$not_equals' => 'LBL_OPERATOR_NOT_EQUALS',
            '$gt' => 'LBL_OPERATOR_GREATER_THAN',
            '$lt' => 'LBL_OPERATOR_LESS_THAN',
            '$gte' => 'LBL_OPERATOR_GREATER_THAN_OR_EQUALS',
            '$lte' => 'LBL_OPERATOR_LESS_THAN_OR_EQUALS',
            '$between' => 'LBL_OPERATOR_BETWEEN',
        ),
        'decimal' => array(
            '$equals' => 'LBL_OPERATOR_EQUALS',
            '$not_equals' => 'LBL_OPERATOR_NOT_EQUALS',
            '$gt' => 'LBL_OPERATOR_GREATER_THAN',
            '$lt' => 'LBL_OPERATOR_LESS_THAN',
            '$gte' => 'LBL_OPERATOR_GREATER_THAN_OR_EQUALS',
            '$lte' => 'LBL_OPERATOR_LESS_THAN_OR_EQUALS',
            '$between' => 'LBL_OPERATOR_BETWEEN',
        ),
        'date' => array(
            '$equals' => 'LBL_OPERATOR_EQUALS',
            '$lt' => 'LBL_OPERATOR_BEFORE',
            '$gt' => 'LBL_OPERATOR_AFTER',
            'yesterday' => 'LBL_OPERATOR_YESTERDAY',
            'today' => 'LBL_OPERATOR_TODAY',
            'tomorrow' => 'LBL_OPERATOR_TOMORROW',
            'before_today' => 'LBL_OPERATOR_BEFORE_TODAY',
            'after_today' => 'LBL_OPERATOR_AFTER_TODAY',
            'last_7_days' => 'LBL_OPERATOR_LAST_7_DAYS',
            'next_7_days' => 'LBL_OPERATOR_NEXT_7_DAYS',
            'before_last_7_days' => 'LBL_OPERATOR_BEFORE_LAST_7_DAYS',
            'after_next_7_days' => 'LBL_OPERATOR_AFTER_NEXT_7_DAYS',
            'last_30_days' => 'LBL_OPERATOR_LAST_30_DAYS',
            'next_30_days' => 'LBL_OPERATOR_NEXT_30_DAYS',
            'last_month' => 'LBL_OPERATOR_LAST_MONTH',
            'this_month' => 'LBL_OPERATOR_THIS_MONTH',
            'next_month' => 'LBL_OPERATOR_NEXT_MONTH',
            'before_last_30_days' => 'LBL_OPERATOR_BEFORE_LAST_30_DAYS',
            'after_next_30_days' => 'LBL_OPERATOR_AFTER_NEXT_30_DAYS',
            'last_year' => 'LBL_OPERATOR_LAST_YEAR',
            'this_year' => 'LBL_OPERATOR_THIS_YEAR',
            'next_year' => 'LBL_OPERATOR_NEXT_YEAR',
            '$dateBetween' => 'LBL_OPERATOR_BETWEEN',
            '$not_empty' => 'LBL_OPERATOR_NOT_EMPTY',
            '$empty' => 'LBL_OPERATOR_EMPTY',
        ),
        'datetime' => array(
            '$starts' => 'LBL_OPERATOR_EQUALS',
            '$lte' => 'LBL_OPERATOR_BEFORE',
            '$gte' => 'LBL_OPERATOR_AFTER',
            'yesterday' => 'LBL_OPERATOR_YESTERDAY',
            'today' => 'LBL_OPERATOR_TODAY',
            'tomorrow' => 'LBL_OPERATOR_TOMORROW',
            'before_today' => 'LBL_OPERATOR_BEFORE_TODAY',
            'after_today' => 'LBL_OPERATOR_AFTER_TODAY',
            'last_7_days' => 'LBL_OPERATOR_LAST_7_DAYS',
            'next_7_days' => 'LBL_OPERATOR_NEXT_7_DAYS',
            'before_last_7_days' => 'LBL_OPERATOR_BEFORE_LAST_7_DAYS',
            'after_next_7_days' => 'LBL_OPERATOR_AFTER_NEXT_7_DAYS',
            'last_30_days' => 'LBL_OPERATOR_LAST_30_DAYS',
            'next_30_days' => 'LBL_OPERATOR_NEXT_30_DAYS',
            'last_month' => 'LBL_OPERATOR_LAST_MONTH',
            'this_month' => 'LBL_OPERATOR_THIS_MONTH',
            'next_month' => 'LBL_OPERATOR_NEXT_MONTH',
            'before_last_30_days' => 'LBL_OPERATOR_BEFORE_LAST_30_DAYS',
            'after_next_30_days' => 'LBL_OPERATOR_AFTER_NEXT_30_DAYS',
            'last_year' => 'LBL_OPERATOR_LAST_YEAR',
            'this_year' => 'LBL_OPERATOR_THIS_YEAR',
            'next_year' => 'LBL_OPERATOR_NEXT_YEAR',
            '$dateBetween' => 'LBL_OPERATOR_BETWEEN',
            '$not_empty' => 'LBL_OPERATOR_NOT_EMPTY',
        ),
        'datetimecombo' => array(
            '$starts' => 'LBL_OPERATOR_EQUALS',
            '$lte' => 'LBL_OPERATOR_BEFORE',
            '$gte' => 'LBL_OPERATOR_AFTER',
            'yesterday' => 'LBL_OPERATOR_YESTERDAY',
            'today' => 'LBL_OPERATOR_TODAY',
            'tomorrow' => 'LBL_OPERATOR_TOMORROW',
            'before_today' => 'LBL_OPERATOR_BEFORE_TODAY',
            'after_today' => 'LBL_OPERATOR_AFTER_TODAY',
            'last_7_days' => 'LBL_OPERATOR_LAST_7_DAYS',
            'next_7_days' => 'LBL_OPERATOR_NEXT_7_DAYS',
            'before_last_7_days' => 'LBL_OPERATOR_BEFORE_LAST_7_DAYS',
            'after_next_7_days' => 'LBL_OPERATOR_AFTER_NEXT_7_DAYS',
            'last_30_days' => 'LBL_OPERATOR_LAST_30_DAYS',
            'next_30_days' => 'LBL_OPERATOR_NEXT_30_DAYS',
            'last_month' => 'LBL_OPERATOR_LAST_MONTH',
            'this_month' => 'LBL_OPERATOR_THIS_MONTH',
            'next_month' => 'LBL_OPERATOR_NEXT_MONTH',
            'before_last_30_days' => 'LBL_OPERATOR_BEFORE_LAST_30_DAYS',
            'after_next_30_days' => 'LBL_OPERATOR_AFTER_NEXT_30_DAYS',
            'last_year' => 'LBL_OPERATOR_LAST_YEAR',
            'this_year' => 'LBL_OPERATOR_THIS_YEAR',
            'next_year' => 'LBL_OPERATOR_NEXT_YEAR',
            '$dateBetween' => 'LBL_OPERATOR_BETWEEN',
            '$not_empty' => 'LBL_OPERATOR_NOT_EMPTY',
        ),
        'bool' => array(
            '$equals' => 'LBL_OPERATOR_IS'
        ),
        'relate' => array(
            '$in' => 'LBL_OPERATOR_CONTAINS',
            '$not_in' => 'LBL_OPERATOR_NOT_CONTAINS',
        ),
        'teamset' => array(
            '$in' => 'LBL_OPERATOR_CONTAINS',
            '$not_in' => 'LBL_OPERATOR_NOT_CONTAINS',
        ),
        'phone' => array(
            '$starts' => 'LBL_OPERATOR_STARTS_WITH',
            '$equals' => 'LBL_OPERATOR_IS',
        ),
        'radioenum' => array(
            '$equals' => 'LBL_OPERATOR_IS',
            '$not_equals' => 'LBL_OPERATOR_IS_NOT',
        ),
        'parent' => array(
            '$equals' => 'LBL_OPERATOR_IS',
        ),
        'tag' => array(
            '$in' => 'LBL_OPERATOR_CONTAINS',
            '$not_in' => 'LBL_OPERATOR_NOT_CONTAINS',
            '$empty' => 'LBL_OPERATOR_EMPTY',
            '$not_empty' => 'LBL_OPERATOR_NOT_EMPTY',
        ),
    );