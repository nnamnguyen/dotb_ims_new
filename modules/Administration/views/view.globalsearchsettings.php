<?php


use Dotbcrm\Dotbcrm\SearchEngine\SearchEngine;
use Dotbcrm\Dotbcrm\SearchEngine\AdminSettings;


/**
 *
 * Globalsearch settings page
 *
 */
class AdministrationViewGlobalsearchsettings extends DotbView
{
    /**
     * These modules are blacklisted by default. In the case of the Tags module,
     * Elastic fails to search if it is disabled so Tags is always enabled and
     * thus should never be allowed on the admin screen.
     * @var array
     */
    protected $blackListedModules= array(
        'Tags' => 1,
    );

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
     * Cleanses the existing modules lists, both enabled and disabled, to ensure
     * that modules that should not be included are not included.
     * @param array $modules The full collection of modules for display
     * @return array
     */
    protected function cleanseModuleLists($modules)
    {
        $return = array();

        // In this case, $type will be enabled|disabled_modules
        foreach ($modules as $type => $data) {
            // Setup the variable that will return $type data
            $typeData = array();

            // $data is the collection of modules for each type
            foreach ($data as $k => $v) {
                if (isset($this->blackListedModules[$v['module']])) {
                    continue;
                }

                // Set the updated data
                $typeData[] = $v;
            }

            // Read the type data back into the type
            $return[$type] = $typeData;
        }

        return $return;
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
        $ftsAdmin = new AdminSettings();
        $modules = $ftsAdmin->getModuleList();

        // Handle cleansing of blacklisted modules
        $modules = $this->cleanseModuleLists($modules);

        $dotb_smarty->assign('enabled_modules', json_encode($modules['enabled_modules']));
        $dotb_smarty->assign('disabled_modules', json_encode($modules['disabled_modules']));

        // List of available engines
        // TODO: make engines dynamic again
        $defaultEngine = 'Elastic';
        $dotb_smarty->assign("fts_type", get_select_options_with_id($app_list_strings['fts_type'], $defaultEngine));

        // Engine configuration, use defaults in case we cannot find one
        $engineConfig = $dotbConfig->get('full_text_engine.' . $defaultEngine, false);
        if (!$engineConfig) {
            $engineConfig = array('host' => '127.0.0.1', 'port' => '9200');
        }
        $dotb_smarty->assign("fts_host", $engineConfig['host']);
        $dotb_smarty->assign("fts_port", $engineConfig['port']);

        // Hide schedule button if no valid connection
        $showSchedButton = $this->isAvailable();
        $dotb_smarty->assign("showSchedButton", $showSchedButton);

        // Reindex scheduled button
        $justRequestedAScheduledIndex = !empty($_REQUEST['sched']) ? true : false;
        $dotb_smarty->assign('justRequestedAScheduledIndex', $justRequestedAScheduledIndex);

        // Hide FTS configuration
        $hide_fts_config = (bool) $dotbConfig->get('hide_full_text_engine_config', false);
        $dotb_smarty->assign("hide_fts_config", $hide_fts_config);

        echo $dotb_smarty->fetch(DotbAutoLoader::existingCustomOne('modules/Administration/templates/GlobalSearchSettings.tpl'));
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
