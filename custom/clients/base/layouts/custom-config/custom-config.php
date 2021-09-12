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

$viewdefs['base']['layout']['custom-config'] = array(
    'components' => array(
        array(
            'layout' => array(
                'type' => 'default',
                'name' => 'sidebar',
                'components' => array(
                    array(
                        'layout' => array(
                            'type' => 'base',
                            'name' => 'main-pane',
                            "css_class"=>"main-pane span8",
                            'components' => array(
                                array(
                                    'view' => 'custom-config-header',
                                ),
                                array(
                                    'view' => 'custom-config',
                                ),
                            ),
                        ),
                    ),
                    array(
                        'layout' => array(
                            'type' => 'base',
                            'name' => 'side-pane',
                            'components' => array(
                                array(
                                    'view' => '',
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
    )
);
