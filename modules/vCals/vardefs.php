<?php


		// Create the indexes
$dictionary['vCal'] = array('table' => 'vcals'
                               ,'fields' => array (
  'id' => 
  array (
    'name' => 'id',
    'vname' => 'LBL_NAME',
    'type' => 'id',
    'required'=>true,
    'reportable'=>false,
  ),
     'deleted' => 
  array (
    'name' => 'deleted',
    'vname' => 'LBL_DELETED',
    'type' => 'bool',
    'required' => false,
    'reportable'=>false,
  ),
  'date_entered' => 
  array (
    'name' => 'date_entered',
    'vname' => 'LBL_DATE_ENTERED',
    'type' => 'datetime',
  ),
  'date_modified' => 
  array (
    'name' => 'date_modified',
    'vname' => 'LBL_DATE_MODIFIED',
    'type' => 'datetime',
  ),
    'user_id' => 
  array (
    'name' => 'user_id',
    'type' => 'id',
	'required'=>true,
	'reportable'=>false,
  ),
    'type' => 
  array (
    'name' => 'type',
    'type' => 'varchar',
    'len' => 100,
  ),
  'source' => 
  array (
    'name' => 'source',
    'type' => 'varchar',
    'len' => 100,
  ),
  'content' => 
  array (
    'name' => 'content',
    'type' => 'text',
  ),
  

)
                                                      , 'indices' => array (
       array('name' =>'vcalspk', 'type' =>'primary', 'fields'=>array('id')),
        array('name' =>'idx_vcal', 'type' =>'index', 'fields'=>array('type', 'user_id', 'source'))
                                                      )

                            );
?>