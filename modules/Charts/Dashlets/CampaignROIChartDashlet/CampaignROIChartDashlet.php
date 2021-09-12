<?php





class CampaignROIChartDashlet extends DashletGenericChart 
{
    public $campaign_id;
    
    /**
     * @see DashletGenericChart::$_seedName
     */
    protected $_seedName = 'Campaigns';
    
    /**
     * @see DashletGenericChart::displayOptions()
     */
    public function displayOptions() 
    {
        $this->getSeedBean()->disable_row_level_security = false;

        $campaigns = $this->getSeedBean()->get_full_list("","");
    	if ( $campaigns != null )
            foreach ($campaigns as $c)
                $this->_searchFields['campaign_id']['options'][$c->id] = $c->name;
    	else 
            $this->_searchFields['campaign_id']['options'] = array();
            
        return parent::displayOptions();
    }   
    
    /**
     * @see DashletGenericChart::display()
     */
    public function display()
    {

        $roi_chart = new campaign_charts();
        $chartStr = $roi_chart->campaign_response_roi(
            $GLOBALS['app_list_strings']['roi_type_dom'],
            $GLOBALS['app_list_strings']['roi_type_dom'],
            $this->campaign_id[0],null,true,true,true,$this->id);
        
		$returnStr = $chartStr;
		
        return $this->getTitle('<div align="center"></div>') . '<div align="center">' . $returnStr . '</div>'. $this->processAutoRefresh();
    }
}
