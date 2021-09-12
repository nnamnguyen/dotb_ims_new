<?php
$dictionary['Quote']['fields']['quotes_loyalty'] = array (
    'name' => 'quotes_loyalty',
    'type' => 'link',
    'relationship' => 'quotes_loyalty',
    'source' => 'non-db',
    'module' => 'J_Loyalty',
    'bean_name' => 'j_loyalty',
    'id_name' => 'quote_id',
    'link-type' => 'one',
    'side' => 'left',
    'vname' => 'LBL_QUOTE_NAME',
);

$dictionary['Quote']['relationships']['quotes_loyalty'] = array (
    'lhs_module' => 'Quotes',
    'lhs_table' => 'quotes',
    'lhs_key' => 'id',
    'rhs_module' => 'J_Loyalty',
    'rhs_table' => 'j_loyalty',
    'rhs_key' => 'quote_id',
    'relationship_type' => 'one-to-one'
);
