<?php


$dictionary['products_category_tree'] = array(
    'table' => 'category_tree',
    'fields' => array(
        'self_id' => array(
            'name' => 'self_id',
            'type' => 'id',
            'len' => '36',
        ),
        'node_id' => array(
            'name' => 'node_id',
            'type' => 'int',
            'auto_increment' => true,
            'required' => true,
            'isnull' => false,
        ),
        'parent_node_id' => array(
            'name' => 'parent_node_id',
            'type' => 'int',
            'default' => '0',
        ),
        'type' => array(
            'name' => 'type',
            'type' => 'varchar',
            'len' => '36',
        ),
    ),
    'indices' => array(
        array(
            'name' => 'categorytreepk',
            'type' => 'primary',
            'fields' => array(
                'node_id',
            ),
        ),
        array(
            'name' => 'idx_categorytree',
            'type' => 'index',
            'fields' => array(
                'self_id',
            ),
        ),
    ),
);
