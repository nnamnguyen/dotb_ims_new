<?php




/**
 * Left-hand side link which aggregates related beans and the beans whose parent is current bean
 */
class FlexRelateChildrenLink extends Link2
{
    /**
     * {@inheritDoc}
     */
    public function getSide()
    {
        return REL_LHS;
    }

    /**
     * Reconstructs the query so that it fetches beans using both "related" and "parent" relationships
     *
     * {@inheritDoc}
     */
    public function buildJoinDotbQuery($dotb_query, $options = array())
    {
        parent::buildJoinDotbQuery($dotb_query, $options);

        $alias = $options['joinTableAlias'];

        /** @var DotbQuery_Builder_Join $join */
        $join = $dotb_query->join[$alias];
        $onContactId = array_shift($join->on()->conditions);

        $on = new DotbQuery_Builder_Orwhere($dotb_query);
        $on->add($onContactId);
        $on->queryAnd()
            ->equalsField('parent_id', $alias . '.id')
            ->equals('parent_type', $this->relationship->getLHSModule());

        array_unshift($join->on()->conditions, $on);
    }

    /**
     * Unlinks related beans and removes parent relation in case if it points to current bean
     *
     * {@inheritDoc}
     */
    public function delete($id, $related_id = '')
    {
        parent::delete($id, $related_id);

        if (!($related_id instanceof DotbBean)) {
            $related_id = $this->getRelatedBean($related_id);
        }

        /** @var DotbBean $relatedBean */
        if ($related_id
            && $related_id->parent_type == $this->relationship->getLHSModule()
            && $related_id->parent_id == $id) {
            $related_id->parent_type = '';
            $related_id->parent_id = '';
            $related_id->save();
        }
    }
}
