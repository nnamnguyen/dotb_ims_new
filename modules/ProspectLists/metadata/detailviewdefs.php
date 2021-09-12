<?php

$viewdefs['ProspectLists']['DetailView'] = array(
'templateMeta' => array('form' => array('closeFormBeforeCustomButtons' => true,'buttons'=>array('EDIT', 'DUPLICATE', 'DELETE', 
array('customCode'=> '<input title="{$APP.LBL_EXPORT}"  class="button" type="button" name="opp_to_quote_button" id="export_button" value="{$APP.LBL_EXPORT}" onclick="document.location.href = \'index.php?entryPoint=export&module=ProspectLists&uid={$fields.id.value}&members=1\'">'),)),
				
						'maxColumns' => '2',
                        'widths' => array(
                                        array('label' => '10', 'field' => '30'),
                                        array('label' => '10', 'field' => '30')
                                        ),
                        ),
'panels' => array(
   'default' => array (
  	  array (
  	  	  'name',
  	  	  array('name'=>'entry_count','label'=>'LBL_ENTRIES'),
  	  ),
	  array (
	      'list_type',
	      'domain_name',
	  ),
	  array (
	      'description',
	  ),
	),
	'LBL_PANEL_ASSIGNMENT' => array(
		array (
		  'assigned_user_name',  
		  array (
		      'name' => 'date_modified',
		      'label' => 'LBL_DATE_MODIFIED',
		      'customCode' => '{$fields.date_modified.value} {$APP.LBL_BY} {$fields.modified_by_name.value}',
		  ),
		),	
		array (
		      'team_name',
			array (
		      'name' => 'date_entered',
		      'customCode' => '{$fields.date_entered.value} {$APP.LBL_BY} {$fields.created_by_name.value}',
		  	),
		),
	)
)


);
?>