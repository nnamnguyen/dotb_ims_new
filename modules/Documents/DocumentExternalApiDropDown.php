<?php

function getDocumentsExternalApiDropDown($focus = null, $name = null, $value = null, $view = null) {

    $apiList = ExternalAPIFactory::getModuleDropDown('Documents');

    $apiList = array_merge(array('Dotb'=>$GLOBALS['app_list_strings']['eapm_list']['Dotb']),$apiList);
    if(!empty($value) && empty($apiList[$value])){
        $apiList[$value] = $value;
    }
    return $apiList;

}
 
