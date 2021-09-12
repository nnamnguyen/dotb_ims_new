<?php

/*
 * bug 59290 - this file was reverted, comment left so upgrader picks up the modified file - rbacon
 */
  $searchdefs['Teams'] = array(
					'templateMeta' => array(
							'maxColumns' => '3', 
                            'maxColumnsBasic' => '4', 
                            'widths' => array('label' => '10', 'field' => '30'),                 
                           ),
                    'layout' => array(  					
						'basic_search' => array(
						    'name' => array('name' => 'name', 'label' => 'LBL_NAME',),
						 	),
						'advanced_search' => array(),
					),
 			   );
?>
