<?php
$hook_version = 1;
$hook_array = array();
$hook_array['before_save'] = array();
$hook_array['before_save'][] = array(1, 'Auto generate lead', 'custom/modules/Contacts/logicContact.php', 'logicContact', 'generateContact');
