<?php

$viewdefs['OAuthKeys']['EditView'] = array(
    'templateMeta' => array('maxColumns' => '2',
                            'widths' => array(
                                            array('label' => '10', 'field' => '30'),
                                            array('label' => '10', 'field' => '30')
                                            ),
 ),
 'panels' =>array (
  'default' =>
  array (
      array('name','oauth_type'),
    array ('c_key', 'client_type'),
    array('c_secret','description'),
  ),
),
);
