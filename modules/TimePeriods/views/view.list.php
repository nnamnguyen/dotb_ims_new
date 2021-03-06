<?php



class TimePeriodsViewList extends ViewList
{
    /**
     * Return the "breadcrumbs" to display at the top of the page
     *
     * @param  bool $show_help optional, true if we show the help links
     * @return HTML string containing breadcrumb title
     */
     public function getModuleTitle(
         $show_help = true
         )
    {
    	global $app_list_strings, $mod_strings;

        $warningText = string_format($mod_strings['LBL_LIST_WARNING'], array(
            $app_list_strings['moduleList']['Forecasts'],
            $app_list_strings['moduleList'][$this->module],
        ));

        $float = DotbThemeRegistry::current()->directionality == 'rtl' ? 'right' : 'left';

        $title = '<div><div class="moduleTitle"><h2>' . $app_list_strings['moduleList'][$this->module] . '</h2></div>';
        $title .= "<div class='overdueTask' style='float:{$float}; padding-bottom:10px;'>{$warningText}</div></div>";
        return $title;
    }


 	public function preDisplay()
 	{
 	    global $current_user;
        
        if ( !is_admin($current_user) 
                && !is_admin_for_module($current_user,'Forecasts'))
            dotb_die("Unauthorized access to administration.");
 	    
 		$this->lv = new ListViewSmarty();
 		$this->lv->showMassupdateFields = false;
 	}
}
