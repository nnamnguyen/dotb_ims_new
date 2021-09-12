<?php

// created: 2005-11-04 15:39:46
$acldefs['ProjectTask'] = array (
  'forms' => 
  array (
    'by_name' => 
    array (
      'change_project' => 
      array (
        'display_option' => 'disabled',
        'action_option' => 'list',
        'app_action' => 'EditView',
        'module' => 'Project',
      ),
      'change_parent' => 
      array (
        'display_option' => 'disabled',
        'action_option' => 'list',
        'app_action' => 'EditView',
        'module' => 'ProjectTask',
      ),
    ),
  ),
  'form_names' => 
  array (
    'by_id' => 'by_id',
    'by_name' => 'by_name',
    'DetailView' => 'DetailView',
    'EditView' => 'EditView',
  ),
);
?>
