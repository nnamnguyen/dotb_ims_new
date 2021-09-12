<?php



/*********************************************************************************
* Description:
* Portions created by DotBCRM are Copyright (C) DotBCRM, Inc. All Rights
* Reserved. Contributor(s): contact@synolia.com - www.synolia.com
* *******************************************************************************/

$dictionary['ext_rest_twitter'] = array(

  'comment' => 'vardefs for twitter connector',
  'fields' => array (
    'id' =>
	  array (
	    'name' => 'id',
	    'vname' => 'LBL_ID',
	    'type' => 'id',
	    'comment' => 'Unique identifier',
	  	'hidden' => true,
	),
    'name'=> array(
	    'name' => 'name',
	    'vname' => 'LBL_NAME',
	    'type' => 'varchar',
		'hover' => true,
	    'comment' => 'The username on Twitter',
    ),
  )
);
?>
