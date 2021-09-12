<?php

  $searchdefs['EmailTemplates'] = array(
					'templateMeta' => array(
							'maxColumns' => '2',
  							'maxColumnsBasic' => '2',
                            'widths' => array('label' => '10', 'field' => '30'),
                           ),
                    'layout' => array(
						'basic_search' => array(
						 	'name',
                            'type' => array('name' => 'type', 'type'=>'enum', 'function' => array('name' => 'EmailTemplate::getTypeOptionsForSearch'))
							),
					    'advanced_search' => array('name',
                                                        'type' => array('name' => 'type', 'type'=>'enum', 'function' => array('name' => 'EmailTemplate::getTypeOptionsForSearch')),
                                                        'subject','description',
                                					    'assigned_user_id' =>
                                					      array (
                                					        'name' => 'assigned_user_id',
                                					        'type' => 'enum',
                                					        'label' => 'LBL_ASSIGNED_TO',
                                					        'function' =>
                                					         array (
                                    					          'name' => 'get_user_array',
                                    					          'params' => array ( 0 => false,), ),
                                					        'default' => true
                                					      ),
					    )
					),
 			   );
?>
