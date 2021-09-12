<?php
/*
 * Your installation or use of this DotbCRM file is subject to the applicable
 * terms available at
 * http://support.dotbcrm.com/Resources/Master_Subscription_Agreements/.
 * If you do not agree to all of the applicable terms or do not have the
 * authority to bind the entity as an authorized representative, then do not
 * install or use this DotbCRM file.
 *
 * Copyright (C) DotbCRM Inc. All rights reserved.
 */

$viewdefs['base']['layout']['records']['components'][0]['layout']['components'][0]['layout']['components'][1]['layout']['availableToggles'][] =  array(
    'name' => 'rtDotbBoards',
    'icon' => 'fa-columns',
    'label' => 'LBL_SB_DOTB_BOARDS',
);

$viewdefs['base']['layout']['records']['components'][0]['layout']['components'][0]['layout']['components'][1]['layout']['components'][] = array(
    'layout' => 'rtDotbBoards',
);
