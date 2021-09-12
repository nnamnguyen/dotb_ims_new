<?php



class TeamsViewList extends ViewList
{
    public function preDisplay()
    {
        //bug #46690: Developer Access to Users/Teams/Roles
        if (!$GLOBALS['current_user']->isAdminForModule('Users') && !$GLOBALS['current_user']->isDeveloperForModule('Users'))
            dotb_die("Unauthorized access to administration.");

        parent::preDisplay();
    }

    public function display()
    {
        $dotbSmarty = new Dotb_Smarty();
        echo $dotbSmarty->fetch(DotbAutoLoader::existingCustomOne('modules/Teams/tpls/Errors.tpl'));
        parent::display();
    }
}
