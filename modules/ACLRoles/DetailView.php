<?php


    global $dictionary;

    $dotb_smarty = new Dotb_Smarty();
    $dotb_smarty->assign('MOD', $mod_strings);
    $dotb_smarty->assign('APP', $app_strings);

    $dotb_smarty->assign('APP_LIST', $app_list_strings);
    $role = BeanFactory::getBean('ACLRoles', $_REQUEST['record']);
    $categories = ACLRole::getRoleActions($_REQUEST['record']);
    $names = ACLAction::setupCategoriesMatrix($categories);

    // Skipping modules that have 'hidden_to_role_assignment' property
    $hidden_categories = array(
        "Campaigns",
        "EmailTemplates",
        "EmailMarketing",
        "Forecasts",
        "PdfManager",
        "Reports",
        "ReportSchedules",
//        //hide_fields_to_edit_role - EDU module   - By Lap Nguyen
//        "C_Attendance",
    );
    //hide_fields_to_edit_role - EDU module   -Added By Lap Nguyen
    $hidden_modules = array(
        "Bugs",
        "C_AdminConfig",
        "C_Gallery",
        "C_GalleryDetail",
        "C_SMS",
        "CJ_Forms",
        "CJ_WebHooks",
        "Contracts",
        "DRI_SubWorkflow_Templates",
        "DRI_SubWorkflows",
        "DRI_Workflow_Task_Templates",
        "DRI_Workflow_Templates",
        "DRI_Workflows",
        "DataPrivacy",
        "Forecasts",
        "J_GradebookDetail",
        "J_Inventorydetail",
        "KBArticles",
        "KBContents",
        "KBContentTemplates",
        "RT_DotbBoards",
        "C_Attendance",
        "C_Carryforward",
        "ProjectTask",
        "Project",
        "Products",
        "Quotes",
        "RevenueLineItems",
        "Trackers",
        "TrackerQueries",
        "TrackerSessions",
        "fte_UsageTracking",
        "TrackerPerfs",
        "Opportunities",
        "PdfManager",
        "Tags",
        "Users",
        "WebLogicHooks",
    );
    foreach ($categories as $name => $category) {
        $objName = BeanFactory::getObjectName($name) ?: $name;
        if (in_array($name, $hidden_modules)) {
            unset($categories[$name]);
            $hidden_categories[] = $name;
        }
    }
    //hide_fields_to_edit_role - EDU module   -Added By Lap Nguyen

    foreach ($categories as $name => $category) {
        $objName = BeanFactory::getObjectName($name) ?: $name;
        if (isset($dictionary[$objName])) {
            if (!empty($dictionary[$objName]['hidden_to_role_assignment'])) {
                unset($categories[$name]);
            }
            if (!empty($dictionary[$objName]['hide_fields_to_edit_role'])) {
                $hidden_categories[] = $name;
            }
        }
    }

    $categories2=$categories;
    foreach($hidden_categories as $v){
        if (isset($categories2[$v])) {
            unset($categories2[$v]);
        }
    }
    $dotb_smarty->assign('CATEGORIES2', $categories2);
    if(!empty($names))$tdwidth = 100 / sizeof($names);
    $dotb_smarty->assign('ROLE', $role->toArray());
    $dotb_smarty->assign('CATEGORIES', $categories);
    $dotb_smarty->assign('TDWIDTH', $tdwidth);
    $dotb_smarty->assign('ACTION_NAMES', $names);

    $return= array('module'=>'ACLRoles', 'action'=>'DetailView', 'record'=>$role->id);
    $dotb_smarty->assign('RETURN', $return);
    $params = array();
    $params[] = "<a href='index.php?module=ACLRoles&action=index'>{$mod_strings['LBL_MODULE_NAME']}</a>";
    $params[] = $role->get_summary_text();
    echo getClassicModuleTitle("ACLRoles", $params, true);
    $hide_hide_supanels = true;

    echo $dotb_smarty->fetch('modules/ACLRoles/DetailView.tpl');
    //for subpanels the variable must be named focus;
    $focus =& $role;
    $_REQUEST['module'] = 'ACLRoles';

    $subpanel = new SubPanelTiles($role, 'ACLRoles');

    echo $subpanel->display();



?>
