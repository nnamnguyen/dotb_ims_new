<?php
if(!defined('dotbEntry') || !dotbEntry) die('Not A Valid Entry Point');


// Full text search after_save hook to update/index a bean

$hook_array['after_save'][] = array(
    1,
    'fts',
    null,
    '\\Dotbcrm\\Dotbcrm\\SearchEngine\\HookHandler',
    'indexBean',
);

$hook_array['after_delete'][] = array(
    1,
    'fts',
    null,
    '\\Dotbcrm\\Dotbcrm\\SearchEngine\\HookHandler',
    'indexBean',
);

$hook_array['after_restore'][] = array(
    1,
    'fts',
    null,
    '\\Dotbcrm\\Dotbcrm\\SearchEngine\\HookHandler',
    'indexBean',
);
