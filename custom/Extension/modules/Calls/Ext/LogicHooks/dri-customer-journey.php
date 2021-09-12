<?php

$hook_array['before_save'][] = array (
    0,
    'DRI_Workflow_Task_Templates_Activity_ActivityHooks::saveFetchedRow',
    'modules/DRI_Workflow_Task_Templates/Activity/ActivityHooks.php',
    'DRI_Workflow_Task_Templates_Activity_ActivityHooks',
    'saveFetchedRow'
);

$hook_array['before_save'][] = array (
    1,
    'DRI_Workflow_Task_Templates_Activity_ActivityHooks::reorder',
    'modules/DRI_Workflow_Task_Templates/Activity/ActivityHooks.php',
    'DRI_Workflow_Task_Templates_Activity_ActivityHooks',
    'reorder'
);

$hook_array['before_save'][] = array (
    2,
    'DRI_Workflow_Task_Templates_Activity_ActivityHooks::calculate',
    'modules/DRI_Workflow_Task_Templates/Activity/ActivityHooks.php',
    'DRI_Workflow_Task_Templates_Activity_ActivityHooks',
    'calculate'
);

$hook_array['before_save'][] = array (
    3,
    'DRI_Workflow_Task_Templates_Activity_ActivityHooks::calculateMomentum',
    'modules/DRI_Workflow_Task_Templates/Activity/ActivityHooks.php',
    'DRI_Workflow_Task_Templates_Activity_ActivityHooks',
    'calculateMomentum'
);

$hook_array['before_save'][] = array (
    4,
    'DRI_Workflow_Task_Templates_Activity_ActivityHooks::validate',
    'modules/DRI_Workflow_Task_Templates/Activity/ActivityHooks.php',
    'DRI_Workflow_Task_Templates_Activity_ActivityHooks',
    'validate'
);

$hook_array['before_save'][] = array (
    5,
    'DRI_Workflow_Task_Templates_Activity_ActivityHooks::beforeStatusChange',
    'modules/DRI_Workflow_Task_Templates/Activity/ActivityHooks.php',
    'DRI_Workflow_Task_Templates_Activity_ActivityHooks',
    'beforeStatusChange'
);

$hook_array['before_save'][] = array (
    6,
    'DRI_Workflow_Task_Templates_Activity_ActivityHooks::beforeStatusChange',
    'modules/DRI_Workflow_Task_Templates/Activity/ActivityHooks.php',
    'DRI_Workflow_Task_Templates_Activity_ActivityHooks',
    'setActualSortOrder'
);

$hook_array['after_save'][] = array (
    50,
    'DRI_Workflow_Task_Templates_Activity_ActivityHooks::resaveIfChanged',
    'modules/DRI_Workflow_Task_Templates/Activity/ActivityHooks.php',
    'DRI_Workflow_Task_Templates_Activity_ActivityHooks',
    'resaveIfChanged'
);

$hook_array['after_delete'][] = array (
    50,
    'DRI_Workflow_Task_Templates_Activity_ActivityHooks::resave',
    'modules/DRI_Workflow_Task_Templates/Activity/ActivityHooks.php',
    'DRI_Workflow_Task_Templates_Activity_ActivityHooks',
    'resave'
);

$hook_array['before_delete'][] = array (
    1,
    'DRI_Workflow_Task_Templates_Activity_ActivityHooks::beforeDelete',
    'modules/DRI_Workflow_Task_Templates/Activity/ActivityHooks.php',
    'DRI_Workflow_Task_Templates_Activity_ActivityHooks',
    'beforeDelete'
);

$hook_array['before_delete'][] = array (
    2,
    'DRI_Workflow_Task_Templates_Activity_ActivityHooks::removeChildren',
    'modules/DRI_Workflow_Task_Templates/Activity/ActivityHooks.php',
    'DRI_Workflow_Task_Templates_Activity_ActivityHooks',
    'removeChildren'
);

$hook_array['after_delete'][] = array (
    1,
    'DRI_Workflow_Task_Templates_Activity_ActivityHooks::afterDelete',
    'modules/DRI_Workflow_Task_Templates/Activity/ActivityHooks.php',
    'DRI_Workflow_Task_Templates_Activity_ActivityHooks',
    'afterDelete'
);
