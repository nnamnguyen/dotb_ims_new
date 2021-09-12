<?php


    require_once('modules/Reports/config.php');


    require_once('modules/Reports/templates/templates_reports.php');

    use Dotbcrm\Dotbcrm\Security\InputValidation\InputValidation;

    if (!empty($this->bean)) {
        $context = array('bean' => $this->bean);
        if (!empty($_REQUEST['save_as'])) {
            $context['owner_override'] = true;
        }
    } else {
        $context = array();
    }

    if(!DotbACL::checkAccess('Reports', 'edit', $context))
    {
        ACLController::displayNoAccess(true);
        dotb_cleanup(true);
    }
    global $current_user, $mod_strings, $ACLAllowedModules, $current_language, $app_list_strings, $app_strings, $dotb_config, $dotb_version;

    $params = array();
    $params[] = $mod_strings['LBL_CREATE_CUSTOM_REPORT'];
    echo getClassicModuleTitle("Reports", $params, false);

    $ACLAllowedModules = getACLAllowedModules();
    uksort($ACLAllowedModules,"juliansort");

    $buttons = array();

    $controller = new TabController();
    $tabs = $controller->get_user_tabs($current_user, $type='display');
    //$ACLAllowedModulesAdded = array();
    require_once('include/DotbSmarty/plugins/function.dotb_help.php');
    $dotb_smarty = new Dotb_Smarty();

    $help_img = smarty_function_dotb_help(array("text"=>$mod_strings['LBL_OPTIONAL_HELP']),$dotb_smarty);
    $chart_data_help = smarty_function_dotb_help(array("text"=>$mod_strings['LBL_CHART_DATA_HELP']),$dotb_smarty);
    $do_round_help = smarty_function_dotb_help(array("text"=>$mod_strings['LBL_DO_ROUND_HELP']),$dotb_smarty);

    // Add the modules in the order of the user-defined tabs.
    /*
    foreach ($tabs as $tabModuleKey=>$tabModuleKeyValue)
    {
    if (isset($ACLAllowedModules[$tabModuleKey])) {
    if (file_exists($image_path1."icon_".$tabModuleKey."_32.gif"))
    array_push($buttons, array('name'=>$app_list_strings['moduleList'][$tabModuleKey], 'img'=> DotbThemeRegistry::current()->getImageURL("icon_".$tabModuleKey."_32.gif"), 'key'=>$tabModuleKey));
    else
    array_push($buttons, array('name'=>$app_list_strings['moduleList'][$tabModuleKey], 'img'=> DotbThemeRegistry::current()->getImageURL("icon_A1_newmod.gif"),'alt'=> $mod_strings['LBL_NO_IMAGE'], 'key'=>$tabModuleKey));
    $ACLAllowedModulesAdded[$tabModuleKey] = 1;
    }
    }
    */
    $fullModuleList = array_merge($GLOBALS['moduleList'], $GLOBALS['modInvisList']);
    // Add the remaining modules.
    foreach ($ACLAllowedModules as $module=>$singular) {
        if (!isset($app_list_strings['moduleList'][$module]) && !in_array($module, $fullModuleList)) {
            continue;
        }
        $icon_name = _getIcon($module."_32");
        if (empty($icon_name)){
            $icon_name = _getIcon($module);
        }
        if (empty($icon_name)){
            $icon_name = "icon_A1_newmod.gif";
        }
        $buttons[] = array('name'=>$app_list_strings['moduleList'][$module], 'img'=> $icon_name, 'key'=>$module);
    }

    $user_array = get_user_array(FALSE);
