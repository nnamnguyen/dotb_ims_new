<?php

/*
 * Your installation or use of this DotBCRM file is subject to the applicable
 * terms available at
 * http://support.dotbcrm.com/Resources/Master_Subscription_Agreements/.
 * If you do not agree to all of the applicable terms or do not have the
 * authority to bind the entity as an authorized representative, then do not
 * install or use this DotBCRM file.
 *
 * Copyright (C) DotBCRM Inc. All rights reserved.
 *
 * This file is part of the 'Goto data' module.
 * Author: Olivier Nepomiachty DotBCRM - DotbLabs
 */

$viewdefs['base']['view']['gotodata'] = array(
    'dashlets' => array(
        array(
            'label' => 'Go to data',
            'description' => 'Point to the go to data',
            'config' => array(
            ),
            'preview' => array(
            ),
            'filter' => array(
                'module' => array(
                    'Home',
                ),
            ),
        ),
    ),

);
