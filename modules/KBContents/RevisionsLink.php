<?php



class RevisionsLink extends Link2
{
    /**
     * {@inheritdoc}
     */
    function buildJoinDotbQuery($dotb_query, $options = array())
    {
        $dotb_query->where()
            ->notEquals('id', $this->focus->id)
            ->equals('kbdocument_id', $this->focus->kbdocument_id)
            ->equals('kbarticle_id', $this->focus->kbarticle_id);

        return $this->relationship->buildJoinDotbQuery($this, $dotb_query, $options);
    }
}
