<?php

$module_name = 'Notifications';
$viewdefs[$module_name]['EditView'] = array(
    'templateMeta' => array('maxColumns' => '2', 
                            'widths' => array(
                                            array('label' => '10', 'field' => '30'), 
                                            array('label' => '10', 'field' => '30')
                                            ),                                                                                                                                    
                                            ),
                                            
                                            
 'panels' =>array (
  'default' => 
  array (
    
    array (
      'name',
      
    ),
    
    
    array (
      'description',
    ),
    array (
        'assigned_user_name',
      array('name'=>'team_name', 'displayParams'=>array('display'=>true)),
    ),
  ),
                                                    
),
                        
);
?>
