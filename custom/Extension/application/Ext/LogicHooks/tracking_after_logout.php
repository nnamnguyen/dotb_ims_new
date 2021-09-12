<?php

$hook_array['after_logout'] = Array();
$hook_array['after_logout'][] = Array(
    //Processing index. For sorting the array.
    1,

    //Label. A string value to identify the hook.
    'after_logout tracking event',

    'custom/AfterSaveTrackingHook.php',
    'AfterSaveTrackingHook',
    'logAction'
);