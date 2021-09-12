<?php






class MyContactsDashlet extends DashletGeneric { 
    public function __construct($id, $def = null)
    {
        global $current_user, $app_strings;
		require('modules/Contacts/Dashlets/MyContactsDashlet/MyContactsDashlet.data.php');
        
        parent::__construct($id, $def);

        if(empty($def['title'])) $this->title = translate('LBL_HOMEPAGE_TITLE', 'Contacts');
        
        $this->searchFields = $dashletData['MyContactsDashlet']['searchFields'];
        $this->columns = $dashletData['MyContactsDashlet']['columns'];
                                                             
        $this->seedBean = BeanFactory::newBean('Contacts');        
    }
}
