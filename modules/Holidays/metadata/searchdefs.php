<?php
if(!defined('dotbEntry') || !dotbEntry) die('Not A Valid Entry Point');

$searchdefs['Holidays'] = array(
            'templateMeta' => array(
                    'maxColumns' => '2',  'maxColumnsBasic' => '2', 
                    'widths' => array('label' => '10', 'field' => '30'),                 
                   ),
            'layout' => array(                      
                'basic_search' => array(
                    'holiday_date',
                    
                 
                ),
                'advanced_search' => array(
                    'holiday_date',
                    'type',
                ),                                              
            ),
);
    
?>
