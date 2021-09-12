<?php

/*********************************************************************************
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/



class MyTeamModulesUsedChartDashlet extends DashletGenericChart
{
    /**
     * @see Dashlet::$isConfigurable
     */
    public $isConfigurable = true;
    
    /**
     * @see DashletGenericChart::$_seedName
     */
    protected $_seedName = 'Trackers';
    
    /**
     * @see Dashlet::$isConfigPanelClearShown
     */
    public $isConfigPanelClearShown = false;
    
    /**
     * @see DashletGenericChart::display()
     */
    public function display() 
    {
        global $db;

        require("modules/Charts/chartdefs.php");
        $chartDef = $chartDefs['my_team_modules_used_last_30_days'];

        $dotbChart = DotbChartFactory::getInstance();
        $dotbChart->forceHideDataGroupLink = true;
        $dotbChart->setProperties('', $chartDef['chartUnits'], $chartDef['chartType']);
        $dotbChart->group_by = $chartDef['groupBy'];
        $dotbChart->url_params = array();

        $result = $db->query($this->constructQuery());
        $dataset = array();
        while(($row = $db->fetchByAssoc($result)))
            $dataset[] = array('user_name'=>$row['user_name'], 'module_name'=>$row['module_name'], 'total'=>$row['count']);

        $dotbChart->setData($dataset);

        $xmlFile = $dotbChart->getXMLFileName($this->id);
        $dotbChart->saveXMLFile($xmlFile, $dotbChart->generateXML());
	
        return $this->getTitle('<div align="center"></div>') . 
            '<div align="center">' . $dotbChart->display($this->id, $xmlFile, '100%', '480', false) . '</div>'. $this->processAutoRefresh();
	}

    /**
     * @see Dashlet::hasAccess()
     */
    public function hasAccess()
    {
    	return ACLController::checkAccess('Trackers', 'view', false, 'Tracker');
    }	
	
    /**
     * @see DashletGenericChart::constructQuery()
     */
    protected function constructQuery() 
    {
		return "SELECT l1.user_name, tracker.module_name, count(*) count " .
                    "FROM tracker INNER JOIN users l1 ON l1.id = tracker.user_id and l1.deleted = 0 " .
                    "WHERE tracker.deleted = 0 AND tracker.date_modified > ".db_convert("'".$GLOBALS['timedate']->getNow()->modify("-30 days")->asDb()."'" ,"datetime")." " .
                        "AND tracker.user_id in (Select id from users where reports_to_id = '{$GLOBALS['current_user']->id}') " .
                    "GROUP BY l1.user_name, tracker.module_name " .
                    "ORDER BY l1.user_name ASC";
	}
}
