<?php


/**
 * Reset the date_modified so we have the seconds on it
 */
$hook_array['process_record'][] = array(
    1,
    'fixDateModified',
    'modules/ForecastWorksheets/ForecastWorksheetHooks.php',
    'ForecastWorksheetHooks',
    'fixDateModified',
);

$hook_array['after_retrieve'][] = array(
    1,
    'fixDateModified',
    'modules/ForecastWorksheets/ForecastWorksheetHooks.php',
    'ForecastWorksheetHooks',
    'fixDateModified',
);
