<?php


use Dotbcrm\Dotbcrm\SearchEngine\SearchEngine;


/**
 *
 * Globalsearch settings page
 *
 */
class AdministrationViewUnifiedSearchSettings extends DotbView
{
    /**
     * @see DotbView::_getModuleTitleParams()
     */
    protected function _getModuleTitleParams($browserTitle = false)
    {
        global $mod_strings;

        return array(
            "<a href='index.php?module=Administration&action=index'>".translate('LBL_MODULE_NAME', 'Administration')."</a>",
            $mod_strings['LBL_GLOBAL_SEARCH_SETTINGS']
        );
    }

    /**
     * @see DotbView::_getModuleTab()
     */
    protected function _getModuleTab()
    {
        return 'Administration';
    }

    /**
     * @see DotbView::display()
     */
    public function display()
    {
        global $mod_strings, $app_strings, $app_list_strings, $current_user;
        $dotbConfig = DotbConfig::getInstance();

        // Setup smarty template
        $dotb_smarty = new Dotb_Smarty();
        $dotb_smarty->assign('APP', $app_strings);
        $dotb_smarty->assign('MOD', $mod_strings);

        // Enabled/disabled modules list
        $usa = new UnifiedSearchAdvanced();
        $modules = $usa->retrieveEnabledAndDisabledModules();
        $dotb_smarty->assign('enabled_modules', json_encode($modules['enabled']));
        $dotb_smarty->assign('disabled_modules', json_encode($modules['disabled']));

        echo $dotb_smarty->fetch(DotbAutoLoader::existingCustomOne('modules/Administration/templates/UnifiedSearchSettings.tpl'));
    }

    /**
     * Check if engine is available
     * @return boolean
     */
    protected function isAvailable()
    {
        try {
            return SearchEngine::getInstance()->isAvailable(true);
        } catch (Exception $e) {
            return false;
        }
    }
}
