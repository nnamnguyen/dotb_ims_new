<?php


/**
 * Before we save an opp, check if we need to set the commit stage
 */
$hook_array['before_save'][] = array(
    10,
    'beforeSaveIncludedCheck',
    'modules/Opportunities/OpportunityHooks.php',
    'OpportunityHooks',
    'beforeSaveIncludedCheck',
);
