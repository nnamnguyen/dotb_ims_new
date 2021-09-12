<?php


global $current_user;

if(!empty($_REQUEST['target_module']) && !empty($_REQUEST['target_id'])) {
    $objects = $current_user->getPreference('objects', 'favorites');
    if(!is_array($objects)) $objects = array();
    if(empty($objects[$_REQUEST['target_module']])) $objects[$_REQUEST['target_module']] = array();
    $objects[$_REQUEST['target_module']][$_REQUEST['target_id']] = true;
    
    $current_user->setPreference('objects', $objects, 0, 'favorites');
    
    echo 1;
}
else {
    echo 0;
}
?>
