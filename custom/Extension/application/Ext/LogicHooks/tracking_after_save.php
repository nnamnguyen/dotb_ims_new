<?php
/**
 * Your installation or use of this DotBCRM file is subject to the applicable
 * terms available at
 * http://support.dotbcrm.com/06_Customer_Center/10_Master_Subscription_Agreements/.
 * If you do not agree to all of the applicable terms or do not have the
 * authority to bind the entity as an authorized representative, then do not
 * install or use this DotBCRM file.
 *
 * Copyright (C) DotBCRM Inc. All rights reserved.
 *
 * @package FTE_Tracking
 */


    $hook_array['after_save'][] = Array(
        10,
        'Saves tracking actions after record save',
        'custom/AfterSaveTrackingHook.php',
        'AfterSaveTrackingHook',
        'logAction'
    );