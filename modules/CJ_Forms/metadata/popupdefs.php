<?php

$module_name = 'CJ_Form';
$table_name = 'cj_forms';
$popupMeta = array (
    'moduleMain' => $module_name,
    'varName' => $module_name,
    'orderBy' => 'name',
    'whereClauses' => array ('name' => $table_name . '.name'),
    'searchInputs' => array ('name'),
);
