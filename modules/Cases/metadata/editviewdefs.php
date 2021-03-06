<?php



    $viewdefs['Cases']['EditView'] = array(
        'templateMeta' => array('maxColumns' => '2',
            'widths' => array(
                array('label' => '10', 'field' => '30'),
                array('label' => '10', 'field' => '30')
            ),
        ),
        'panels' => array (

            'lbl_case_information' =>
            array(
                array (
                    array('name'=>'case_number', 'type'=>'readonly') ,
                ),

                array (
                    'priority',
                ),

                array (
                    'status',
                    'account_name',
                ),

                array (
                    'type',
                    'source',
                ),
                array (
                    array (
                        'name' => 'name',
                        'displayParams' => array ('size'=>75)
                    ),
                ),

                array (

                    array (
                        'name' => 'description',
                        'nl2br' => true,
                    ),
                ),

                array (

                    array (
                        'name' => 'resolution',
                        'nl2br' => true,
                    ),
                ),

                array(
                    array('name'=>'portal_viewable',
                        'label' => 'LBL_SHOW_IN_PORTAL',
                        'hideIf' => 'empty($PORTAL_ENABLED)',
                    ),
                )
            ),

            'LBL_PANEL_ASSIGNMENT' =>
            array(
                array (
                    'assigned_user_name',

                    array('name'=>'team_name', 'displayParams'=>array('required'=>true)),
                ),
            ),
        ),


    );
?>
