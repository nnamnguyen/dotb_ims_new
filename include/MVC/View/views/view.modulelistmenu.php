<?php




class ViewModulelistmenu extends DotbView
{
 	public function __construct()
 	{
 		$this->options['show_title'] = false;
		$this->options['show_header'] = false;
		$this->options['show_footer'] = false; 	  
		$this->options['show_javascript'] = false; 
		$this->options['show_subpanels'] = false; 
		$this->options['show_search'] = false; 
        parent::__construct();
 	}	
 	
 	public function display()
 	{
 	    $tracker = BeanFactory::newBean('Trackers');
        $history = $tracker->get_recently_viewed($GLOBALS['current_user']->id,$this->module);
        foreach ( $history as $key => $row ) {
            $history[$key]['item_summary_short'] = getTrackerSubstring($row['item_summary']);
            $history[$key]['image'] = DotbThemeRegistry::current()
                ->getImage($row['module_name'],'border="0" align="absmiddle"',null,null,'.gif',$row['item_summary']);

        }
        $this->ss->assign('LAST_VIEWED',$history);
 	    
 		$this->ss->display('include/MVC/View/tpls/modulelistmenu.tpl');
 	}
}
