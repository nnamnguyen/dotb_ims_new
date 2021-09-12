<?php

/*********************************************************************************
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/
 

$viewdefs ['Accounts'] = 
array (
  'QuickCreate' => 
  array (
    'templateMeta' => 
    array (
      'form' => 
      array (
        'buttons' => 
        array (
          'SAVE',
          'CANCEL',
        ),
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
      'includes' => 
      array (
        array (
          'file' => 'modules/Accounts/Account.js',
        ),
      ),
    ),
    'panels' => 
    array (
      'default' => 
      array (
        array (
          array (
            'name' => 'name',
            'displayParams' => 
            array (
              'required' => true,
            ),
          ),
        ),
        array (
          array (
            'name' => 'website',
          ),
          array (
            'name' => 'phone_office',
          ),
        ),
        array (
          array (
            'name' => 'email1',
          ),
          array (
            'name' => 'phone_fax',
          ),
        ),
        array (
          array (
            'name' => 'industry',
          ),
          array (
            'name' => 'account_type',
          ),
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
); 
 
?>