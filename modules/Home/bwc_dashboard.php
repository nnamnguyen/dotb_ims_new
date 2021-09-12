<?php


global $current_user, $dotb_version, $dotb_config, $beanFiles;


// build dashlet cache file if not found
if(!is_file($cachefile = dotb_cached('dashlets/dashlets.php'))) {

    $dc = new DashletCacheBuilder();
    $dc->buildCache();
}
require_once $cachefile;

foreach(DotbAutoLoader::existingCustom('modules/Home/dashlets.php') as $file) {
    include $file;
}

$pages = $current_user->getPreference('pages', 'Home');
$dashlets = $current_user->getPreference('dashlets', 'Home');

$defaultHomepage = false;
// BEGIN fill in with default homepage and dashlet selections

$hasUserPreferences = (!isset($pages) || empty($pages) || !isset($dashlets) || empty($dashlets)) ? false : true;

if(!$hasUserPreferences){
	// BEGIN 'My Dotb'
	$defaultHomepage = true;
    $dashlets = array();

    //list of preferences to move over and to where
    $prefstomove = array(
        'mypbss_date_start' => 'MyPipelineBySalesStageDashlet',
        'mypbss_date_end' => 'MyPipelineBySalesStageDashlet',
        'mypbss_sales_stages' => 'MyPipelineBySalesStageDashlet',
        'mypbss_chart_type' => 'MyPipelineBySalesStageDashlet',
        'lsbo_lead_sources' => 'OpportunitiesByLeadSourceByOutcomeDashlet',
        'lsbo_ids' => 'OpportunitiesByLeadSourceByOutcomeDashlet',
        'pbls_lead_sources' => 'OpportunitiesByLeadSourceDashlet',
        'pbls_ids' => 'OpportunitiesByLeadSourceDashlet',
        'pbss_date_start' => 'PipelineBySalesStageDashlet',
        'pbss_date_end' => 'PipelineBySalesStageDashlet',
        'pbss_sales_stages' => 'PipelineBySalesStageDashlet',
        'pbss_chart_type' => 'PipelineBySalesStageDashlet',
        'obm_date_start' => 'OutcomeByMonthDashlet',
        'obm_date_end' => 'OutcomeByMonthDashlet',
        'obm_ids' => 'OutcomeByMonthDashlet');

	//upgrading from pre-5.0 homepage
	$old_columns = $current_user->getPreference('columns', 'home');
	$old_dashlets = $current_user->getPreference('dashlets', 'home');

	if (isset($old_columns) && !empty($old_columns) && isset($old_dashlets) && !empty($old_dashlets)){
		$columns = $old_columns;
		$dashlets = $old_dashlets;

		// resetting old columns and dashlets to have no preference and data
		$old_columns = array();
		$old_dashlets = array();
		$current_user->setPreference('columns', $old_columns, 0, 'home');
		$current_user->setPreference('dashlets', $old_dashlets, 0, 'home');
	}
	else{
        // This is here to get Dotb dashlets added above the rest
        $dashlets[create_guid()] = array('className' => 'iFrameDashlet',
                                         'module' => 'Home',
                                         'forceColumn' => 1,
                                         'fileLocation' => $dashletsFiles['iFrameDashlet']['file'],
                                         'options' => array('titleLabel' => 'LBL_DASHLET_DOTB_NEWS',
                                                            'url' => 'http://www.dotbcrm.com/crm/product/news',
                                                            'height' => 315,
                                             ));

	    foreach($defaultDashlets as $dashletName=>$module){
			// clint - fixes bug #20398
			// only display dashlets that are from visibile modules and that the user has permission to list
			$myDashlet = new MyDotb($module);
			$displayDashlet = $myDashlet->checkDashletDisplay();
	    	if (isset($dashletsFiles[$dashletName]) && $displayDashlet){
	        	$options = array();
               $prefsforthisdashlet = array_keys($prefstomove,$dashletName);
               foreach ( $prefsforthisdashlet as $pref ) {
                   $options[$pref] = $current_user->getPreference($pref);
               }
                $dashlets[create_guid()] = array('className' => $dashletName,
												 'module' => $module,
	            	                             'forceColumn' => 0,
	            	                             'fileLocation' => $dashletsFiles[$dashletName]['file'],
                                                 'options' => $options);
	    	}
	    }

	    $count = 0;
	    $columns = array();
	    $columns[0] = array();
	    $columns[0]['width'] = '60%';
	    $columns[0]['dashlets'] = array();
	    $columns[1] = array();
	    $columns[1]['width'] = '40%';
	    $columns[1]['dashlets'] = array();

	    foreach($dashlets as $guid=>$dashlet) {
	        if( $dashlet['forceColumn'] == 0 ) array_push($columns[0]['dashlets'], $guid);
	        else array_push($columns[1]['dashlets'], $guid);
	        $count++;
	    }
	}

    // END 'My Dotb'



    // BEGIN 'Sales Page'
    $salesDashlets = array();
    foreach($defaultSalesDashlets as $salesDashletName=>$module){
		// clint - fixes bug #20398
		// only display dashlets that are from visibile modules and that the user has permission to list
		$myDashlet = new MyDotb($module);
		$displayDashlet = $myDashlet->checkDashletDisplay();
    	if (isset($dashletsFiles[$salesDashletName]) && $displayDashlet){
            $options = array();
            $prefsforthisdashlet = array_keys($prefstomove,$salesDashletName);
            foreach ( $prefsforthisdashlet as $pref ) {
               $options[$pref] = $current_user->getPreference($pref);
            }

            $salesDashlets[create_guid()] = array('className' => $salesDashletName,
										 'module'=>$module,
	                                         'fileLocation' => $dashletsFiles[$salesDashletName]['file'],
                                             'options' => $options);
    	}
    }

    foreach ($defaultSalesChartDashlets as $salesChartDashlet=>$module){
		$savedReport = BeanFactory::newBean('Reports');
		$reportId = $savedReport->retrieveReportIdByName($salesChartDashlet);
		// clint - fixes bug #20398
		// only display dashlets that are from visibile modules and that the user has permission to list
		$myDashlet = new MyDotb($module);
		$displayDashlet = $myDashlet->checkDashletDisplay();

		if(isset($reportId) && $displayDashlet) {
    		$salesDashlets[create_guid()] = array('className' => 'ChartsDashlet',
											 		'module'=>$module,
    												'fileLocation' => $dashletsFiles['ChartsDashlet']['file'],
    												'reportId' => $reportId, );
    	}
    }

    foreach($defaultSalesDashlets2 as $salesDashletName=>$module){
		$myDashlet = new MyDotb($module);
		$displayDashlet = $myDashlet->checkDashletDisplay();
    	if (isset($dashletsFiles[$salesDashletName]) && $displayDashlet){
            $options = array();
            $prefsforthisdashlet = array_keys($prefstomove,$salesDashletName);
            foreach ( $prefsforthisdashlet as $pref ) {
               $options[$pref] = $current_user->getPreference($pref);
            }

            $salesDashlets[create_guid()] = array('className' => $salesDashletName,
										 'module'=>$module,
	                                         'fileLocation' => $dashletsFiles[$salesDashletName]['file'],
                                             'options' => $options);
    	}
    }

    $count = 0;
    $salesColumns = array();
    $salesColumns[0] = array();
    $salesColumns[0]['width'] = '60%';
    $salesColumns[0]['dashlets'] = array();
    $salesColumns[1] = array();
    $salesColumns[1]['width'] = '40%';
    $salesColumns[1]['dashlets'] = array();

    foreach($salesDashlets as $guid=>$dashlet){
        if($count % 2 == 0) array_push($salesColumns[0]['dashlets'], $guid);
        else array_push($salesColumns[1]['dashlets'], $guid);
        $count++;
    }
    // END 'Sales Page'

	// BEGIN 'Marketing Page'
	$marketingDashlets = array();
    foreach ($defaultMarketingChartDashlets as $marketingChartDashlet=>$module){
		$savedReport = BeanFactory::newBean('Reports');
		$reportId = $savedReport->retrieveReportIdByName($marketingChartDashlet);
		// clint - fixes bug #20398
		// only display dashlets that are from visibile modules and that the user has permission to list
		$myDashlet = new MyDotb($module);
		$displayDashlet = $myDashlet->checkDashletDisplay();

		if(isset($reportId) && $displayDashlet) {
    		$marketingDashlets[create_guid()] = array('className' => 'ChartsDashlet',
											 		'module'=>$module,
    												'fileLocation' => $dashletsFiles['ChartsDashlet']['file'],
    												'reportId' => $reportId, );
	    }
    }

    foreach($defaultMarketingDashlets as $marketingDashletName=>$module){
		// clint - fixes bug #20398
		// only display dashlets that are from visibile modules and that the user has permission to list
		$myDashlet = new MyDotb($module);
		$displayDashlet = $myDashlet->checkDashletDisplay();

    	if (isset($dashletsFiles[$marketingDashletName]) && $displayDashlet){
	        $options = array();
            $prefsforthisdashlet = array_keys($prefstomove,$marketingDashletName);
            foreach ( $prefsforthisdashlet as $pref ) {
               $options[$pref] = $current_user->getPreference($pref);
            }
            $marketingDashlets[create_guid()] = array('className' => $marketingDashletName,
									 		 'module'=>$module,
	                                         'fileLocation' => $dashletsFiles[$marketingDashletName]['file'],
                                             'options' => $options);
    	}
    }

    $count = 0;
    $marketingColumns = array();
    $marketingColumns[0] = array();
    $marketingColumns[0]['width'] = '60%';
    $marketingColumns[0]['dashlets'] = array();
    $marketingColumns[1] = array();
    $marketingColumns[1]['width'] = '40%';
    $marketingColumns[1]['dashlets'] = array();

    foreach($marketingDashlets as $guid=>$dashlet){
        if($count % 2 == 0) array_push($marketingColumns[0]['dashlets'], $guid);
        else array_push($marketingColumns[1]['dashlets'], $guid);
        $count++;
    }
	// END 'Marketing Page'

	// BEGIN 'Support Page'
	$supportDashlets = array();
    foreach ($defaultSupportChartDashlets as $supportChartDashlet=>$module){
		$savedReport = BeanFactory::newBean('Reports');
		$reportId = $savedReport->retrieveReportIdByName($supportChartDashlet);
		// clint - fixes bug #20398
		// only display dashlets that are from visibile modules and that the user has permission to list
		$myDashlet = new MyDotb($module);
		$displayDashlet = $myDashlet->checkDashletDisplay();

		if(isset($reportId) && $displayDashlet) {
    		$supportDashlets[create_guid()] = array('className' => 'ChartsDashlet',
											 		'module'=>$module,
    												'fileLocation' => $dashletsFiles['ChartsDashlet']['file'],
    												'reportId' => $reportId, );
	    }
    }

    foreach($defaultSupportDashlets as $supportDashletName=>$module){
		// clint - fixes bug #20398
		// only display dashlets that are from visibile modules and that the user has permission to list
		$myDashlet = new MyDotb($module);
		$displayDashlet = $myDashlet->checkDashletDisplay();

    	if (isset($dashletsFiles[$supportDashletName]) && $displayDashlet){
	        $options = array();
            $prefsforthisdashlet = array_keys($prefstomove,$supportDashletName);
            foreach ( $prefsforthisdashlet as $pref ) {
               $options[$pref] = $current_user->getPreference($pref);
            }
            $supportDashlets[create_guid()] = array('className' => $supportDashletName,
									 		 'module'=>$module,
	                                         'fileLocation' => $dashletsFiles[$supportDashletName]['file'],
                                             'options' => $options);
    	}
    }

    $count = 0;
    $supportColumns = array();
    $supportColumns[0] = array();
    $supportColumns[0]['width'] = '50%';
    $supportColumns[0]['dashlets'] = array();
    $supportColumns[1] = array();
    $supportColumns[1]['width'] = '50%';
    $supportColumns[1]['dashlets'] = array();

    foreach($supportDashlets as $guid=>$dashlet){
        if($count % 2 == 0) array_push($supportColumns[0]['dashlets'], $guid);
        else array_push($supportColumns[1]['dashlets'], $guid);
        $count++;
    }
	// END 'Support Page'

	// BEGIN 'Tracker Page'

	$trackingDashlets = array();
	foreach($defaultTrackingDashlets as $trackingDashletName=>$module){
		// clint - fixes bug #20398
		// only display dashlets that are from visibile modules and that the user has permission to list
		$myDashlet = new MyDotb($module);
		$displayDashlet = $myDashlet->checkDashletDisplay();
    	if (isset($dashletsFiles[$trackingDashletName]) && $displayDashlet){
	        $options = array();
            $prefsforthisdashlet = array_keys($prefstomove,$trackingDashletName);
            foreach ( $prefsforthisdashlet as $pref ) {
               $options[$pref] = $current_user->getPreference($pref);
            }
            $trackingDashlets[create_guid()] = array('className' => $trackingDashletName,
									 		 'module'=>$module,
	                                         'fileLocation' => $dashletsFiles[$trackingDashletName]['file'],
                                             'options' => $options);
    	}
    }

    foreach($defaultTrackingReportDashlets as $name=>$module) {
    	$savedReport = BeanFactory::newBean('Reports');
        $reportId = $savedReport->retrieveReportIdByName($name);

    	$myDashlet = new MyDotb($module);
		$displayDashlet = $myDashlet->checkDashletDisplay();

        if (isset($reportId) && $displayDashlet){
	        $trackingDashlets[create_guid()] = array('className' => 'ChartsDashlet',
									 		 		'module'=>$module,
                                                    'fileLocation' => $dashletsFiles['ChartsDashlet']['file'],
                                                    'reportId' => $reportId);
		}
    }

    $count = 0;
    $trackingColumns = array();
    $trackingColumns[0] = array();
    $trackingColumns[0]['width'] = '50%';
    $trackingColumns[0]['dashlets'] = array();
    $trackingColumns[1] = array();
    $trackingColumns[1]['width'] = '50%';
    $trackingColumns[1]['dashlets'] = array();

    foreach($trackingDashlets as $guid=>$dashlet){
    	if($count % 2 == 0) {
    		array_push($trackingColumns[0]['dashlets'], $guid);
    	} else {
    		array_push($trackingColumns[1]['dashlets'], $guid);
    	}
    	$count++;
    }



	// END 'Tracker'
    $dashlets = array_merge($dashlets, $salesDashlets, $marketingDashlets, $supportDashlets, $trackingDashlets);


    $current_user->setPreference('dashlets', $dashlets, 0, 'Home');
}

