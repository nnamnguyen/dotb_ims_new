<?php
// created: 2020-04-23 00:04:02
$dictionary["B_Invoices"]["fields"]["accounts_b_invoices_1"] = array (
  'name' => 'accounts_b_invoices_1',
  'type' => 'link',
  'relationship' => 'accounts_b_invoices_1',
  'source' => 'non-db',
  'module' => 'Accounts',
  'bean_name' => 'Account',
  'side' => 'right',
  'vname' => 'LBL_ACCOUNTS_B_INVOICES_1_FROM_B_INVOICES_TITLE',
  'id_name' => 'accounts_b_invoices_1accounts_ida',
  'link-type' => 'one',
);
$dictionary["B_Invoices"]["fields"]["accounts_b_invoices_1_name"] = array (
  'name' => 'accounts_b_invoices_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_ACCOUNTS_B_INVOICES_1_FROM_ACCOUNTS_TITLE',
  'save' => true,
  'id_name' => 'accounts_b_invoices_1accounts_ida',
  'link' => 'accounts_b_invoices_1',
  'table' => 'accounts',
  'module' => 'Accounts',
  'rname' => 'name',
);
$dictionary["B_Invoices"]["fields"]["accounts_b_invoices_1accounts_ida"] = array (
  'name' => 'accounts_b_invoices_1accounts_ida',
  'type' => 'id',
  'source' => 'non-db',
  'vname' => 'LBL_ACCOUNTS_B_INVOICES_1_FROM_B_INVOICES_TITLE_ID',
  'id_name' => 'accounts_b_invoices_1accounts_ida',
  'link' => 'accounts_b_invoices_1',
  'table' => 'accounts',
  'module' => 'Accounts',
  'rname' => 'id',
  'reportable' => false,
  'side' => 'right',
  'massupdate' => false,
  'duplicate_merge' => 'disabled',
  'hideacl' => true,
);
