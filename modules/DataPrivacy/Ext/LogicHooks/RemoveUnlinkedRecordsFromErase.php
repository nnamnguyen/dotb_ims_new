<?php


/**
 * Reset the date_modified so we have the seconds on it
 */
$hook_array['after_relationship_delete'][] = array(
    1,
    'unlinkRecordsFromErase',
    'modules/DataPrivacy/DataPrivacyHooks.php',
    'DataPrivacyHooks',
    'unlinkRecordsFromErase',
);
