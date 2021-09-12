<?php

/*********************************************************************************
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/



class MyModulesUsedChartDashlet extends DashletGenericChart 
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
     * @param string $text Ignored
     * @see DashletGenericChart::display()
     */
    public function display($text = '')
    {
        global $db,$app_list_strings;
        
        require("modules/Charts/chartdefs.php");
        $chartDef = $chartDefs['my_modules_used_last_30_days'];
        
        $dotbChart = DotbChartFactory::getInstance();
        $dotbChart->setProperties('',  translate('LBL_MY_MODULES_USED_SIZE', 'Charts'), $chartDef['chartType']);
        $dotbChart->base_url = $chartDef['base_url'];
        $dotbChart->group_by = $chartDef['groupBy'];
        $dotbChart->url_params = array();		
        $result = $db->query($this->constructQuery());
        $dataset = array();
        while ($row = $db->fetchByAssoc($result))
        {
        	$dataset[translate($row['module_name'])] =  $row['count'];
        }
        $dotbChart->setData($dataset);
        $xmlFile = $dotbChart->getXMLFileName($this->id);
        $dotbChart->saveXMLFile($xmlFile, $dotbChart->generateXML());
        
        return $this->getTitle('<div align="center"></div>') . '<div align="center">' . $dotbChart->display($this->id, $xmlFile, '100%', '480', false) . '</div><br />'. $this->processAutoRefresh();
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
        return "SELECT tracker.module_name as module_name ,COUNT(*) count " .
                    "FROM tracker " .
                    "WHERE tracker.user_id = '{$GLOBALS['current_user']->id}' " .
                        "AND tracker.module_name != 'UserPreferences' AND tracker.date_modified > ".db_convert("'".gmdate($GLOBALS['timedate']->get_db_date_time_format(), strtotime("- 30 days"))."'" ,"datetime")." " .
                        "GROUP BY tracker.module_name ORDER BY count DESC";
	}
}
