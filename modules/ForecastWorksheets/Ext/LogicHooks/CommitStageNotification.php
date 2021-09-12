<?php


/**
 * Define the before_save hook that will notify a manager that if a "included" worksheet row gets not included
 */
$hook_array['before_save'][] = array(
    1,
    'checkCommitStage',
    'modules/ForecastWorksheets/ForecastWorksheetHooks.php',
    'ForecastWorksheetHooks',
    'managerNotifyCommitStage',
);
