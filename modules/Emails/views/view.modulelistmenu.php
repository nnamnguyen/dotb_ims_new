<?php




class EmailsViewModulelistmenu extends ViewModulelistmenu
{
 	public function display()
 	{
 	    $tracker = BeanFactory::newBean('Trackers');
        $history = $tracker->get_recently_viewed($GLOBALS['current_user']->id, array('Emails','EmailTemplates'));
        foreach ( $history as $key => $row ) {
            $history[$key]['item_summary_short'] = getTrackerSubstring($row['item_summary']);
            $history[$key]['image'] = DotbThemeRegistry::current()
                ->getImage($row['module_name'],'border="0" align="absmiddle"', null,null,'.gif',$row['item_summary']);

        }
        $this->ss->assign('LAST_VIEWED',$history);
 	    
 		$this->ss->display('include/MVC/View/tpls/modulelistmenu.tpl');
 	}
}
?>
