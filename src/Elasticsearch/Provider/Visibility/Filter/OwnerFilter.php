<?php


namespace Dotbcrm\Dotbcrm\Elasticsearch\Provider\Visibility\Filter;

use Dotbcrm\Dotbcrm\Elasticsearch\Mapping\Mapping;

/**
 *
 * Owner filter
 *
 */
class OwnerFilter implements FilterInterface
{
    use FilterTrait;

    /**
     * {@inheritdoc}
     */
    public function buildFilter(array $options = array())
    {
        // Create the field name
        $ownerField = Mapping::PREFIX_COMMON . 'owner_id.owner';
        $filter = new \Elastica\Query\Term();
        $filter->setTerm($ownerField, $options['user']->id);
        return $filter;
    }
}
