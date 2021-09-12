<?php



// Full text search.
$hook_array['before_save'][] = array(
    1,
    'manager_worksheet_quota_only_save',
    'modules/ForecastManagerWorksheets/ForecastManagerWorksheetHooks.php',
    'ForecastManagerWorksheetHooks',
    'draftRecordQuotaOnlyCheck'
);
