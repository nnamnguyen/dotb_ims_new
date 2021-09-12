<?php



global $current_user;

$dashletData['MyReportsDashlet']['searchFields'] = array();
                                                                                           
$dashletData['MyReportsDashlet']['columns'] = array('name' => array('width'   => '40', 
                                                                          'label'   => 'LBL_REPORT_NAME',
                                                                          'customCode'    => '<span id="obj_{$ID}"><a  href="index.php?action=ReportCriteriaResults&module=Reports&page=report&id={$ID}">{$NAME}</a></span>',
                                                                          'default' => true 
                                                                          ), 
                                                          'module' => array('width'  => '30', 
                                                                            'label'   => 'LBL_MODULE',
                                                                             'default' => true),
                                                          'report_type_trans' => array(
                                                                'width' => '30',
                                                                'label' => 'LBL_REPORT_TYPE',
                                                                'default' => true,
                                                                'orderBy' => 'report_type',
                                                                'related_fields' => array('report_type'),
                                                                ),
                                                           );
?>
