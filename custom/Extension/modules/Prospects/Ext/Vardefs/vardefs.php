<?php
$dictionary['Prospect']['fields']['status'] = array(
    'name' => 'status',
    'vname' => 'LBL_STATUS',
    'type' => 'enum',
    'len' => '100',
    'options' => 'target_status_dom',
    'default' => 'Draw data',
    'audited' => true,
    'comment' => 'Status of the target',
    'merge_filter' => 'enabled',
    'previewEdit' => false,
);
