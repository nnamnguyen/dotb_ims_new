<?php


/**
 * Define the after_save hook that will sync the opportunity the related worksheet if forecasts is setup
 */
$hook_array['after_save'][] = array(
    1,
    'saveworksheet',
    'modules/Opportunities/OpportunityHooks.php',
    'OpportunityHooks',
    'saveWorksheet',
);
