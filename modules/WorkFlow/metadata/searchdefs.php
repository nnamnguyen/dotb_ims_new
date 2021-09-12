<?php

  $searchdefs['WorkFlow'] = array(
					'templateMeta' => array(
							'maxColumns' => '3', 'maxColumnsBasic' => '4',
                            'widths' => array('label' => '10', 'field' => '30'),
                           ),
                    'layout' => array(
						'basic_search' => array(
						    'name' => array('name' => 'name', 'label' => 'LBL_NAME',),
						 	),
						'advanced_search' => array(
						    'name' => array('name' => 'name', 'label' => 'LBL_NAME',),
						    'base_module' =>
                              array (
                                'name' => 'base_module',
                                'type' => 'enum',
                                'label' => 'LBL_BASE_MODULE',
                                'function' =>
                                array (
                                  'name' => 'get_module_map',
                                  'params' =>
                                  array (
                                    0 => false,
                                  ),
                                ),
                                'default' => true,
                                'width' => '10%',
                              ),
						 	),
					),
 			   );
?>
