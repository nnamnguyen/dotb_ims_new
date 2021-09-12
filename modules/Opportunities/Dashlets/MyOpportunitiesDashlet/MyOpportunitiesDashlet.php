<?php






class MyOpportunitiesDashlet extends DashletGeneric { 
    public function __construct($id, $def = null)
    {
        global $current_user, $app_strings, $dashletData;
		require('modules/Opportunities/Dashlets/MyOpportunitiesDashlet/MyOpportunitiesDashlet.data.php');
        
        parent::__construct($id, $def);

        if(empty($def['title'])) $this->title = translate('LBL_TOP_OPPORTUNITIES', 'Opportunities');
         
        $this->searchFields = $dashletData['MyOpportunitiesDashlet']['searchFields'];
        $this->columns = $dashletData['MyOpportunitiesDashlet']['columns'];
        
        $this->seedBean = BeanFactory::newBean('Opportunities');        
    }
    
    //4.5.0g fix for upgrade issue where user_preferences table still refer to column as 'amount'
    function process($lvsParams = array()) {
     	if(!empty($this->displayColumns)) {
     	if(array_search('amount', $this->displayColumns)) {
     		$this->displayColumns[array_search('amount', $this->displayColumns)] = 'amount_usdollar';
     	}
     	}
     	parent::process($lvsParams);
    }    
    
}
