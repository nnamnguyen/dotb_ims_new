<?php

/*********************************************************************************
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/

$viewdefs = array (
  'Opportunities' => 
  array (
    'QuickCreate' => 
    array (
      'templateMeta' => 
      array (
        'maxColumns' => '2',
        'widths' => 
        array (
          0 => 
          array (
            'label' => '10',
            'field' => '30',
          ),
          1 => 
          array (
            'label' => '10',
            'field' => '30',
          ),
        ),
        'javascript' => '{$PROBABILITY_SCRIPT}',
      ),
      'panels' => 
      array (
        'DEFAULT' => 
        array (
          array (
            array (
              'name' => 'name',
              'displayParams'=>array('required'=>true),
            ),
            array (
              'name' => 'account_name',
            ),
          ),
          array (
            array (
              'name' => 'currency_id',
            ),
            array (
              'name' => 'opportunity_type',
            ),            
          ),
          array (
            'amount',
            'date_closed'          
          ),
          array (
             'next_step',
             'sales_stage',
          ),
          array (
             'lead_source',
             'probability',
          ),
        array (
            array (
              'name' => 'assigned_user_name',
            ),
            array (
              'name' => 'team_name',
            ),
        ),
        ),
      ),
    ),
  ),
);
?>
