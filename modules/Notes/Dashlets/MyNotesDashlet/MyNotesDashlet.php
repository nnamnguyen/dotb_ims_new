<?php




class MyNotesDashlet extends DashletGeneric { 
    public function __construct($id, $def = null)
    {
        global $current_user, $app_strings, $dashletData;
		require('modules/Notes/Dashlets/MyNotesDashlet/MyNotesDashlet.data.php');
        
        parent::__construct($id, $def);

        if(empty($def['title'])) $this->title = translate('LBL_MY_NOTES_DASHLETNAME', 'Notes');
         
        $this->searchFields = $dashletData['MyNotesDashlet']['searchFields'];
        $this->columns = $dashletData['MyNotesDashlet']['columns'];
        
        $this->seedBean = BeanFactory::newBean('Notes');        
    }    
}
