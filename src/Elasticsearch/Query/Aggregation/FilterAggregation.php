<?php


namespace Dotbcrm\Dotbcrm\Elasticsearch\Query\Aggregation;

/**
 *
 * Abstract class for Filter Aggregation.
 *
 */
abstract class FilterAggregation extends AbstractAggregation
{
    /**
     * {@inheritdoc}
     */
    protected $acceptedOptions = array(
        'field',
    );

    /**
     * {@inheritdoc}
     */
    protected $options = array(
    );

    /**
     * {@inheritdoc}
    */
    public function build($id, array $filters)
    {
        // Add our own filter to the stack
        $filters[] = $this->getAggFilter($this->options['field']);

        $agg = new \Elastica\Aggregation\Filter($id);
        $agg->setFilter($this->buildFilters($filters));
        return $agg;
    }

    /**
     * {@inheritdoc}
     */
    public function buildFilter($filterDefs)
    {
        if (!is_bool($filterDefs)) {
            return false;
        }

        return $filterDefs ? $this->getAggFilter($this->options['field']) : false;
    }

    /**
     * {@inheritdoc}
     */
    public function parseResults($id, array $results)
    {
        return array(
            'count' => empty($results['doc_count']) ? 0 : $results['doc_count'],
        );
    }

    /**
     * Get aggregation filter definition
     * @param string $field
     * @return \Elastica\Query\AbstractQuery
     */
    abstract protected function getAggFilter($field);
}
