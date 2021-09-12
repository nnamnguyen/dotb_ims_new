<?php

$viewdefs ['Notes'] =
array (
  'QuickCreate' =>
  array (
    'templateMeta' =>
    array (
      'form' =>
      array (
        'enctype' => 'multipart/form-data',
      ),
      'maxColumns' => '2',
      'widths' =>
      array (

        array (
          'label' => '10',
          'field' => '30',
        ),

        array (
          'label' => '10',
          'field' => '30',
        ),
      ),
      'javascript' => '{dotb_getscript file="include/javascript/dashlets.js"}
<script>toggle_portal_flag(); function toggle_portal_flag()  {literal} { {/literal} {$TOGGLE_JS} {literal} } {/literal} </script>',
    ),
    'panels' =>
    array (
      'default' =>
      array (

        array (
           'contact_name',
           'parent_name',
        ),
        array (

          array (
            'name' => 'name',
            'label' => 'LBL_SUBJECT',
            'displayParams' =>
            array (
              'size' => 50,
              'required' => true,
            ),
          ),
          array(
          	'name' => 'assigned_user_name','label' => 'LBL_ASSIGNED_TO',
          ),
        ),

        array (
           'filename',
        ),

        array (

          array (
            'name' => 'description',
            'label' => 'LBL_NOTE_STATUS',
            'displayParams' =>
            array (
              'rows' => 6,
              'cols' => 75,
            ),
          ),
        ),
		array (
			array (
				'name' => 'portal_flag',
				'comment' => 'Portal flag indicator determines if note created via portal',
				'label' => 'LBL_PORTAL_FLAG',
				'displayParams'=>array('required'=>false),
			),
		),
         array (
           
            array (
              'name' => 'team_name',
            ),
        ),
      ),
    ),
  ),
);
?>