// handles upgrading from versions that had the 'Dashboard' module; move those items over to the Home page
$pagesDashboard = $current_user->getPreference('pages', 'Dashboard');
$dashletsDashboard = $current_user->getPreference('dashlets', 'Dashboard');
if ( !empty($pagesDashboard) ) {
    $pages = array_merge($pages,$pagesDashboard);
    $current_user->setPreference('pages', $pages, 0, 'Home');
}
if ( !empty($dashletsDashboard) ) {
    $dashlets = array_merge($dashlets,$dashletsDashboard);
    $current_user->setPreference('dashlets', $dashlets, 0, 'Home');
}
if ( !empty($pagesDashboard) || !empty($dashletsDashboard) )
    $current_user->resetPreferences('Dashboard');

if (empty($pages)){
	$pages = array();
	$pageIndex = 0;
	$pages[0]['columns'] = $columns;
	$pages[0]['numColumns'] = '2';
	$pages[0]['pageTitleLabel'] = 'LBL_HOME_PAGE_1_NAME';	// "My Dotb"
	$pageIndex++;

	$pages[$pageIndex]['columns'] = $salesColumns;
	$pages[$pageIndex]['numColumns'] = '2';
	$pages[$pageIndex]['pageTitleLabel'] = 'LBL_HOME_PAGE_2_NAME';	// "Sales Page"
	$pageIndex++;

	if(ACLController::checkAccess('Leads', 'view', false)){
		$pages[$pageIndex]['columns'] = $marketingColumns;
		$pages[$pageIndex]['numColumns'] = '2';
		$pages[$pageIndex]['pageTitleLabel'] = 'LBL_HOME_PAGE_6_NAME';	// "Marketing Page"
		$pageIndex++;
	}

	if(ACLController::checkAccess('Cases', 'view', false)){
		$pages[$pageIndex]['columns'] = $supportColumns;
		$pages[$pageIndex]['numColumns'] = '2';
		$pages[$pageIndex]['pageTitleLabel'] = 'LBL_HOME_PAGE_3_NAME';	// "Support Page"
		$pageIndex++;
	}

	if(ACLController::checkAccess('Trackers', 'view', false, 'Tracker')){
		$pages[$pageIndex]['columns'] = $trackingColumns;
		$pages[$pageIndex]['numColumns'] = '2';
		$pages[$pageIndex]['pageTitleLabel'] = 'LBL_HOME_PAGE_4_NAME';	// "Tracker"
		$pageIndex++;
	}
	$current_user->setPreference('pages', $pages, 0, 'Home');
    $_COOKIE[$current_user->id . '_activePage'] = '0';
    setcookie($current_user->id . '_activePage','0',3000);
    $activePage = 0;
}

