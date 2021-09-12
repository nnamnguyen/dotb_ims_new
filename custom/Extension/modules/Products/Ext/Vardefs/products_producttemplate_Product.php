<?php
$dictionary['Product']['fields']['product_template_relationship_id'] =array(
    'name' => 'product_template_relationship_id',
    'vname' => 'LBL_PRODUCT_TEMPLATE_ID',
    'type' => 'id',
    'required'=>true,
    'reportable'=>false,
    'comment' => ''
);

$dictionary['Product']['fields']['product_template_relationship_name'] =array(
    'name' => 'product_template_relationship_name',
    'rname' => 'name',
    'id_name' => 'product_template_relationship_id',
    'vname' => 'LBL_PRODUCT_TEMPLATE_NAME',
    'type' => 'relate',
    'link' => 'product_template_link',
    'table' => 'product_templates',
    'isnull' => 'true',
    'module' => 'ProductTemplates',
    'dbType' => 'varchar',
    'len' => 'id',
    'reportable'=>true,
    'source' => 'non-db',
    'auto_populate' => true,
    'populate_list' =>
        array (
        ),
);

$dictionary['Product']['fields']['product_template_link'] =array(
    'name' => 'product_template_link',
    'type' => 'link',
    'relationship' => 'product_producttemplate_2',
    'link_type' => 'one',
    'side' => 'right',
    'source' => 'non-db',
    'vname' => 'LBL_PRODUCT_TEMPLATE_NAME',
    'id_name' => 'product_template_relationship_id',
);