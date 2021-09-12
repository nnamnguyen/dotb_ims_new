<?php


require_once('modules/Reports/SavedReport.php');

class ReportsSearchApi extends PersonFilterApi
{
    public function registerApiRest()
    {
        return array(
            'ReportSearch' => array(
                'reqType' => 'GET',
                'path' => array('Reports'),
                'pathVars' => array('module_list'),
                'method' => 'filterList',
                'shortHelp' => 'Search Reports',
                'longHelp' => 'include/api/help/getListModule.html',
            ),
        );
    }

    /**
     * Gets the proper query where clause to use to prevent special user types from
     * being returned in the result
     *
     * @param string $module The name of the module we are looking for
     * @param DotbQuery|null
     * @return string
     */
    protected function getCustomWhereForModule($module, $query = null)
    {
        $ACLUnAllowedModules = getACLDisAllowedModules();

        if ($query instanceof DotbQuery) {
            foreach ($ACLUnAllowedModules as $module => $class_name) {
                $query->where()->notEquals('saved_reports.module', $module);
            }
            return;
        }

        $where_clauses = array();
        foreach ($ACLUnAllowedModules as $module => $class_name) {
            array_push($where_clauses, "saved_reports.module != '$module'");
        }

        return implode(' AND ', $where_clauses);
    }
}
