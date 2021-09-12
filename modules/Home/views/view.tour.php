<?php




class HomeViewTour extends DotbView
{
    public function display()
    {
        global $dotb_flavor;
        global $current_user;
        global $app_strings;
        global $app_list_strings;
        $mod_strings = return_module_language($GLOBALS['current_language'], 'Home');
        $this->ss->assign('mod', $mod_strings);
        $this->ss->assign("dotbFlavor", $dotb_flavor);
        $this->ss->assign("appList", $app_list_strings);

       //check the upgrade history to see if this instance has been upgraded, if so then present the calendar url message
       //if no upgrade history exists then we can assume this is an install and we do not show the calendar message
       $uh = new UpgradeHistory();
       $upgrade = count($uh->getAll())>0 ? true : false;
       if($upgrade)
       {
            //create the url with the user id and scrolltocal flag.  This will be passed into language string
            $urlForString = $app_strings['LBL_TOUR_CALENDAR_URL_1'];
            $urlForString .= '<br><a href="index.php?module=Users&action=EditView&record='.$current_user->id.'&scrollToCal=true" target="_blank">';
            $urlForString .= $app_strings['LBL_TOUR_CALENDAR_URL_2'].'</a>';
            $this->ss->assign('view_calendar_url', $urlForString );
       }
       $this->ss->display('modules/Home/tour.tpl');

    }

}
?>
