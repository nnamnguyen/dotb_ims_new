<?php


namespace Dotbcrm\Dotbcrm\Bean\Visibility\Strategy\TeamSecurity;

use DBManager;
use Dotbcrm\Dotbcrm\Bean\Visibility\Strategy;
use DotbQuery;
use User;

/**
 * Team security visibility implementation which uses denormalized team-set to user data
 */
final class Denormalized implements Strategy
{
    /**
     * @var string
     */
    private $table;

    /**
     * @var User
     */
    private $user;

    /**
     * Constructor
     *
     * @param string $table The relationship table containing denormalized data
     * @param User $user The user to filter the records for
     */
    public function __construct($table, User $user)
    {
        $this->table = $table;
        $this->user = $user;
    }

    public function applyToQuery(DotbQuery $query, $table)
    {
        $alias = $this->buildAlias($query->getDBManager(), $table);

        $query->joinTable($this->table, [
            'alias' => $alias,
        ])
            ->on()
            ->equalsField($alias . '.team_set_id', $table . '.team_set_id')
            ->equals($alias . '.user_id', $this->user->id);
    }

    public function applyToFrom(DBManager $db, $query, $table)
    {
        $alias = $this->buildAlias($db, $table);

        return $query . ' INNER JOIN ' . $this->table . ' ' . $alias
            . ' ON ' . $alias . '.team_set_id = ' . $table . '.team_set_id'
            . ' AND ' . $alias . '.user_id = ' . $db->quoted($this->user->id);
    }

    public function applyToWhere(DBManager $db, $query, $table)
    {
        return $query;
    }

    /**
     * Builds the alias which should be used for joining the denormalized table
     * based on the targed table alias
     *
     * @param DBManager $db
     * @param string $table
     * @return string
     */
    private function buildAlias(DBManager $db, $table)
    {
        return $db->getValidDBName($table . '_tsu', true, 'table');
    }
}
