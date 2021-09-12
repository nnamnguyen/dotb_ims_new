<?php





class MyCasesDashlet extends DashletGeneric { 
    public function __construct($id, $def = null)
    {
        global $current_user, $app_strings;
		require('modules/Cases/Dashlets/MyCasesDashlet/MyCasesDashlet.data.php');
		
        parent::__construct($id, $def);
        
        if(empty($def['title'])) $this->title = translate('LBL_LIST_MY_CASES', 'Cases');
        $this->searchFields = $dashletData['MyCasesDashlet']['searchFields'];
        $this->columns = $dashletData['MyCasesDashlet']['columns'];
        $this->seedBean = BeanFactory::newBean('Cases');        
    }
}
