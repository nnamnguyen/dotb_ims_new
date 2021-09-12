<?php






class MyProjectTaskDashlet extends DashletGeneric { 
    public function __construct($id, $def = null)
    {
        global $current_user, $app_strings;
		require('modules/ProjectTask/Dashlets/MyProjectTaskDashlet/MyProjectTaskDashlet.data.php');
		
        parent::__construct($id, $def);
        
        if(empty($def['title'])) $this->title = translate('LBL_LIST_MY_PROJECT_TASKS', 'ProjectTask');
        
        $this->searchFields = $dashletData['MyProjectTaskDashlet']['searchFields'];
        $this->columns = $dashletData['MyProjectTaskDashlet']['columns'];
        
        $this->seedBean = BeanFactory::newBean('ProjectTask');        
    }
    
    function buildWhere()
    {
        $resultArray = parent::buildWhere();
        
        $resultArray[] = $this->seedBean->table_name . '.' . "percent_complete != 100";

        return $resultArray;
    }
}
