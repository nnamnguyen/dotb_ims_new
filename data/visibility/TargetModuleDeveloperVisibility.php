<?php


/**
 * ACL Visiblity driven by a related module.
 * Only supports DotbQuery
 */
class TargetModuleDeveloperVisibility extends ACLVisibility
{

    protected $targetModuleField = "";

    /**
     * @param DotbBean $bean
     */
    public function __construct($bean, $options)
    {
        if (!empty($options['targetModuleField'])) {
            $this->targetModuleField = $options['targetModuleField'];
        }

        return parent::__construct($bean);
    }

    /**
     * Add visibility clauses to the WHERE part of the query for DotbQuery Object
     *
     * @param DotbQuery $query
     *
     * @return DotbQuery
     */
    public function addVisibilityWhereQuery(DotbQuery $query, $options = array())
    {
        global $current_user;

        if (!empty($this->targetModuleField) && !$current_user->isAdmin()) {
            $modules = $current_user->getDeveloperModules();
            if (empty($modules)) {
                $modules = array('');
            }
            $query->where()->in($this->targetModuleField, $modules);
        }

        return $query;
    }

    /**
    * Add visibility clauses to the WHERE part of the query
    * @param string $query
    * @return string
    */
    public function addVisibilityWhere(&$query)
    {
        global $current_user;

        if (!empty($this->targetModuleField) && !$current_user->isAdmin()) {
            $table_alias = $this->getOption('table_alias');
            $db = DBManagerFactory::getInstance();
            if (empty($table_alias)) {
                $table_alias = $this->bean->table_name;
            }
            $modules = array_map(function ($value) use ($db) {
                    return $db->quoted($value);
                },
                $current_user->getDeveloperModules()
            );

            if (empty($modules)) {
                $devWhere = "$table_alias.{$this->targetModuleField} IS NULL";
            } else {
                $devWhere = "$table_alias.{$this->targetModuleField} IN (" . implode(',', $modules) . ")";
            }
            if (!empty($query)) {
                $query .= " AND $devWhere";
            } else {
                $query = $devWhere;
            }
        }

        return $query;
    }
}
