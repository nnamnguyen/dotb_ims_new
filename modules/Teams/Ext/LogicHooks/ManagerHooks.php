<?php


$hook_array['before_relationship_add'][] = array(
    1,
    'AddManagerToTeam',
    'modules/Teams/TeamHooks.php',
    'TeamHooks',
    'addManagerToTeam',
);
$hook_array['after_relationship_delete'][] = array(
    2,
    'RemoveManagerFromTeam',
    'modules/Teams/TeamHooks.php',
    'TeamHooks',
    'removeManagerFromTeam',
);

/**
 * Added by HP
 * To remove Private team in selection-list view
 */
$hook_array['before_filter'][] = array(
    3,
    'RemovePrivateTeam',
    'modules/Teams/TeamHooks.php',
    'TeamHooks',
    'removePrivateTeam',
);
