<?php




class TopCampaignsDashlet extends Dashlet 
{ 
	protected $top_campaigns = array();
	
	/**
	 * Constructor
	 *
	 * @see Dashlet::Dashlet()
	 */
	public function __construct($id, $def = null) 
	{
        global $current_user, $app_strings;
        parent::__construct($id);
        $this->isConfigurable = true;
        $this->isRefreshable = true;        

        if(empty($def['title'])) { 
            $this->title = translate('LBL_TOP_CAMPAIGNS', 'Campaigns');
        } 
        else {
            $this->title = $def['title'];
        }
        
        if(isset($def['autoRefresh'])) $this->autoRefresh = $def['autoRefresh'];
        
        $this->seedBean = BeanFactory::newBean('Opportunities');      

       	$qry = "SELECT C.name AS campaign_name, SUM(O.amount) AS revenue, C.id as campaign_id " .
			   "FROM campaigns C, opportunities O " .
			   "WHERE C.id = O.campaign_id " . 
			   "AND O.sales_stage = '".Opportunity::STAGE_CLOSED_WON."' " .
               "AND O.deleted = 0 " .
			   "GROUP BY C.name,C.id ORDER BY revenue desc";

		$result = $this->seedBean->db->limitQuery($qry, 0, 10);
		$row = $this->seedBean->db->fetchByAssoc($result);

		while ($row != null){
			array_push($this->top_campaigns, $row);
			$row = $this->seedBean->db->fetchByAssoc($result);			
		}
    }
    
    /**
	 * @see Dashlet::display()
	 */
    public function display($text = '')
	{
    	$ss = new Dotb_Smarty();
    	$ss->assign('lbl_campaign_name', translate('LBL_TOP_CAMPAIGNS_NAME', 'Campaigns'));
    	$ss->assign('lbl_revenue', translate('LBL_TOP_CAMPAIGNS_REVENUE', 'Campaigns'));    	
    	$ss->assign('top_campaigns', $this->top_campaigns);
    	
        return parent::display($text)
            . $ss->fetch('modules/Campaigns/Dashlets/TopCampaignsDashlet/TopCampaignsDashlet.tpl');
    }
    
    /**
	 * @see Dashlet::displayOptions()
	 */
	public function displayOptions() 
    {
        $ss = new Dotb_Smarty();
        $ss->assign('titleLBL', translate('LBL_DASHLET_OPT_TITLE', 'Home'));
        $ss->assign('title', $this->title);
        $ss->assign('id', $this->id);
        $ss->assign('saveLBL', $GLOBALS['app_strings']['LBL_SAVE_BUTTON_LABEL']);
        if($this->isAutoRefreshable()) {
       		$ss->assign('isRefreshable', true);
			$ss->assign('autoRefresh', $GLOBALS['app_strings']['LBL_DASHLET_CONFIGURE_AUTOREFRESH']);
			$ss->assign('autoRefreshOptions', $this->getAutoRefreshOptions());
			$ss->assign('autoRefreshSelect', $this->autoRefresh);
		}
        
		return $ss->fetch('modules/Opportunities/Dashlets/MyClosedOpportunitiesDashlet/MyClosedOpportunitiesDashletConfigure.tpl');        
    }

    /**
	 * @see Dashlet::saveOptions()
	 */
	public function saveOptions($req) 
    {
        $options = array();
        
        if ( isset($req['title']) ) {
            $options['title'] = $req['title'];
        }
        $options['autoRefresh'] = empty($req['autoRefresh']) ? '0' : $req['autoRefresh'];
        
        return $options;
    }
}
