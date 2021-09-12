<?php


/**
 * Reset the date_modified so we have the seconds on it
 */
$hook_array['before_save'][] = array(
    1,
    'setManagerSavedFlag',
    'modules/ForecastManagerWorksheets/ForecastManagerWorksheetHooks.php',
    'ForecastManagerWorksheetHooks',
    'setManagerSavedFlag',
);