$dotb_smarty = new Dotb_Smarty();

if(!empty($_REQUEST) && isset($_REQUEST['activeTab']) && strlen($_REQUEST['activeTab']) > 0) {
	if($_REQUEST['activeTab'] == 'AddTab')  {
		$activePage = isset($_COOKIE[$current_user->id . '_activePage']) ? intval($_COOKIE[$current_user->id . '_activePage']) : 0;
		$js = 'YAHOO.util.Event.onAvailable("addPageDialog", function() { DOTB.myDotb.showAddPageDialog(); })';
        $dotb_smarty->assign('activeTabJavascript', $js);
	} else {
		$activePage = !empty($pages[$_REQUEST['activeTab']]) ? intval($_REQUEST['activeTab']) : 0;
		$js = 'YAHOO.util.Event.onAvailable("' . 'pageNum_' . $activePage . '", function() { DOTB.myDotb.togglePages("' . $activePage . '") })';
        $dotb_smarty->assign('activeTabJavascript', $js);
	}
} else if(isset($_COOKIE[$current_user->id . '_activePage']) && $_COOKIE[$current_user->id . '_activePage'] != '' && isset($pages[$_COOKIE[$current_user->id . '_activePage']])) {
    $activePage = intval($_COOKIE[$current_user->id . '_activePage']);
} else {
    $_COOKIE[$current_user->id . '_activePage'] = '0';
    setcookie($current_user->id . '_activePage','0',3000);
    $activePage = 0;
}

