<?php

$dictionary['CJ_WebHook'] = array (
    'table' => 'cj_web_hooks',
    'audited' => true,
    'unified_search' => false,
    'duplicate_merge' => true,
    'activity_enabled' => false,
    'comment' => 'CJ_WebHook',
    'fields' => array (),
    'relationships' => array (),
    'optimistic_lock' => true,
);

VardefManager::createVardef('CJ_WebHooks', 'CJ_WebHook', array (
    'basic',
    'team_security',
));
