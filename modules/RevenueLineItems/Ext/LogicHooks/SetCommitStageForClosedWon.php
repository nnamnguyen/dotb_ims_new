<?php


/**
 * Before we save an rli, check if we need to set the commit stage
 */
$hook_array['before_save'][] = array(
    10,
    'beforeSaveIncludedCheck',
    'modules/RevenueLineItems/RevenueLineItemHooks.php',
    'RevenueLineItemHooks',
    'beforeSaveIncludedCheck',
);
