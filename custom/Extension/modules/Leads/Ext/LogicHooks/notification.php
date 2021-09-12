<?php

$hook_array['before_save'][] = array (
    1,
    'LogicHook_Notification::createNotification',
    'custom/modules/Notifications/LogicHook/Notification.php',
    'LogicHook_Notification',
    'createNotification'
);

$hook_array['after_delete'][] = array (
    2,
    'LogicHook_Notification::deleteNotification',
    'custom/modules/Notifications/LogicHook/Notification.php',
    'LogicHook_Notification',
    'deleteNotification'
);



