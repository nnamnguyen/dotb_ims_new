<?php
$hook_version = 1;
$hook_array = array();
$hook_array['before_save'] = array();
$hook_array['before_save'][] = array(1, 'Auto generate target', 'custom/modules/Leads/logicLead.php', 'logicLead', 'generateTarget');
$hook_array['before_save'][] = array(2, 'Handle before save', 'custom/modules/Leads/logicLead.php', 'logicLead', 'handleBeforeSave');
