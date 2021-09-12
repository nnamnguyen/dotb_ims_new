<?php
 if(!defined('dotbEntry') || !dotbEntry) die('Not A Valid Entry Point');


// Full text search.

$pmseHookClassPath = DotbAutoLoader::requireWithCustom('modules/pmse_Inbox/engine/PMSELogicHook.php');
$pmseHookClassName = DotbAutoLoader::customClass('PMSELogicHook');
$hook_array['after_save'][] = array(
    100,
    'pmse',
    $pmseHookClassPath,
    $pmseHookClassName,
    'after_save'
);
$hook_array['after_delete'][] = array(
    100,
    'pmse',
    $pmseHookClassPath,
    $pmseHookClassName,
    'after_delete'
);
//remove unnecessary globals
unset($pmseHookClassPath);
unset($pmseHookClassName);
