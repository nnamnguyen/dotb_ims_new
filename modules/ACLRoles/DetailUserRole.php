<?php




global $app_list_strings, $app_strings, $current_user;

$mod_strings = return_module_language($GLOBALS['current_language'], 'Users');

$focus = BeanFactory::getBean('Users', $_REQUEST['record']);
if ( !is_admin($focus) ) {
    $dotb_smarty = new Dotb_Smarty();
    $dotb_smarty->assign('MOD', $mod_strings);
    $dotb_smarty->assign('APP', $app_strings);
    $dotb_smarty->assign('APP_LIST', $app_list_strings);
    
    $categories = ACLAction::getUserActions($_REQUEST['record'],true);
    
    //clear out any removed tabs from user display
    if(!$GLOBALS['current_user']->isAdminForModule('Users')){
        $tabs = $focus->getPreference('display_tabs');
        global $modInvisList;
        if(!empty($tabs)){
            foreach($categories as $key=>$value){
                if(!in_array($key, $tabs) &&  !in_array($key, $modInvisList) ){
                    unset($categories[$key]);
                    
                }
            }
            
        }
    }
    
    $names = array();
    $names = ACLAction::setupCategoriesMatrix($categories);
    if(!empty($names))$tdwidth = 100 / sizeof($names);
    $dotb_smarty->assign('APP', $app_list_strings);
    $dotb_smarty->assign('CATEGORIES', $categories);
    $dotb_smarty->assign('TDWIDTH', $tdwidth);
    $dotb_smarty->assign('ACTION_NAMES', $names);
    
    $title = getClassicModuleTitle( '',array($mod_strings['LBL_MODULE_NAME'],$mod_strings['LBL_ROLES_SUBPANEL_TITLE']), '');
    
    $dotb_smarty->assign('TITLE', $title);
    $dotb_smarty->assign('USER_ID', $focus->id);
    $dotb_smarty->assign('LAYOUT_DEF_KEY', 'UserRoles');
    echo $dotb_smarty->fetch('modules/ACLRoles/DetailViewUser.tpl');
    
    
    //this gets its layout_defs.php file from the user not from ACLRoles so look in modules/Users for the layout defs
    $modules_exempt_from_availability_check=array('Users'=>'Users','ACLRoles'=>'ACLRoles',);
    $subpanel = new SubPanelTiles($focus, 'UserRoles');
    
    echo $subpanel->display(true,true);
}
if ( empty($hideTeams) ) {
    $focus_list =$focus->get_my_teams(TRUE);
    
    // My Teams subpanel should not be displayed for group and portal users
    if(!($focus->is_group=='1' || $focus->portal_only=='1')){
        include('modules/Teams/SubPanelViewUsers.php');
        $SubPanel = new SubPanelViewUsers();
        $SubPanel->setFocus($focus);
        $SubPanel->setTeamsList($focus_list);
        $SubPanel->ProcessSubPanelListView("modules/Teams/SubPanelViewUsers.html", $mod_strings, 'DetailView');
    }
}