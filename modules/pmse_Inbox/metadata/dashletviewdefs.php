<?php


global $current_user;

$dashletData['pmse_InboxDashlet']['searchFields'] = array('date_entered'     => array('default' => ''),
                                                          'date_modified'    => array('default' => ''),
                                                          'cas_due_date'     => array('default' => ''),
                                                          'team_id'          => array('default' => ''),
                                                          'assigned_user_id' => array('type'    => 'assigned_user_name', 
                                                                                      'default' => $current_user->name));
$dashletData['pmse_InboxDashlet']['columns'] =  array(   'name' => array('width'   => '40', 
                                                                      'label'   => 'LBL_LIST_NAME',
                                                                      'link'    => true,
                                                                      'default' => true),
                                                      'date_entered' => array('width'   => '15',
                                                                              'label'   => 'LBL_DATE_ENTERED',
                                                                              'default' => true),
                                                      'date_modified' => array('width'   => '15', 
                                                                              'label'   => 'LBL_DATE_MODIFIED'),
                                                      'cas_due_date' => array('width'   => '15',
                                                                              'label'   => 'LBL_DUE_DATE',
                                                                              'default' => true),
                                                      'created_by' => array('width'   => '8',
                                                                            'label'   => 'LBL_CREATED'),
                                                      'assigned_user_name' => array('width'   => '8', 
                                                                                     'label'   => 'LBL_LIST_ASSIGNED_USER'),
                                                      'team_name' => array('width'   => '15', 
                                                                           'label'   => 'LBL_LIST_TEAM'),
                                               );