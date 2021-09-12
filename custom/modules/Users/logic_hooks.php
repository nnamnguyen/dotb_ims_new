<?php
$hook_version = 1;

$hook_array['before_save'][] = array(1, 'check license', 'custom/modules/Users/logicUser.php', 'logicUser', 'checkLicense',);