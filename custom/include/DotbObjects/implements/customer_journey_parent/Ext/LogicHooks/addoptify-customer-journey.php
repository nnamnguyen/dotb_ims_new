<?php

$hook_array['before_save'][] = array (
    1,
    'DRI_Workflows_LogicHook_ParentHook::saveFetchedRow',
    'modules/DRI_Workflows/LogicHook/ParentHook.php',
    'DRI_Workflows_LogicHook_ParentHook',
    'saveFetchedRow'
);

$hook_array['after_save'][] = array (
    1,
    'DRI_Workflows_LogicHook_ParentHook::startJourney',
    'modules/DRI_Workflows/LogicHook/ParentHook.php',
    'DRI_Workflows_LogicHook_ParentHook',
    'startJourney'
);

$hook_array['after_save'][] = array (
    1,
    'DRI_Workflows_LogicHook_ParentHook::startJourney',
    'modules/DRI_Workflows/LogicHook/ParentHook.php',
    'DRI_Workflows_LogicHook_ParentHook',
    'updateActivityDates'
);
