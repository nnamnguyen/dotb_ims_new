<?php




class MyOpportunitiesGaugeDashlet extends DashletGenericChart 
{
    /**
     * @see DashletGenericChart::$_seedName
     */
    protected $_seedName = 'Opportunities';
    
    /**
     * @see Dashlet::$isConfigPanelClearShown
     */
    public $isConfigPanelClearShown = false;
    
    /**
     * @see DashletGenericChart::__construct()
     */
    public function __construct(
        $id, 
        array $options = null
        ) 
    {
        if (empty($options['title'])) 
            $options['title'] = translate('LBL_MY_CLOSED_OPPORTUNITIES_GAUGE', 'Home');
        
        parent::__construct($id,$options);
    }
    
    /**
     * @see DashletGenericChart::display()
     */
    public function display() 
    {
        require('modules/Charts/chartdefs.php');
        $chartDef = $chartDefs['opportunities_this_quarter'];
		
        $dotbChart = DotbChartFactory::getInstance();
        $dotbChart->setProperties('', translate('LBL_NUMBER_OF_OPPS', 'Charts'), $chartDef['chartType']);
        $dotbChart->base_url = $chartDef['base_url'];
        $dotbChart->group_by = $chartDef['groupBy'];
        $dotbChart->url_params = array();
        
        // get gauge target
        $qry = "SELECT * from opportunities WHERE assigned_user_id = '" . $GLOBALS['current_user']->id . "' AND deleted=0";
        $result = $this->getSeedBean()->db->query($this->getSeedBean()->create_list_count_query($qry));	
        $row = $this->getSeedBean()->db->fetchByAssoc($result);
        $dotbChart->setDisplayProperty('gaugeTarget', $row['c']);
        
        $dotbChart->getData($this->constructQuery());
        
        $xmlFile = $dotbChart->getXMLFileName($this->id);
        $dotbChart->saveXMLFile($xmlFile, $dotbChart->generateXML());
        
        return $this->getTitle('<div align="center"></div>') . '<div align="center">' .$dotbChart->display($this->id, $xmlFile, '100%', '480', false) . '</div><br />'. $this->processAutoRefresh();
    }  
    
    /**
     * @see DashletGenericChart::constructQuery()
     */
    protected function constructQuery() 
    {
		return "SELECT count(*) AS num " . 
				 "FROM opportunities " .
				 "WHERE assigned_user_id = '{$GLOBALS['current_user']->id}' " .
                    "AND sales_stage = '".Opportunity::STAGE_CLOSED_WON."' AND deleted=0" ;
    }
    
    /**
     * @see DashletGenericChart::constructGroupBy()
     */
    protected function constructGroupBy()
    {
    	return array( 'sales_stage', 'user_name', );
    }
}
