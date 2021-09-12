<?php
$dictionary['Quote']['fields']['quotes_sponsor'] = array (
    'name' => 'quotes_sponsor',
    'type' => 'link',
    'relationship' => 'quotes_sponsor',
    'source' => 'non-db',
    'module' => 'J_Sponsor',
    'bean_name' => 'j_sponsor',
    'id_name' => 'quote_id',
    'link-type' => 'one',
    'side' => 'left',
    'vname' => 'LBL_QUOTE_NAME',
);

$dictionary['Quote']['relationships']['quotes_sponsor'] = array (
    'lhs_module' => 'Quotes',
    'lhs_table' => 'quotes',
    'lhs_key' => 'id',
    'rhs_module' => 'J_Sponsor',
    'rhs_table' => 'j_sponsor',
    'rhs_key' => 'quote_id',
    'relationship_type' => 'one-to-many'
);
