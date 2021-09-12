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
 */
$viewdefs['ops_Backups']['base']['view']['config-notifications'] = array(
    'label' => 'LBL_NOTIFICATIONS_CONFIG_TITLE',
    'panels' => array(
        array(
            'fields' => array(
                array(
                    'name' =>'notification_emails',
                    'type' => 'email',
                    'label' => 'LBL_NOTIFICATION_EMAILS',
                    'view' => 'edit',
                    'enabled' => true,
                    'link' => 'email_addresses_primary',
                    'module' => 'EmailAddresses',
                    'action' => 'edit',
                    'tplName' => 'edit',
                    'span' => 6
                ),
            ),
        ),
    ),
);
