<?php


/**
 * Initiate the Activity Stream erasure process if DataPrivacy status transitions to Closed
 */
$hook_array['after_save'][] = array(
    1,
    'performActivityStreamErasure',
    'modules/DataPrivacy/DataPrivacyHooks.php',
    'DataPrivacyHooks',
    'performActivityStreamErasure',
);
