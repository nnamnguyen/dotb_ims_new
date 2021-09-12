<?php


/**
 * Resave RLI bean after the account_link relationship is removed. This will cause the RLI to pick up
 * the account from it's associated Opportunity through dotblogic
 */
$hook_array['after_relationship_delete'][] = array(
    1,
    'afterRelationshipDelete',
    'modules/RevenueLineItems/RevenueLineItemHooks.php',
    'RevenueLineItemHooks',
    'afterRelationshipDelete',
);
