<?php






class MyTasksDashlet extends DashletGeneric { 
    public function __construct($id, $def = null)
    {
        global $current_user, $app_strings;
		require('modules/Tasks/Dashlets/MyTasksDashlet/MyTasksDashlet.data.php');
		
        parent::__construct($id, $def);
        
        if(empty($def['title'])) $this->title = translate('LBL_LIST_MY_TASKS', 'Tasks');

        $this->searchFields = $dashletData['MyTasksDashlet']['searchFields'];
        $this->columns = $dashletData['MyTasksDashlet']['columns'];
                
        $this->seedBean = BeanFactory::newBean('Tasks');        
    }    
}
