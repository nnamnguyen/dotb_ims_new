<?php



/**
 * Define the after_delete hook that will resave the related worksheet if forecasts is setup
 */
$hook_array['after_delete'][] = array(
    1,
    'saveworksheet',
    'modules/Opportunities/OpportunityHooks.php',
    'OpportunityHooks',
    'saveWorksheet',
);

/**
 * Before we delete an Opp, delete all the RLI's
 */
$hook_array['before_delete'][] = array(
    1,
    'deleteRLI',
    'modules/Opportunities/OpportunityHooks.php',
    'OpportunityHooks',
    'deleteOpportunityRevenueLineItems',
);
