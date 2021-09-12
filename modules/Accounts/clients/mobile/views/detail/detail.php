<?php


/*********************************************************************************
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/
 
$viewdefs['Accounts']['mobile']['view']['detail'] = array(
	'templateMeta' => array(
                            'maxColumns' => '1', 
                            'widths' => array(
								array('label' => '10', 'field' => '30'), 
                            ),                                  
                           ),
    'panels' => array(
        array(
            'label' => 'LBL_PANEL_DEFAULT',
            'fields' => array(
                array(
                    'name'=>'name',
                    'displayParams'=>array(
                        'required'=>true,
                        'wireless_edit_only'=>true,
                    ),
                ),
                'phone_office',
                array(
                    'name'=>'website',
                    'displayParams'=>array(
                        'type'=>'link',
                    ),
                ),
                'email',
                'billing_address_street',
                'billing_address_city',
                'billing_address_state',
                'billing_address_postalcode',
                'billing_address_country',
                'shipping_address_street',
                'shipping_address_city',
                'shipping_address_state',
                'shipping_address_postalcode',
                'shipping_address_country',
                'assigned_user_name',
                'team_name',
            ),
        ),
	),
);
