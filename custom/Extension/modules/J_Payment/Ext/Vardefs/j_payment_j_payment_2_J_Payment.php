<?php
// created: 2019-10-11 04:27:28
$dictionary["J_Payment"]["fields"]["j_payment_j_payment_2"] = array (
  'name' => 'j_payment_j_payment_2',
  'type' => 'link',
  'relationship' => 'j_payment_j_payment_2',
  'source' => 'non-db',
  'module' => 'J_Payment',
  'bean_name' => 'J_Payment',
  'vname' => 'LBL_J_PAYMENT_J_PAYMENT_2_FROM_J_PAYMENT_L_TITLE',
  'id_name' => 'j_payment_j_payment_2j_payment_idb',
  'link-type' => 'many',
  'side' => 'left',
);
$dictionary["J_Payment"]["fields"]["j_payment_j_payment_2_right"] = array (
  'name' => 'j_payment_j_payment_2_right',
  'type' => 'link',
  'relationship' => 'j_payment_j_payment_2',
  'source' => 'non-db',
  'module' => 'J_Payment',
  'bean_name' => 'J_Payment',
  'side' => 'right',
  'vname' => 'LBL_J_PAYMENT_J_PAYMENT_2_FROM_J_PAYMENT_R_TITLE',
  'id_name' => 'j_payment_j_payment_2j_payment_ida',
  'link-type' => 'one',
);
$dictionary["J_Payment"]["fields"]["j_payment_j_payment_2_name"] = array (
  'name' => 'j_payment_j_payment_2_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_J_PAYMENT_J_PAYMENT_2_FROM_J_PAYMENT_L_TITLE',
  'save' => true,
  'id_name' => 'j_payment_j_payment_2j_payment_ida',
  'link' => 'j_payment_j_payment_2_right',
  'table' => 'j_payment',
  'module' => 'J_Payment',
  'rname' => 'name',
);
$dictionary["J_Payment"]["fields"]["j_payment_j_payment_2j_payment_ida"] = array (
  'name' => 'j_payment_j_payment_2j_payment_ida',
  'type' => 'id',
  'source' => 'non-db',
  'vname' => 'LBL_J_PAYMENT_J_PAYMENT_2_FROM_J_PAYMENT_R_TITLE_ID',
  'id_name' => 'j_payment_j_payment_2j_payment_ida',
  'link' => 'j_payment_j_payment_2_right',
  'table' => 'j_payment',
  'module' => 'J_Payment',
  'rname' => 'id',
  'reportable' => false,
  'side' => 'right',
  'massupdate' => false,
  'duplicate_merge' => 'disabled',
  'hideacl' => true,
);
