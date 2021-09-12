<?php



class LocalizationsLink extends Link2
{
    /**
     * {@inheritdoc}
     */
    function buildJoinDotbQuery($dotb_query, $options = array())
    {
        $dotb_query->where()
            ->notEquals('id', $this->focus->id)
            ->notEquals('kbarticle_id', $this->focus->kbarticle_id)
            ->equals('active_rev', 1);
        
        return $this->relationship->buildJoinDotbQuery($this, $dotb_query, $options);
    }
}
