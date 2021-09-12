<?php




global $current_user;

if(!empty($_REQUEST['layout']) && !empty($_REQUEST['layoutModule'])) {
//    sleep (2);
//  _ppd($_REQUEST['layout']); 
    $subpanels = explode(',', $_REQUEST['layout']);
    
    $layoutParam = $_REQUEST['layoutModule'];
    
    if(!empty($_REQUEST['layoutGroup']) && $_REQUEST['layoutGroup']!= translate('LBL_MODULE_ALL')) {
    	$layoutParam .= ':'.$_REQUEST['layoutGroup'];
    }
    
    $current_user->setPreference('subpanelLayout', $subpanels, 0, $layoutParam);
}
else {
    echo 'oops';
}

?>