<?php






class MyLeadsDashlet extends DashletGeneric { 
    public function __construct($id, $def = null)
    {
        global $current_user, $app_strings;
		require('modules/Leads/Dashlets/MyLeadsDashlet/MyLeadsDashlet.data.php');
		
        parent::__construct($id, $def);
         
        if(empty($def['title'])) $this->title = translate('LBL_LIST_MY_LEADS', 'Leads');
        
        $this->searchFields = $dashletData['MyLeadsDashlet']['searchFields'];
        $this->columns = $dashletData['MyLeadsDashlet']['columns'];
        $this->seedBean = BeanFactory::newBean('Leads');        
    }
}
