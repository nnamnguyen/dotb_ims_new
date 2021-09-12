<?php


namespace Dotbcrm\Dotbcrm\Elasticsearch\Query\Aggregation;

/**
 *
 * Generic terms aggregation
 *
 */
class TermsAggregation extends AbstractAggregation
{
    /**
     * {@inheritdoc}
     */
    protected $acceptedOptions = array(
        'field',
        'size',
        'order',
    );

    /**
     * {@inheritdoc}
     */
    protected $options = array(
        'size' => 5,
        'order' => array('_count', 'desc'),
    );

    /**
     * {@inheritdoc}
     */
    public function build($id, array $filters)
    {
        $terms = new \Elastica\Aggregation\Terms($id);
        $this->applyOptions($terms);

        if (empty($filters)) {
            return $terms;
        }

        return $this->wrapFilter($id, $terms, $filters);
    }

    /**
     * {@inheritdoc}
     */
    public function buildFilter($filterDefs)
    {
        if (!is_array($filterDefs) || empty($filterDefs)) {
            return false;
        }

        $filter = new \Elastica\Query\Terms();
        $filter->setTerms($this->options['field'], $filterDefs);
        return $filter;
    }
}
