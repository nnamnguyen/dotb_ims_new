<?php



global $current_user;

$dashletData['DotbFavoritesDashlet']['searchFields'] = array();
$dashletData['DotbFavoritesDashlet']['columns'] =  array(   
                                                    'record_name' => array('width' => '29', 
                                                                         'label' => 'LBL_LIST_NAME',
                                                                         'sortable' => false,
                                                                         'dynamic_module' => 'MODULE',
                                                                         'link' => true,
                                                                         'id' => 'RECORD_ID',
                                                                         'ACLTag' => 'RECORD_NAME',
                                                                         'related_fields' => array('record_id', 'module'),
																		 'default' => true,
																		),
													
                                                      'module' => array('width'   => '15', 
                                                                              'label'   => 'LBL_LIST_MODULE',
                                                                              'default' => true),
                                                      'date_entered' => array('width'   => '15', 
                                                                              'label'   => 'LBL_DATE_ENTERED',
                                                                              'default' => true),
                                               );