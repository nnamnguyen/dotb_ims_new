<?php


$viewdefs['Cases']['QuickCreate'] = array(
'templateMeta' => array('maxColumns' => '2', 
                        'widths' => array(
                                        array('label' => '10', 'field' => '30'), 
                                        array('label' => '10', 'field' => '30')
                                        ),
                       ),
'panels' =>

array (
  
  array (
    array ('name'=>'name', 'displayParams'=>array('size'=>65, 'required'=>true)),
    'priority'
  ),
  
  array (
    'status',
    array('name'=>'account_name'),
  ),
  
  array (
    'assigned_user_name',
	array('name'=>'team_name', 'displayParams'=>array('required'=>true))
  ),
  
  array (
    array (
      'name' => 'description',
      'displayParams' => array ('rows' => '4','cols' => '60'),
      'nl2br' => true,
    ),
  ),

),

);
?>
