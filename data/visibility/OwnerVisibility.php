<?php


/**
 *
 * Adds visibility for owner only.
 *
 */
class OwnerVisibility extends DotbVisibility
{
    /**
     * {@inheritdoc}
     */
    public function addVisibilityWhere(&$query)
    {
        $owner_where = $this->bean->getOwnerWhere($GLOBALS['current_user']->id, $this->getOption('table_alias'));

        if (!empty($query)) {
            $query .= " AND $owner_where";
        } else {
            $query = $owner_where;
        }

        return $query;
    }

    /**
     * {@inheritdoc}
     */
    public function addVisibilityWhereQuery(DotbQuery $dotbQuery, $options = array())
    {
        $where = null;
        $this->addVisibilityWhere($where, $options);

        if (!empty($where)) {
            $dotbQuery->where()->queryAnd()->addRaw($where);
        }

        return $dotbQuery;
    }
}
