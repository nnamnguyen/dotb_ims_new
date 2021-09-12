<?php



class TeamsViewTBA extends DotbView
{
    /**
     * @see DotbView::_getModuleTitleParams()
     */
    protected function _getModuleTitleParams($browserTitle = false)
    {
        global $mod_strings;

        return array(
            "<a href='index.php?module=Administration&action=index'>".$mod_strings['LBL_MODULE_NAME']."</a>",
            $mod_strings['LBL_TBA_CONFIGURATION']
        );
    }

    /**
     * @see DotbView::preDisplay()
     */
    public function preDisplay()
    {
        if (!$GLOBALS['current_user']->isAdminForModule('Users')) {
            ACLController::displayNoAccess(true);
            dotb_cleanup(true);
        }

        parent::preDisplay();
    }

    /**
     * @see DotbView::display()
     */
    public function display()
    {
        $dotb_smarty = new Dotb_Smarty();
        $dotb_smarty->assign('APP', $GLOBALS['app_strings']);
        $dotb_smarty->assign('MOD', $GLOBALS['mod_strings']);
        $dotb_smarty->assign('APP_LIST', $GLOBALS['app_list_strings']);
        $dotb_smarty->assign('actionsList', $this->_getUserActionsList());
        $dotb_smarty->assign('moduleTitle', $this->getModuleTitle(false));
        $dotb_smarty->assign('isUserAdmin', $GLOBALS['current_user']->isAdmin());

        $tbaConfigurator = new TeamBasedACLConfigurator();
        $dotb_smarty->assign('config', $tbaConfigurator->getConfig());

        echo $dotb_smarty->fetch(DotbAutoLoader::existingCustomOne('modules/Teams/tpls/TBAConfiguration.tpl'));
    }

    /**
     * Get sorted modules list which are implement TBA and which are not hidden.
     */
    private function _getUserActionsList()
    {
        $tbaConfigurator = new TeamBasedACLConfigurator();
        $modules = $tbaConfigurator->getListOfPublicTBAModules();
        // sort modules by module label
        $modulesTitles = array();
        foreach ($modules as $name) {
            $beanList = array_keys($GLOBALS['beanList']);

            // Prevent empty tabs if module is disabled
            if (in_array($name, $beanList)) {
                $modulesTitles[$name] = $GLOBALS['app_list_strings']['moduleList'][$name];
            }
        }
        asort($modulesTitles);

        return array_keys($modulesTitles);
    }
}
