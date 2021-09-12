<?php
require_once('include/MVC/View/views/view.list.php');

class TeamsViewList extends ViewList
{
    public function preDisplay()
    {
        //bug #46690: Developer Access to Users/Teams/Roles
        if (!$GLOBALS['current_user']->isAdminForModule('Users') && !$GLOBALS['current_user']->isDeveloperForModule('Users'))
            dotb_die("Unauthorized access to administration.");


        //Customize Team Management - By Lap Nguyen
        include_once("custom/modules/Teams/_helper.php");
        $ss = new Dotb_Smarty();
        $region = $GLOBALS['app_list_strings']['region_list'];
        $nodes = getTeamNodes();
        $ss->assign("MOD", $GLOBALS['mod_strings']);
        $ss->assign("NODES", json_encode($nodes));
        $ss->assign("APPS", $GLOBALS['app_strings']);
        $ss->assign("CURRENT_USER_ID", $GLOBALS['current_user']->id);

        $detail = getTeamDetail('1');
        $ss->assign("team_name", $detail['team']['team_name']);
        $ss->assign("legal_name", $detail['team']['legal_name']);
        $ss->assign("short_name", $detail['team']['short_name']);
        $ss->assign("prefix", $detail['team']['prefix']);
        $ss->assign("phone_number", $detail['team']['phone_number']);
        $ss->assign("team_id", $detail['team']['team_id']);
        $ss->assign("parent_name", $detail['team']['parent_name']);
        $ss->assign("parent_id", $detail['team']['parent_id']);
        $ss->assign("manager_user_id", $detail['team']['manager_user_id']);
        $ss->assign("manager_user_name", $detail['team']['manager_user_name']);
        $ss->assign("description", $detail['team']['description']);
        $ss->assign("count_user", $detail['team']['count_user']);
        $ss->assign("region", $detail['team']['region']);
        $ss->assign("select_region", $region);

        echo $ss->fetch('custom/modules/Teams/tpls/TeamManagement.tpl');
        dotb_die();
    }
}
