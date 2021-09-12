<?php
// created: 2020-10-23 10:43:54
$dictionary["J_Payment"]["fields"]["quotes_j_payment_1"] = array (
  'name' => 'quotes_j_payment_1',
  'type' => 'link',
  'relationship' => 'quotes_j_payment_1',
  'source' => 'non-db',
  'module' => 'Quotes',
  'bean_name' => 'Quote',
  'vname' => 'LBL_QUOTES_J_PAYMENT_1_FROM_QUOTES_TITLE',
  'id_name' => 'quotes_j_payment_1quotes_ida',
);
$dictionary["J_Payment"]["fields"]["total_amount_relata_balance"] = array (
    'massupdate' => false,
    'name' => 'total_amount_relata_balance',
    'type' => 'currenct',
    'studio' => 'false',
    'source' => 'non-db',
    'vname' => 'LBL_TOTAL_AMOUNT',
    'importable' => 'false',
    'len' => 26,
    'size' => '20',
    'enable_range_search' => false,
    'precision' => 2,
    'related_fields' =>
        array (
            0 => 'currency_id',
            1 => 'base_rate',
        ),
);