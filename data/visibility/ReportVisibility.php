<?php


/**
 * Visibility limitations for Reports
 * @api
 */
class ReportVisibility extends DotbVisibility
{
    protected $disallowed_modules;

    /**
     * (non-PHPdoc)
     * @see DotbVisibility::addVisibilityWhere()
     */
    public function addVisibilityWhere(&$query)
    {
        global $current_user;
        if (!empty($current_user) && $current_user->isAdminForModule("Reports")) {
            return $query;
        }

        $table_alias = $this->getOption('table_alias');
        if(empty( $table_alias)) {
            $table_alias = $this->bean->table_name;
        }

        $disallowed_modules = $this->getDisallowedModules();

        if($disallowed_modules) {
            $db = DBManagerFactory::getInstance();
            $literals = array();
            foreach ($disallowed_modules as $module) {
                $literals[] = $db->quoted($module);
            }
            $where_clause = $table_alias . '.module NOT IN (' . implode(', ', $literals) .')';
            if(!empty($query)) {
                $query .= " AND $where_clause";
            } else {
                $query = $where_clause;
            }
        }
        return $query;
    }

    /**
     * Get list of modules not allowed for reporting
     * @return array
     */
    public function getDisallowedModules()
    {
        if(!is_null($this->disallowed_modules)) {
            return $this->disallowed_modules;
        }
        if(empty($GLOBALS['report_modules'])) {
            require_once 'modules/Reports/config.php';
            if(empty($GLOBALS['report_modules'])) {
                // this shouldn't happen but if it does, no modules for you
                return array_keys($GLOBALS['beanList']);
            }
        }
        $this->disallowed_modules = array();
        foreach($GLOBALS['report_modules'] as $module => $name) {
            $seed = BeanFactory::newBean($module);
            if(empty($seed) || !$seed->ACLAccess("view")) {
                $this->disallowed_modules[] = $module;
            }
        }
        return $this->disallowed_modules;
    }

    public function addVisibilityWhereQuery(DotbQuery $dotbQuery, $options = array()) {
        $where = null;
        $this->addVisibilityWhere($where, $options);
        if(!empty($where)) {
            $dotbQuery->where()->addRaw($where);
        }

        return $dotbQuery;
    }
}