$divPages[] = $activePage;

$numCols = $pages[$activePage]['numColumns'];

foreach($pages as $pageNum => $page){
    //grab the now viewed pages to render the <div> foreach
    if($pageNum != $activePage)
        $divPages[] = $pageNum;

    // If it's one of the default tabs (has 'pageTitleLabel' defined) pick translated value
    if (!empty($page['pageTitleLabel']) && empty($page['pageTitle'])) {
    	$pageData[$pageNum]['pageTitle'] = to_html($mod_strings[$page['pageTitleLabel']], ENT_QUOTES);
    } else {
        $pageData[$pageNum]['pageTitle'] = to_html($page['pageTitle'], ENT_QUOTES);
	}

    if($pageNum == $activePage){
        $pageData[$pageNum]['tabClass'] = 'current';
        $pageData[$pageNum]['visibility'] = 'inline';
    }
    else{
        $pageData[$pageNum]['tabClass'] = '';
        $pageData[$pageNum]['visibility'] = 'none';
    }
}

$count = 0;
$dashletIds = array(); // collect ids to pass to javascript
$display = array();

foreach($pages[$activePage]['columns'] as $colNum => $column) {
	if ($colNum == $numCols){
		break;
	}
    $display[$colNum]['width'] = $column['width'];
    $display[$colNum]['dashlets'] = array();
    foreach($column['dashlets'] as $num => $id) {
		// clint - fixes bug #20398
		// only display dashlets that are from visibile modules and that the user has permission to list
        if(!empty($id) && isset($dashlets[$id]) && is_file($dashlets[$id]['fileLocation'])) {
			$module = 'Home';
			if ( !empty($dashletsFiles[$dashlets[$id]['className']]['module']) )
        		$module = $dashletsFiles[$dashlets[$id]['className']]['module'];
        	// Bug 24772 - Look into the user preference for the module the dashlet is a part of in case
        	//             of the Report Chart dashlets.
        	elseif ( !empty($dashlets[$id]['module']) )
        	    $module = $dashlets[$id]['module'];

			$myDashlet = new MyDotb($module);

			if($myDashlet->checkDashletDisplay()) {
        		require_once($dashlets[$id]['fileLocation']);
        		if ($dashlets[$id]['className'] == 'ChartsDashlet'){
        			$dashlet = new $dashlets[$id]['className']($id, $dashlets[$id]['reportId'], (isset($dashlets[$id]['options']) ? $dashlets[$id]['options'] : array()));
        		}
            	else{
	            	$dashlet = new $dashlets[$id]['className']($id, (isset($dashlets[$id]['options']) ? $dashlets[$id]['options'] : array()));
            	}
                // Need to add support to dynamically display/hide dashlets
                // If it has a method 'shouldDisplay' we will call it to see if we should display it or not
                if (method_exists($dashlet,'shouldDisplay')) {
                    if (!$dashlet->shouldDisplay()) {
                        // This dashlet doesn't want us to show it, skip it.
                        continue;
                    }
                }

            	array_push($dashletIds, $id);

		        $dashlets = $current_user->getPreference('dashlets', 'Home'); // Using hardcoded 'Home' because DynamicAction.php $_REQUEST['module'] value is always Home
		        $lvsParams = array();
		        if(!empty($dashlets[$id]['sort_options'])){
		            $lvsParams = $dashlets[$id]['sort_options'];
    	        }

            	$dashlet->process($lvsParams);
            	try {
	            	$display[$colNum]['dashlets'][$id]['display'] = $dashlet->display();
	            	$display[$colNum]['dashlets'][$id]['displayHeader'] = $dashlet->getHeader();
	            	$display[$colNum]['dashlets'][$id]['displayFooter'] = $dashlet->getFooter();
	            	if($dashlet->hasScript) {
	                	$display[$colNum]['dashlets'][$id]['script'] = $dashlet->displayScript();
	            	}
            	} catch (Exception $ex) {
	            	$display[$colNum]['dashlets'][$id]['display'] = $ex->getMessage();
	            	$display[$colNum]['dashlets'][$id]['displayHeader'] = $dashlet->getHeader();
	            	$display[$colNum]['dashlets'][$id]['displayFooter'] = $dashlet->getFooter();
            	}
        	}
    	}
	}
}


