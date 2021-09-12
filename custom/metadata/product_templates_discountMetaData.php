<?php
// created: 2020-10-16 11:17:57
$dictionary["product_templates_discount"] = array (
    'true_relationship_type' => 'many-to-many',
    'from_studio' => false,
    'relationships' =>
        array (
            'product_templates_discount' =>
                array (
                    'lhs_module'=> 'ProductTemplates'
                , 'lhs_table'=> 'product_templates'
                , 'lhs_key' => 'id'
                , 'rhs_module'=> 'J_Discount'
                , 'rhs_table'=> 'j_discount'
                , 'rhs_key' => 'id'
                , 'relationship_type'=>'many-to-many'
                , 'join_table'=> 'product_templates_discount'
                , 'join_key_lhs'=>'product_templates_id'
                , 'join_key_rhs'=>'discount_id'
                ),
        ),
    'table' => 'product_templates_discount',
    'fields' =>
        array (
            'id' =>
                array (
                    'name' => 'id',
                    'type' => 'id',
                ),
            'date_modified' =>
                array (
                    'name' => 'date_modified',
                    'type' => 'datetime',
                ),
            'deleted' =>
                array (
                    'name' => 'deleted',
                    'type' => 'bool',
                    'default' => 0,
                ),
            'product_templates_id' =>
                array (
                    'name' => 'product_templates_id',
                    'type' => 'id',
                ),
            'discount_id' =>
                array (
                    'name' => 'discount_id',
                    'type' => 'id',
                ),
        ),
    'indices' =>
        array (
            0 =>
                array (
                    'name' => 'idx_product_templates_discount_pk',
                    'type' => 'primary',
                    'fields' =>
                        array (
                            0 => 'id',
                        ),
                ),
            1 =>
                array (
                    'name' => 'idx_product_templates_id_deleted',
                    'type' => 'index',
                    'fields' =>
                        array (
                            0 => 'product_templates_id',
                            1 => 'deleted',
                        ),
                ),
            2 =>
                array (
                    'name' => 'idx_discount_id_deleted',
                    'type' => 'index',
                    'fields' =>
                        array (
                            0 => 'discount_id',
                            1 => 'deleted',
                        ),
                ),
            3 =>
                array (
                    'name' => 'product_templates_discount_alt',
                    'type' => 'alternate_key',
                    'fields' =>
                        array (
                            0 => 'product_templates_id',
                            1 => 'discount_id',
                        ),
                ),
        ),
);