<?php


$dictionary['locked_field_bean_rel'] = array(
    'table' => 'locked_field_bean_rel',
    'relationships' => array(
    ),
    'fields' => array(
        'id' => array(
            'name' => 'id',
            'type' => 'id',
            'required' => true,
        ),
        'pd_id' => array(
            'name' => 'pd_id',
            'type' => 'id',
            'required' => true,
        ),
        'bean_id' => array(
            'name' => 'bean_id',
            'type' => 'id',
            'required' => true,
        ),
        'bean_module' => array(
            'name' => 'bean_module',
            'type' => 'varchar',
            'len' => 100,
        ),
        'date_modified' => array(
            'name' => 'date_modified',
            'type' => 'datetime',
        ),
        'deleted' => array(
            'name' => 'deleted',
            'type' => 'bool',
            'default' => '0',
        ),
    ),
    'indices' => array(
        array(
            'name' => 'locked_fields_bean_relpk',
            'type' => 'primary',
            'fields' => array(
                'id',
            ),
        ),
        array(
            'name' => 'idx_locked_fields_rel_pdid_beanid',
            'type' => 'index',
            'fields' => array(
                'pd_id',
                'bean_id',
            ),
        ),
        array(
            'name' => 'idx_locked_field_bean_rel_del_bean_module_beanid',
            'type' => 'index',
            'fields' => array(
                'bean_module',
                'deleted',
            ),
        ),
        array(
            'name' => 'idx_locked_field_bean_rel_beanid_del_bean_module',
            'type' => 'index',
            'fields' => array(
                'bean_id',
                'deleted',
                'bean_module',
            ),
        ),
    ),
);
