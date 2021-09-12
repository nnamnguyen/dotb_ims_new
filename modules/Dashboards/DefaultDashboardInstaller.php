<?php


/**
 *  DefaultDashboardInstaller is used to build the default dashboards.
 */
class DefaultDashboardInstaller
{
    private $globalTeamId = '1';

    /**
     * Builds the default dashboards in the database using the dashboard files.
     *
     * @param array $modules The list of modules available in Dotb
     */
    public function buildDashboardsFromFiles(array $modules)
    {
        // Loop over each module to get each module's dashboard directory
        foreach ($modules as $module) {
            $moduleDir = "modules/$module/dashboards/";
            $layoutDirs = $this->getSubDirs($moduleDir);

            // Loop over each module's dashboard views to get each view dir
            foreach ($layoutDirs as $layoutDir) {
                $layout = basename($layoutDir);
                $dashboardFiles = $this->getPhpFiles($layoutDir);

                // Loop over each dashboard within the view dir
                foreach ($dashboardFiles as $dashboardFile) {
                    $dashboardContents = $this->getFileContents($dashboardFile);
                    if (!$dashboardContents) {
                        continue;
                    }

                    $this->setupSavedReportDashlets($dashboardContents['metadata']);

                    $dashboardProperties = array(
                        'name' => $dashboardContents['name'],
                        'dashboard_module' => $module,
                        'view_name' => $module !== 'Home' ? $layout : null,
                        'metadata' => json_encode($dashboardContents['metadata']),
                        'default_dashboard' => true,
                        'team_id' => $this->globalTeamId,
                    );
                    $dashboardBean = $this->getNewDashboardBean();
                    $this->storeDashboard($dashboardBean, $dashboardProperties);
                }
            }
        }
    }

    protected function translateSavedReportTitle($title)
    {
        return translate($title, 'Reports');
    }

    /**
     * Adds saved_report_id to metadata for saved report dashlets
     * @param array $metadata
     */
    public function setupSavedReportDashlets(&$metadata)
    {
        if (!empty($metadata['components'])) {
            for ($i = 0; $i < count($metadata['components']); $i++) {
                if (!empty($metadata['components'][$i]['rows'])) {
                    for ($j = 0; $j < count($metadata['components'][$i]['rows']); $j++) {
                        for ($k = 0; $k < count($metadata['components'][$i]['rows'][$j]); $k++) {
                            if (!empty($metadata['components'][$i]['rows'][$j][$k]['view'])) {
                                $view = &$metadata['components'][$i]['rows'][$j][$k]['view'];
                                if (!empty($view['type']) && $view['type'] == 'saved-reports-chart' && empty($view['saved_report_id'])) {
                                    if (!empty($view['saved_report_key'])) {
                                        $title = $this->translateSavedReportTitle($view['saved_report_key']);
                                        if (empty($view['label'])) {
                                            $view['label'] = $title;
                                        }
                                        if (empty($view['saved_report'])) {
                                            $view['saved_report'] = $title;
                                        }
                                        // Assume OOB report names are unique
                                        $report = BeanFactory::getBean('Reports');
                                        $view['saved_report_id'] = $report->retrieveReportIdByName($title);
                                    }
                                    if (empty($view['saved_report_id'])) {
                                        // Remove this dashlet because we can't find the report
                                        installLog("removed invalid report dashlet: " . print_r($metadata['components'][$i]['rows'][$j][$k], true));
                                        unset($metadata['components'][$i]['rows'][$j][$k]);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    /**
     * Given a directory, returns all its subdirectories.
     *
     * @param string $dir The base directory
     * @return array Array of subdirectories
     */
    public function getSubDirs($dir)
    {
        return glob($dir . '/*' , GLOB_ONLYDIR);
    }

    /**
     * Given a directory, returns all the php files in it.
     *
     * @param string $dir The base directory
     * @return array Array of .php files
     */
    public function getPhpFiles($dir)
    {
        return glob($dir . '/*.php');
    }

    /**
     * Retrieves data from the specified file.
     *
     * @param string $dashboardFile The file to  data.
     *
     * @return array The data from the affiliated file.
     */
    public function getFileContents($dashboardFile)
    {
        return include $dashboardFile;
    }

    /**
     * Using the supplied properties, create and store a new dashboard bean.
     *
     * @param DotbBean $dashboardBean The dashboard bean to populate.
     * @param array $properties The properties to store to the dashboard bean.
     */
    public function storeDashboard($dashboardBean, $properties)
    {
        foreach ($properties as $key => $value) {
            $dashboardBean->$key = $value;
        }
        $dashboardBean->save();
    }

    /**
     * Creates a new blank dashboard bean.
     *
     * @return DotbBean
     */
    public function getNewDashboardBean()
    {
        return BeanFactory::newBean('Dashboards');
    }

    /**
     * Retrieve a system user.
     *
     * @return User A system user.
     */
    public function getAdminUser()
    {
        $user = BeanFactory::newBean('Users');
        if (empty($user)) {
            throw new DotbException('Unable to retrieve user bean.');
        }
        return $user->getSystemUser();
    }

    /**
     * Builds the default dashboards in the database using metadata.
     *
     * @param array $metadata The standard application metadata.
     */
    public function buildDashboardsFromMetadata(array $metadata)
    {
        $adminUser = $this->getAdminUser();
        $adminUserId = $adminUser->id;

        // Maps between the name of the old OOTB dashboard layout name and the
        // view_name to which it refers.
        $layoutToNameMap = array(
            'record-dashboard' => 'record',
            'list-dashboard' => 'records',
        );

        $layouts = array_keys($layoutToNameMap);
        $modules = array_keys($metadata['modules']);

        foreach ($modules as $module) {
            foreach ($layouts as $layout) {
                $moduleLayouts = $metadata['modules'][$module]['layouts'];

                // Some modules only have one dashboard.
                if (!isset($moduleLayouts[$layout])) {
                    continue;
                }

                $dashboardContents = $moduleLayouts[$layout]['meta'];
                $viewName = $module !== 'Home' ? $layoutToNameMap[$layout] : null;
                $dashboardProperties = array(
                    'name' => $dashboardContents['name'],
                    'dashboard_module' => $module,
                    'view_name' => $viewName,
                    'metadata' => json_encode($dashboardContents['metadata']),
                    'default_dashboard' => true,
                    'team_id' => $this->globalTeamId,
                    'assigned_user_id' => $adminUserId,
                    'set_created_by' => false,
                    'created_by' => $adminUserId,
                    'update_modified_by' => false,
                    'modified_user_id' => $adminUserId,
                );

                $dashboardBean = $this->getNewDashboardBean();
                $this->storeDashboard($dashboardBean, $dashboardProperties);
            }
        }
    }
}