$module_icons = json_decode(file_get_contents('custom/include/module_icon.json'), true);
$icons = array();
foreach ($module_icons as $k => $v) $icons[$k] = $v['src'];

    $dotb_smarty->assign("ICONS", $icons);
    $dotb_smarty->assign("MOD", $mod_strings);
    $dotb_smarty->assign("APP", $app_strings);
    $dotb_smarty->assign("LANG", $current_language);
    $dotb_smarty->assign("ACLAllowedModules", $ACLAllowedModules);
    $dotb_smarty->assign("USER_ID_MD5", md5($current_user->id));
    $dotb_smarty->assign("ENTROPY", mt_rand());
    $dotb_smarty->assign("BUTTONS", $buttons);
    $dotb_smarty->assign("IS_ADMIN", $current_user->is_admin);
    $dotb_smarty->assign("users_array", $user_array);
    $dotb_smarty->assign("help_image", $help_img);
    $dotb_smarty->assign("chart_data_help", $chart_data_help);
    $dotb_smarty->assign("do_round_help", $do_round_help);
    $dotb_smarty->assign("js_custom_version", $dotb_config['js_custom_version']);
    $dotb_smarty->assign("dotb_version", $dotb_version);

    // Set fiscal start date
    $admin = BeanFactory::newBean('Administration');
    $config = $admin->getConfigForModule('Forecasts', 'base');
    if (!empty($config['is_setup']) && !empty($config['timeperiod_start_date'])) {
        $dotb_smarty->assign("fiscalStartDate", $config['timeperiod_start_date']);
    }

    $chart_types = array(
        'none'=>$mod_strings['LBL_NO_CHART'],
        'hBarF'=>$mod_strings['LBL_HORIZ_BAR'],
        'hGBarF'=>$mod_strings['LBL_HORIZ_GBAR'],
        'vBarF'=>$mod_strings['LBL_VERT_BAR'],
        'vGBarF'=>$mod_strings['LBL_VERT_GBAR'],
        'pieF'=>$mod_strings['LBL_PIE'],
        'funnelF'=>$mod_strings['LBL_FUNNEL'],
        'lineF'=>$mod_strings['LBL_LINE'],
    );

    //$chart_description = htmlentities($reporter->chart_description, ENT_QUOTES, 'UTF-8');
    $dotb_smarty->assign('chart_types', $chart_types);
    //$dotb_smarty->assign('chart_description', $chart_description);

    $dotbChart = DotbChartFactory::getInstance();
    $resources = $dotbChart->getChartResources();
    $dotb_smarty->assign('chartResources', $resources);

    $request = InputValidation::getService();
    $runQuery = $request->getValidInputRequest('run_query');
    $saveReportAs = $request->getValidInputRequest('save_report_as');
    $saveReport = $request->getValidInputRequest('save_report');
    $id = $request->getValidInputRequest('id', 'Assert\Guid');
    $showQuery = $request->getValidInputRequest('show_query');
    $doRound = $request->getValidInputRequest('do_round');
    $reportDef = $request->getValidInputRequest('report_def');
    $panelsDef = $request->getValidInputRequest('panels_def');
    $filtersDef = $request->getValidInputRequest('filters_defs');
    $assignedUserId = $request->getValidInputRequest('assigned_user_id', 'Assert\Guid');
    $assignedUserName = $request->getValidInputRequest('assigned_user_name');
    $isDelete = $request->getValidInputRequest('is_delete');

    //Custom URL to execute Report - Lap Nguyen
    $custom_url     = $request->getValidInputRequest('custom_url');
    $is_admin_data  = $request->getValidInputRequest('is_admin_data');
    $row_number     = $request->getValidInputRequest('row_number');
    $json_query     = $_REQUEST['json_query'];

    if($custom_url !== null) $dotb_smarty->assign("custom_url", $custom_url);
    if($is_admin_data !== null) $dotb_smarty->assign("is_admin_data", $is_admin_data);
    if($row_number !== null)  $dotb_smarty->assign("row_number", $row_number);
    $dotb_smarty->assign("user_id", $current_user->id);
    $dotb_smarty->assign("description", $request->getValidInputRequest('description'));
    $is_admin_data_help = smarty_function_dotb_help(array("text"=>$mod_strings['LBL_IS_ADMIN_DATA_HELP']),$dotb_smarty);
    $dotb_smarty->assign("is_admin_data_help", $is_admin_data_help);
    $dotb_smarty->assign("list_of_arr", get_select_options_with_id($app_list_strings['report_list_list'], (empty($_REQUEST['list_of']) ? '' : $_REQUEST['list_of'])));

    if(!empty($json_query)){
        $report_seed = '';
        if(!empty($id)){
            $report_seed = BeanFactory::newBean('Reports');
            $report_seed->disable_row_level_security = true;
            $report_seed->retrieve($id, false);
        }
        $html_tpl   = getHtmlAddRow('',true, $report_seed);
        $jsonQs   = array_filter(array_map("html_entity_decode", $json_query));
        if(empty($jsonQs))
            $html_tpl   .= getHtmlAddRow('',false, $report_seed);
        else
            foreach($jsonQs as $key => $jsonQ)
                $html_tpl   .= getHtmlAddRow($jsonQ,false, $report_seed);
        $dotb_smarty->assign('html_tpl',$html_tpl);
    }
    //END - By Lap Nguyen


    if ($runQuery == 1)
        $dotb_smarty->assign("RUN_QUERY", '1');
    else
        $dotb_smarty->assign("RUN_QUERY", '0');

    if ($saveReportAs !== null)
        $dotb_smarty->assign("save_report_as", $saveReportAs);
    else
        $dotb_smarty->assign("save_report_as", "");

    if ($id !== null)
        $dotb_smarty->assign("id", $id);

    if ($showQuery !== null)
        $dotb_smarty->assign("show_query", $showQuery);

    if ($doRound !== null)
        $dotb_smarty->assign("do_round", $doRound);


    js_setup($dotb_smarty);

    if ($runQuery == 1) {
        $args = array();
        $report_def = array();
        if ($reportDef !== null) {
            $report_def = html_entity_decode($reportDef, ENT_QUOTES, 'UTF-8');
            $panels_def = html_entity_decode($panelsDef, ENT_QUOTES, 'UTF-8');
            $filters_def = html_entity_decode($filtersDef, ENT_QUOTES, 'UTF-8');
            $args['reporter'] =  new Report($report_def, $filters_def, $panels_def);
            $args['reporter']->removeInvalidFilters();
            $dotb_smarty->assign('report_def_str', $args['reporter']->report_def_str);
        }
        if ($id !== null)
            $dotb_smarty->assign('record', $id);

        $assigned_user_html_def = array(
            'parent_id'=>'assigned_user_id',
            'parent_id_value'=>$assignedUserId,
            'parent_name'=>'assigned_user_name',
            'parent_name_value'=>$assignedUserName,
            'real_parent_name'=>'user_name',
            'module'=>'Users',
        );
        $assigned_user_html = get_select_related_html($assigned_user_html_def);
        $isOwner = 0;
        if ($assignedUserId == $current_user->id)
            $isOwner = 1;
        $dotb_smarty->assign("IS_OWNER", $isOwner);
        $teamSetField = new DotbFieldTeamset('Teamset');
        $field_defs = VardefManager::loadVardef('Reports', 'SavedReport');
        $teamSetField->initClassicView($GLOBALS['dictionary']['SavedReport']['fields'], 'ReportsWizardForm');
        $team_html = $teamSetField->getClassicView();
        $dotb_smarty->assign("TEAM_HTML", $team_html);
        $dotb_smarty->assign("USER_HTML", $assigned_user_html);
        $dotb_smarty->assign("report_offset", $args['reporter']->report_offset);
        $dotb_smarty->assign("chart_description", htmlentities( $args['reporter']->chart_description, ENT_QUOTES, 'UTF-8'));

        setSortByInfo($args['reporter'], $dotb_smarty);

        echo $dotb_smarty->fetch('modules/Reports/ReportsWizard.tpl');
        echo "<br/><br/>";
        echo "<div id='resultsDiv' name='resultsDiv'>";
        //$image_path = $orig_image_path;
        reportResults($args['reporter'],$args);
        echo "</div>";

    }
    else if ($saveReport !== null && ($saveReport == 'on')) {
        $args = array();
        $report_def = array();
        $report_name = '';
        if (!empty($reportDef)) {
            $report_def = html_entity_decode($reportDef);
            $panels_def = html_entity_decode($panelsDef);
            $filters_def = html_entity_decode($filtersDef);
            $report_name = html_entity_decode($saveReportAs);
        }

        if (!empty($id)) {
            $saved_report_seed = BeanFactory::newBean('Reports');
            $saved_report_seed->disable_row_level_security = true;
            $saved_report_seed->retrieve($id, false);
            $args['reporter'] =  new Report($report_def, $filters_def, $panels_def);
            $args['reporter']->saved_report = &$saved_report_seed;
            $args['reporter']->is_saved_report = true;
            $args['reporter']->saved_report_id = $saved_report_seed->id;
            $args['reporter']->removeInvalidFilters();
        } else {
            $args['reporter'] =  new Report($report_def, $filters_def, $panels_def);
            $args['reporter']->removeInvalidFilters();
        }
        $currentStep = $request->getValidInputRequest('current_step');
        $dotb_smarty->assign('report_def_str', $args['reporter']->report_def_str);
        $dotb_smarty->assign('current_step', $currentStep);

        $newReport = false;
        if (empty($args['reporter']->saved_report_id)) {
            $newReport = true;
        } // if
        $args['reporter']->save($report_name);
        $dotb_smarty->assign("record", $args['reporter']->saved_report->id);
        // Put this newly created report in the report_cache table so that in the list view of reports it will be shown first
        $newArray = array();
        $newArray['filters_def'] = $args['reporter']->report_def['filters_def'];
        $encodedFilterData = $global_json->encode($newArray);
        saveReportFilters($args['reporter']->saved_report->id, $encodedFilterData);

        $saveAndRunQuery = $request->getValidInputRequest('save_and_run_query');
        if ($saveAndRunQuery !== null && ($saveAndRunQuery == 'on')) {
            header('location:index.php?action=ReportCriteriaResults&module=Reports&page=report&id='.$args['reporter']->saved_report->id);
        }
        else {
            $assigned_user_html_def = array(
                'parent_id'=>'assigned_user_id',
                'parent_id_value'=>$assignedUserId,
                'parent_name'=>'assigned_user_name',
                'parent_name_value'=>$assignedUserName,
                'real_parent_name'=>'user_name',
                'module'=>'Users',
            );
            $assigned_user_html = get_select_related_html($assigned_user_html_def);

            $isOwner = 0;
            if ($assignedUserId == $current_user->id)
                $isOwner = 1;
            $dotb_smarty->assign("IS_OWNER", $isOwner);
            $teamSetField = new DotbFieldTeamset('Teamset');
            $field_defs = VardefManager::loadVardef('Reports', 'SavedReport');
            $teamSetField->initClassicView($GLOBALS['dictionary']['SavedReport']['fields'], 'ReportsWizardForm');
            $team_html = $teamSetField->getClassicView();

            $dotb_smarty->assign("TEAM_HTML", $team_html);
            $dotb_smarty->assign("USER_HTML", $assigned_user_html);
            $dotb_smarty->assign("report_offset", $args['reporter']->report_offset);
            $dotb_smarty->assign("chart_description", htmlentities( $args['reporter']->chart_description, ENT_QUOTES, 'UTF-8'));

            //Custom URL to execute Report - Lap Nguyen
            $dotb_smarty->assign("custom_url", $saved_report_seed->custom_url);
            $dotb_smarty->assign("is_admin_data", $saved_report_seed->is_admin_data);
            $dotb_smarty->assign("row_number", $args['reporter']->saved_report->row_number);
            $is_admin_data_help = smarty_function_dotb_help(array("text"=>$mod_strings['LBL_IS_ADMIN_DATA_HELP']),$dotb_smarty);
            $dotb_smarty->assign("is_admin_data_help", $is_admin_data_help);
            $dotb_smarty->assign("description", $saved_report_seed->description);
            $dotb_smarty->assign("user_id", $current_user->id);

            $dotb_smarty->assign("list_of_arr", get_select_options_with_id($app_list_strings['report_list_list'], (empty($saved_report_seed->list_of) ? '' :  unencodeMultienum($saved_report_seed->list_of))));

            $html_tpl   = getHtmlAddRow('',true, $saved_report_seed);
            $jsonQs   = json_decode(html_entity_decode($saved_report_seed->replace_str));
            if(empty($jsonQs))
                $html_tpl   .= getHtmlAddRow('',false, $saved_report_seed);
            else
                foreach($jsonQs as $key => $jsonQ)
                    $html_tpl   .= getHtmlAddRow($jsonQ,false,$saved_report_seed);
            $dotb_smarty->assign('html_tpl',$html_tpl);
            //END

            setSortByInfo($args['reporter'], $dotb_smarty);
            echo $dotb_smarty->fetch('modules/Reports/ReportsWizard.tpl');

            if (!empty($currentStep) && $currentStep=='report_details'){
                echo "<br/><br/>";
                echo "<div id='resultsDiv' name='resultsDiv'>";
                //$image_path = $orig_image_path;
                reportResults($args['reporter'],$args);
                echo "</div>";
            }
        }
    }
    else if ($isDelete !== null && ($isDelete == '1')) {
        $report = BeanFactory::getBean('Reports', $id);
        if($report->ACLAccess('Delete')){
            $report->mark_deleted($id);
            DotbApplication::redirect('location:index.php?action=index&module=Reports');
        }

    }
    else if (!empty($id)) {
        $saved_report_seed = BeanFactory::newBean('Reports');
        $saved_report_seed->disable_row_level_security = true;
        $saved_report_seed->retrieve($id, false);
        $args['reporter'] = new Report($saved_report_seed->content);
        $args['reporter']->saved_report = &$saved_report_seed;
        $args['reporter']->is_saved_report = true;
        $args['reporter']->saved_report_id = $saved_report_seed->id;
        $args['reporter']->removeInvalidFilters();
        $dotb_smarty->assign('report_def_str', $args['reporter']->report_def_str);
        if (!isset($args['reporter']->report_def['do_round']) || $args['reporter']->report_def['do_round'] == 1)
            $dotb_smarty->assign("do_round", 1);

        $saveAs = $request->getValidInputRequest('save_as', null, null);
        $saveAsReportType = $request->getValidInputRequest('save_as_report_type', null, null);

        // Duplicate Functionality
        if (!empty($saveAs)) {
            $assigned_user_html_def = array(
                'parent_id'=>'assigned_user_id',
                'parent_id_value'=>$current_user->id,
                'parent_name'=>'assigned_user_name',
                'parent_name_value'=>$current_user->user_name,
                'real_parent_name'=>'user_name',
                'module'=>'Users',
            );
            $assigned_user_html = get_select_related_html($assigned_user_html_def);

            if (!empty($saveAsReportType)) {
                $new_report_type = $saveAsReportType;
                $prev_report_type = $args['reporter']->report_def['report_type'];
                $report_def = $args['reporter']->report_def;
                if ($new_report_type == 'summation') {
                    $report_def['report_type'] = 'summary';
                    if(isset($report_def['layout_options']))
                        unset($report_def['layout_options']);
                    $report_def['display_columns'] = array();
                }
                else if ($new_report_type == 'tabular') {
                    $report_def['report_type'] = $new_report_type;
                    $report_def['group_defs'] = array();
                    if(isset($report_def['layout_options']))
                        unset($report_def['layout_options']);
                    $report_def['summary_columns'] = array();
                }
                else if ($new_report_type == 'summation_with_details') {
                    if(isset($report_def['layout_options']))
                        unset($report_def['layout_options']);
                    $report_def['report_type'] = $new_report_type;
                }
                else if ($new_report_type == 'matrix') {
                    $report_def['report_type'] = 'summary';
                    $report_def['layout_options'] = '1';
                    $report_def['display_columns'] = array();
                }


                $args['reporter'] = new Report($global_json->encode($report_def));
                $args['reporter']->removeInvalidFilters();
                $dotb_smarty->assign('report_def_str', $args['reporter']->report_def_str);
            }
        }
        else {
            $dotb_smarty->assign('record', $id);

            $dotb_smarty->assign('save_report_as', html_entity_decode($saved_report_seed->name, ENT_QUOTES));
            $assigned_user_html_def = array(
                'parent_id'=>'assigned_user_id',
                'parent_id_value'=>$saved_report_seed->assigned_user_id,
                'parent_name'=>'assigned_user_name',
                'parent_name_value'=>$saved_report_seed->assigned_user_name,
                'real_parent_name'=>'user_name',
                'module'=>'Users',
            );
            $assigned_user_html = get_select_related_html($assigned_user_html_def);

        }
        $isOwner = 0;
        if ($saved_report_seed->assigned_user_id == $current_user->id)
            $isOwner = 1;
        $dotb_smarty->assign("IS_OWNER", $isOwner);
        $teamSetField = new DotbFieldTeamset('Teamset');
        $field_defs = VardefManager::loadVardef('Reports', 'SavedReport');
        $teamSetField->initClassicView($GLOBALS['dictionary']['SavedReport']['fields'], 'ReportsWizardForm');
        $team_html = $teamSetField->getClassicView();

        $dotb_smarty->assign("TEAM_HTML", $team_html);
        $dotb_smarty->assign("USER_HTML", $assigned_user_html);
        $dotb_smarty->assign("report_offset", $args['reporter']->report_offset);
        $dotb_smarty->assign("chart_description", htmlentities( $args['reporter']->chart_description, ENT_QUOTES, 'UTF-8'));

        //Custom URL to execute Report - Lap Nguyen
        $dotb_smarty->assign("custom_url", $saved_report_seed->custom_url);
        $dotb_smarty->assign("is_admin_data", $saved_report_seed->is_admin_data);
        $dotb_smarty->assign("row_number", $saved_report_seed->row_number);
        $dotb_smarty->assign("description", $saved_report_seed->description);
        $dotb_smarty->assign("user_id", $current_user->id);
        $is_admin_data_help = smarty_function_dotb_help(array("text"=>$mod_strings['LBL_IS_ADMIN_DATA_HELP']),$dotb_smarty);
        $dotb_smarty->assign("is_admin_data_help", $is_admin_data_help);
        $dotb_smarty->assign("list_of_arr", get_select_options_with_id($app_list_strings['report_list_list'], (empty($saved_report_seed->list_of) ? '' : unencodeMultienum($saved_report_seed->list_of))));
        $custom_url_help = smarty_function_dotb_help(array("text"=>$mod_strings['LBL_CUSTOM_URL_HELP']),$dotb_smarty);
        $dotb_smarty->assign("custom_url_help", $custom_url_help);

        $html_tpl   = getHtmlAddRow('',true, $saved_report_seed);
        $jsonQs   = json_decode(html_entity_decode($saved_report_seed->replace_str));
        if(empty($jsonQs))
            $html_tpl   .= getHtmlAddRow('',false, $saved_report_seed);
        else
            foreach($jsonQs as $key => $jsonQ)
                $html_tpl   .= getHtmlAddRow($jsonQ,false, $saved_report_seed);
        $dotb_smarty->assign('html_tpl',$html_tpl);
        //END

        setSortByInfo($args['reporter'], $dotb_smarty);

        echo $dotb_smarty->fetch('modules/Reports/ReportsWizard.tpl');
    }
    else {
        $assigned_user_html_def = array(
            'parent_id'=>'assigned_user_id',
            'parent_id_value'=>$current_user->id,
            'parent_name'=>'assigned_user_name',
            'parent_name_value'=>$current_user->user_name,
            'real_parent_name'=>'user_name',
            'module'=>'Users',
        );
        $assigned_user_html = get_select_related_html($assigned_user_html_def);

        $dotb_smarty->assign("do_round", 1);
        $teamSetField = new DotbFieldTeamset('Teamset');
        $field_defs = VardefManager::loadVardef('Reports', 'SavedReport');
        $teamSetField->initClassicView($GLOBALS['dictionary']['SavedReport']['fields'], 'ReportsWizardForm');
        $team_html = $teamSetField->getClassicView();
        $dotb_smarty->assign("TEAM_HTML", $team_html);
        $dotb_smarty->assign("USER_HTML", $assigned_user_html);
        $dotb_smarty->assign("report_offset", $args['reporter']->report_offset);
        $dotb_smarty->assign("chart_description", htmlentities( $args['reporter']->chart_description, ENT_QUOTES, 'UTF-8'));

        $dotb_smarty->assign("list_of_arr", get_select_options_with_id($app_list_strings['report_list_list'], (empty($saved_report_seed->list_of) ? '' : unencodeMultienum($saved_report_seed->list_of))));

        $html_tpl   = getHtmlAddRow('',true, $saved_report_seed);
        $jsonQs   = json_decode(html_entity_decode($saved_report_seed->replace_str));
        if(empty($jsonQs))
            $html_tpl   .= getHtmlAddRow('',false, $saved_report_seed);
        else
            foreach($jsonQs as $key => $jsonQ)
                $html_tpl   .= getHtmlAddRow($jsonQ,false, $saved_report_seed);
        $dotb_smarty->assign('html_tpl',$html_tpl);
        //END
        setSortByInfo($args['reporter'], $dotb_smarty);

        echo $dotb_smarty->fetch('modules/Reports/ReportsWizard.tpl');
    }

    function setSortByInfo(&$reporter, &$smarty) {
        $sort_by = '';
        $sort_dir = '';
        $summary_sort_by = '';
        $summary_sort_dir = '';

        if (isset($reporter->report_def['order_by'][0]['name']) && isset($reporter->report_def['order_by'][0]['table_key'])) {
            $sort_by = $reporter->report_def['order_by'][0]['table_key'].":".$reporter->report_def['order_by'][0]['name'];
        } // if
        if (isset($reporter->report_def['order_by'][0]['sort_dir'])) {
            $sort_dir = $reporter->report_def['order_by'][0]['sort_dir'];
        } // if

        if ( ! empty($reporter->report_def['summary_order_by'][0]['group_function']) && $reporter->report_def['summary_order_by'][0]['group_function'] == 'count') {

            $summary_sort_by = $reporter->report_def['summary_order_by'][0]['table_key'].":".'count';
        } else if ( isset($reporter->report_def['summary_order_by'][0]['name'])) {
            $summary_sort_by = $reporter->report_def['summary_order_by'][0]['table_key'].":".$reporter->report_def['summary_order_by'][0]['name'];

            if ( ! empty($reporter->report_def['summary_order_by'][0]['group_function'])) {
                $summary_sort_by .=":". $reporter->report_def['summary_order_by'][0]['group_function'];
            } else if ( ! empty($reporter->report_def['summary_order_by'][0]['column__function'])) {
                $summary_sort_by .=":". $reporter->report_def['summary_order_by'][0]['column_function'];
            } // else if
        } // else if

        if ( isset($reporter->report_def['summary_order_by'][0]['sort_dir'])) {
            $summary_sort_dir = $reporter->report_def['summary_order_by'][0]['sort_dir'];
        } // if

        $smarty->assign('sort_by', $sort_by);
        $smarty->assign('sort_dir', $sort_dir);
        $smarty->assign('summary_sort_by', $summary_sort_by);
        $smarty->assign('summary_sort_dir', $summary_sort_dir);

    } // fn

    // Generate Add row template
    function getHtmlAddRow($json_en, $showing, $report_seed = ''){
        $arrQueries       = array(
            'query'         => 'Detail',
            'summary_query' => 'Summary',
            'total_query'   => 'Total',
        );

        $queries = array();
        if(empty($report_seed)) $queries = ['query', 'summary_query', 'total_query'];
        else
        switch($report_seed->report_type) {
            case 'tabular':
                $queries = ['query'];
                break;
            case 'summary':
                $queries =  ['summary_query', 'total_query'];
                if($report_seed->fetched_row['report_type'] == 'Matrix')
                    $queries = ['summary_query'];
                break;
            case 'detailed_summary':
                $queries = ['query', 'summary_query', 'total_query'];
                break;
        }
        $arrListQuery = array();
        for($i = 0; $i < count($queries); $i++)
            $arrListQuery[$queries[$i]] = 'Query '.($i+1).': '.$arrQueries[$queries[$i]];


        $json = json_decode(html_entity_decode($json_en),true);

        if($showing)
            $display = 'style="display:none;"';
        $tpl_addrow = "<tr class='row_tpl' $display>";
        $tpl_addrow .= "<input name='json_query[]' value='".htmlentities($json_en)."' class='json_query' type='hidden'/>";
        $tpl_addrow .= '<td scope="col" align="center"><select name="queryval[]" class="queryval">'.get_select_options_with_id($arrListQuery,$json['query']).'</select></td>';
        $tpl_addrow .= '<td align="center"><textarea tabindex="0" class="searchval" name="searchval[]" rows="2" cols="20" title="Seach Value">'.$json['search'].'</textarea></td>';
        $tpl_addrow .= '<td align="center"><textarea tabindex="0" class="replaceval" name="replaceval[]" rows="2" cols="20" title="Replace Value">'.$json['replace'].'</textarea></td>';
        $tpl_addrow .= "<td><button type='button' class='btn btn-danger btnRemove'><b>-</b></button></td>";
        $tpl_addrow .= '</tr>';
        return $tpl_addrow;
}
