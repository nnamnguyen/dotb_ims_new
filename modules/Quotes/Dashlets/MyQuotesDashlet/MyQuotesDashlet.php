<?php





class MyQuotesDashlet extends DashletGeneric { 
    public function __construct($id, $def = null)
    {
        global $current_user, $app_strings;
		require('modules/Quotes/Dashlets/MyQuotesDashlet/MyQuotesDashlet.data.php');
		
        parent::__construct($id, $def);
        
        if(empty($def['title'])) $this->title = translate('LBL_LIST_MY_QUOTES', 'Quotes');
        $this->searchFields = $dashletData['MyQuotesDashlet']['searchFields'];
        $this->columns = $dashletData['MyQuotesDashlet']['columns'];
        $this->seedBean = BeanFactory::newBean('Quotes');        
    }
}
