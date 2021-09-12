<?php
$hook_version = 1;
$hook_array = Array();
$hook_array['before_save'] = Array();
$hook_array['before_save'][] = Array(1, 'Before Save', 'custom/modules/C_SMS/logicSMS.php', 'logicSMS', 'before_save_SMS');