if(!empty($dotb_config['lock_homepage']) && $dotb_config['lock_homepage'] == true) $dotb_smarty->assign('lock_homepage', true);

$dotb_smarty->assign('pages', $pageData);
$dotb_smarty->assign('numPages', sizeof($pages));
$dotb_smarty->assign('loadedPage', 'pageNum_' . $activePage .'_div');

$dotb_smarty->assign('dotbVersion', $dotb_version);
$dotb_smarty->assign('dotbFlavor', $dotb_flavor);
$dotb_smarty->assign('currentLanguage', $GLOBALS['current_language']);
$dotb_smarty->assign('serverUniqueKey', $GLOBALS['server_unique_key']);
$dotb_smarty->assign('imagePath', $GLOBALS['image_path']);

$dotb_smarty->assign('maxCount', empty($dotb_config['max_dashlets_homepage']) ? 15 : $dotb_config['max_dashlets_homepage']);
$dotb_smarty->assign('dashletCount', $count);
$dotb_smarty->assign('dashletIds', '["' . implode('","', $dashletIds) . '"]');
$dotb_smarty->assign('columns', $display);

global $theme;
$dotb_smarty->assign('theme', $theme);

$dotb_smarty->assign('divPages', $divPages);
$dotb_smarty->assign('activePage', $activePage);
$dotb_smarty->assign('numCols', $pages[$activePage]['numColumns']);
$dotb_smarty->assign('default', $defaultHomepage);

