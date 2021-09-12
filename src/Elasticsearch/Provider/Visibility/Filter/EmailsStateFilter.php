<?php


namespace Dotbcrm\Dotbcrm\Elasticsearch\Provider\Visibility\Filter;

use Dotbcrm\Dotbcrm\Elasticsearch\Mapping\Mapping;

class EmailsStateFilter implements FilterInterface
{
    use FilterTrait;

    /**
     * Builds a filter to find emails matching the provided "state" option. See {@link Email} for possible states.
     *
     * {@inheritdoc}
     */
    public function buildFilter(array $options = [])
    {
        $field = 'Emails' . Mapping::PREFIX_SEP . 'state.emails_state';

        $filter = new \Elastica\Query\Term();
        $filter->setTerm($field, $options['state']);

        return $filter;
    }
}
