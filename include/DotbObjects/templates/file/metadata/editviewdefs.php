<?php

/*********************************************************************************
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/

 $module_name = '<module_name>';

 $viewdefs[$module_name]['EditView'] = array(
    'templateMeta' => array('form' => array('enctype'=>'multipart/form-data',
                                            'hidden'=>array()),

                            'maxColumns' => '2',
                            'widths' => array(
                                            array('label' => '10', 'field' => '30'),
                                            array('label' => '10', 'field' => '30')
                                            ),
'javascript' =>
	'{dotb_getscript file="include/javascript/popup_parent_helper.js"}
	{dotb_getscript file="modules/Documents/documents.js"}',
),
 'panels' =>array (
  'default' =>
  array (

    array (
      'document_name',
      array(
      		'name'=>'uploadfile',
            'displayParams' => array('onchangeSetFileNameTo' => 'document_name'),
      ),

	),

    array (
       'category_id',
       'subcategory_id',
    ),

    array (
      'assigned_user_name',
      array('name'=>'team_name','displayParams'=>array('required'=>true)),
    ),

    array (
      'active_date',
      'exp_date',
    ),

	array('status_id'),
    array (

      array('name'=>'description'),

    ),
  ),
)
);

