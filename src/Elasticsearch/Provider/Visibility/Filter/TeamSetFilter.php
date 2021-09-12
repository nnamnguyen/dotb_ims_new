<?php


namespace Dotbcrm\Dotbcrm\Elasticsearch\Provider\Visibility\Filter;

use Dotbcrm\Dotbcrm\Elasticsearch\Mapping\Mapping;
use TeamSet;
use User;

/**
 *
 * Team set filter
 *
 */
class TeamSetFilter implements FilterInterface
{
    use FilterTrait;

    /**
     * @var string
     */
    protected $defaultField = 'team_set_id.set';

    /**
     * {@inheritdoc}
     */
    public function buildFilter(array $options = array())
    {
        $teamSetIds = $this->getTeamSetIds($options['user']);
        $field = !empty($options['field']) ? $options['field'] : $this->defaultField;
        $field = $options['module'] . Mapping::PREFIX_SEP . $field;
        return new \Elastica\Query\Terms($field, $teamSetIds);
    }

    /**
     * Get team set ids for given user
     * @param User $user
     * @return array
     */
    protected function getTeamSetIds(User $user)
    {
        return TeamSet::getTeamSetIdsForUser($user->id);
    }
}
