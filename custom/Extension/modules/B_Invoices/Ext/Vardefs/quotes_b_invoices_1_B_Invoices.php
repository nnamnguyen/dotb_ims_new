<?php
// created: 2020-04-23 00:02:38
$dictionary["B_Invoices"]["fields"]["quotes_b_invoices_1"] = array (
  'name' => 'quotes_b_invoices_1',
  'type' => 'link',
  'relationship' => 'quotes_b_invoices_1',
  'source' => 'non-db',
  'module' => 'Quotes',
  'bean_name' => 'Quote',
  'side' => 'right',
  'vname' => 'LBL_QUOTES_B_INVOICES_1_FROM_B_INVOICES_TITLE',
  'id_name' => 'quotes_b_invoices_1quotes_ida',
  'link-type' => 'one',
);
$dictionary["B_Invoices"]["fields"]["quotes_b_invoices_1_name"] = array (
  'name' => 'quotes_b_invoices_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_QUOTES_B_INVOICES_1_FROM_QUOTES_TITLE',
  'save' => true,
  'id_name' => 'quotes_b_invoices_1quotes_ida',
  'link' => 'quotes_b_invoices_1',
  'table' => 'quotes',
  'module' => 'Quotes',
  'rname' => 'name',
);
$dictionary["B_Invoices"]["fields"]["quotes_b_invoices_1quotes_ida"] = array (
  'name' => 'quotes_b_invoices_1quotes_ida',
  'type' => 'id',
  'source' => 'non-db',
  'vname' => 'LBL_QUOTES_B_INVOICES_1_FROM_B_INVOICES_TITLE_ID',
  'id_name' => 'quotes_b_invoices_1quotes_ida',
  'link' => 'quotes_b_invoices_1',
  'table' => 'quotes',
  'module' => 'Quotes',
  'rname' => 'id',
  'reportable' => false,
  'side' => 'right',
  'massupdate' => false,
  'duplicate_merge' => 'disabled',
  'hideacl' => true,
);
