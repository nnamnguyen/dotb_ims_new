<?php
// created: 2020-04-23 00:04:45
$dictionary["B_Invoices"]["fields"]["contacts_b_invoices_1"] = array (
  'name' => 'contacts_b_invoices_1',
  'type' => 'link',
  'relationship' => 'contacts_b_invoices_1',
  'source' => 'non-db',
  'module' => 'Contacts',
  'bean_name' => 'Contact',
  'side' => 'right',
  'vname' => 'LBL_CONTACTS_B_INVOICES_1_FROM_B_INVOICES_TITLE',
  'id_name' => 'contacts_b_invoices_1contacts_ida',
  'link-type' => 'one',
);
$dictionary["B_Invoices"]["fields"]["contacts_b_invoices_1_name"] = array (
  'name' => 'contacts_b_invoices_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_CONTACTS_B_INVOICES_1_FROM_CONTACTS_TITLE',
  'save' => true,
  'id_name' => 'contacts_b_invoices_1contacts_ida',
  'link' => 'contacts_b_invoices_1',
  'table' => 'contacts',
  'module' => 'Contacts',
  'rname' => 'full_name',
  'db_concat_fields' => 
  array (
    0 => 'first_name',
    1 => 'last_name',
  ),
);
$dictionary["B_Invoices"]["fields"]["contacts_b_invoices_1contacts_ida"] = array (
  'name' => 'contacts_b_invoices_1contacts_ida',
  'type' => 'id',
  'source' => 'non-db',
  'vname' => 'LBL_CONTACTS_B_INVOICES_1_FROM_B_INVOICES_TITLE_ID',
  'id_name' => 'contacts_b_invoices_1contacts_ida',
  'link' => 'contacts_b_invoices_1',
  'table' => 'contacts',
  'module' => 'Contacts',
  'rname' => 'id',
  'reportable' => false,
  'side' => 'right',
  'massupdate' => false,
  'duplicate_merge' => 'disabled',
  'hideacl' => true,
);
