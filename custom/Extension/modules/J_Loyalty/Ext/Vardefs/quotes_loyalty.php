<?php
$dictionary['J_Loyalty']['fields']['quote_id'] =
    array(
        'name' => 'quote_id',
        'vname' => 'LBL_QUOTE_ID',
        'type' => 'id',
        'required'=>true,
        'reportable'=>false,
        'comment' => ''
    );

$dictionary['J_Loyalty']['fields']['quote_name'] =
    array(
        'name' => 'quote_name',
        'rname' => 'name',
        'id_name' => 'quote_id',
        'vname' => 'LBL_QUOTE_NAME',
        'type' => 'relate',
        'link' => 'quote_link',
        'table' => 'quotes',
        'isnull' => 'true',
        'module' => 'Quotes',
        'dbType' => 'varchar',
        'len' => 'id',
        'reportable'=>true,
        'source' => 'non-db',
        'auto_populate' => true,
    );

$dictionary['J_Loyalty']['fields']['quote_link'] =
    array(
        'name' => 'quote_link',
        'type' => 'link',
        'relationship' => 'quotes_loyalty',
        'link_type' => 'one',
        'side' => 'right',
        'source' => 'non-db',
        'vname' => 'LBL_QUOTE_NAME',
        'id_name' => 'quote_id',
    );