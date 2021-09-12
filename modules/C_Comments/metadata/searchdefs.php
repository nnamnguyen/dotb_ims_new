<?php

/*********************************************************************************
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/
 
 $module_name='C_Comments';
$searchdefs[$module_name] = array(
                    'templateMeta' => array('maxColumns' => '3', 'maxColumnsBasic' => '4',
                            'widths' => array('label' => '10', 'field' => '30'),
                           ),
                    'layout' => array(
                        'basic_search' => array(
                                'document_name',
                                array ('name' => 'favorites_only','label' => 'LBL_FAVORITES_FILTER','type' => 'bool',),
                            ),
                        'advanced_search' => array(
                                'document_name',
                                'category_id',
                                'subcategory_id',
                                'active_date',
                                'exp_date',
                                array ('name' => 'favorites_only','label' => 'LBL_FAVORITES_FILTER','type' => 'bool',),
                        ),
                    ),
               );
