<?php

$hook_array['after_login'] = Array();
$hook_array['after_login'][] = Array(
    //Processing index. For sorting the array.
    1,

    //Label. A string value to identify the hook.
    'after_login tracking event',

    'custom/AfterSaveTrackingHook.php',
    'AfterSaveTrackingHook',
    'logAction'
);