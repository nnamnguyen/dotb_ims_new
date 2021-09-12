<?php

/*
* Your installation or use of this DotBCRM file is subject to the applicable
* terms available at
* http://support.dotbcrm.com/06_Customer_Center/10_Master_Subscription_Agreements/.
* If you do not agree to all of the applicable terms or do not have the
* authority to bind the entity as an authorized representative, then do not
* install or use this DotBCRM file.
*
* Copyright (C) DotBCRM Inc. All rights reserved.
*
* @package FTE Usage Tracking
*/

$viewdefs['base']['view']['custom-config-header'] = array(
    'buttons' => array(
        array(
            'name'    => 'cancel_button',
            'type'    => 'button',
            'label'   => 'LBL_CANCEL_BUTTON_LABEL',
            'css_class' => 'btn-invisible btn-link',
            'events'=> ["click"=>"cancel_config"]
        ),
        array(
            'type' => 'actiondropdown',
            'name' => 'main_dropdown',
            'primary' => true,
            'buttons' => array(
                array(
                    'type' => 'rowaction',
                    'name' => 'save_button',
                    'label' => 'LBL_SAVE_BUTTON_LABEL',
                    'events'=>["click"=>"save_config"]
                ),
            ),
        ),
        array(
            'name' => 'sidebar_toggle',
            'type' => 'sidebartoggle',
        ),
    ),
);