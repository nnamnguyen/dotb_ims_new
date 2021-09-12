<?php


$module_name = 'J_Discount';
$viewdefs[$module_name]['base']['filter']['default'] = array(
    'default_filter' => 'all_records',
    'fields' => array(
        'order_no' => array(),
        'name' => array(),
        'status' => array(),
        'type' => array(),
        'category' => array(),
        'discount_percent' => array(),
        'discount_amount' => array(),
        'policy' => array(),
        'team_name' => array(),
        'date_modified' => array(),
        'date_entered' => array(),
        'assigned_user_name' => array(),
        '$owner' => array(
            'predefined_filter' => true,
            'vname' => 'LBL_CURRENT_USER_FILTER',
        ),
        '$favorite' => array(
            'predefined_filter' => true,
            'vname' => 'LBL_FAVORITES_FILTER',
        ),
        'created_by_name' => array(),
        'modified_by_name' => array(),
        'product_discount' => array (
            'db_field' =>
                array (
                    0 => 'id',
                ),
            'query_type' => 'format',
            'operator' => 'subquery',
            'subquery' => 'SELECT product_templates_discount.discount_id FROM product_templates_discount
                           INNER JOIN j_discount ON j_discount.id = product_templates_discount.discount_id AND j_discount.deleted = 0
                           WHERE product_templates_discount.deleted = 0 AND product_templates_discount.product_templates_id = \'{0}\'',
        ),
    ),
    'quicksearch_field' => array(
    ),
    'quicksearch_priority' => 2,
);