$dotb_smarty->assign('current_user', $current_user->id);

$dotb_smarty->assign('lblAdd', $GLOBALS['app_strings']['LBL_ADD_BUTTON']);
$dotb_smarty->assign('lblAddDashlets', $GLOBALS['app_strings']['LBL_ADD_DASHLETS']);
$dotb_smarty->assign('lblLnkHelp', $GLOBALS['app_strings']['LNK_HELP']);
$dotb_smarty->assign('lblAddPage', $GLOBALS['app_strings']['LBL_ADD_PAGE']);
$dotb_smarty->assign('lblPageName', $GLOBALS['app_strings']['LBL_PAGE_NAME']);
$dotb_smarty->assign('lblChangeLayout', $GLOBALS['app_strings']['LBL_CHANGE_LAYOUT']);
$dotb_smarty->assign('lblNumberOfColumns', $GLOBALS['app_strings']['LBL_NUMBER_OF_COLUMNS']);
$dotb_smarty->assign('lbl1Column', $GLOBALS['app_strings']['LBL_1_COLUMN']);
$dotb_smarty->assign('lbl2Column', $GLOBALS['app_strings']['LBL_2_COLUMN']);
$dotb_smarty->assign('lbl3Column', $GLOBALS['app_strings']['LBL_3_COLUMN']);
$dotb_smarty->assign('form_header', getClassicModuleTitle("Home",array(), false));

$dotb_smarty->assign('mod', return_module_language($GLOBALS['current_language'], 'Home'));
$dotb_smarty->assign('app', $GLOBALS['app_strings']);
$dotb_smarty->assign('module', 'Home');
//custom chart code
$dotbChart = DotbChartFactory::getInstance();
$resources = $dotbChart->getChartResources();
$myDotbResources = $dotbChart->getMyDotbChartResources();
$dotb_smarty->assign('chartResources', $resources);
$dotb_smarty->assign('myDotbChartResources', $myDotbResources);
echo $dotb_smarty->fetchCustom('include/MyDotb/tpls/MyDotb.tpl');

//init the quickEdit listeners after the dashlets have loaded on home page the first time
echo"<script>if(typeof(qe_init) != 'undefined'){qe_init();}</script>";
