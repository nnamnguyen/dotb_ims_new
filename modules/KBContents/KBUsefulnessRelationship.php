<?php


use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Relationship between ACL Roles and Users which maintains ACL Role Sets
 */
class KBUsefulnessRelationship extends M2MRelationship
{
    /**
     * @inheritDoc
     */
    protected function getRoleWhere($table = null, $ignore_role_filter = false, $ignore_primary_flag = false)
    {
        if (empty($table)) {
            $table = $this->getRelationshipTable();
        }

        if (!empty($this->primaryOnly)) {
            return " AND {$table}.{$this->def['primary_flag_column']} = 1";
        }
        return parent::getRoleWhere($table, $ignore_role_filter, $ignore_primary_flag);
    }

    /**
     * @inheritDoc
     */
    protected function addRoleWhereToQuery(QueryBuilder $query, $ignoreFilter = false, $ignoreFlag = false)
    {
        if (!empty($this->primaryOnly)) {
            $query->andWhere($query->expr()->eq($this->def['primary_flag_column'], 1));
        } else {
            parent::addRoleWhereToQuery($query, $ignoreFilter, $ignoreFlag);
        }
    }

    /** {@inheritDoc} */
    protected function applyQueryBuilderFilter(
        QueryBuilder $builder,
        $tableAlias,
        $ignoreRole = false,
        $ignorePrimary = false
    ) {
        if (!empty($this->primaryOnly)) {
            $this->applyQueryBuilderPrimaryFilter($builder, $tableAlias);
        } else {
            parent::applyQueryBuilderFilter($builder, $tableAlias, $ignoreRole, $ignorePrimary);
        }
    }
}
