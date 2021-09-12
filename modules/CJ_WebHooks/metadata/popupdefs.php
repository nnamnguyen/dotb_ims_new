<?php

$module_name = 'CJ_WebHook';
$table_name = 'cj_web_hooks';
$popupMeta = array (
    'moduleMain' => $module_name,
    'varName' => $module_name,
    'orderBy' => 'name',
    'whereClauses' => array ('name' => $table_name . '.name'),
    'searchInputs' => array ('name'),
);
