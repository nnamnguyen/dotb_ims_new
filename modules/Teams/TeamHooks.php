<?php


class TeamHooks {
    /**
     * Used for exit point in recursive removing
     * @var array
     */
    protected static $removedLinks = [];

    /**
     * Adds user-team relationship with additional business logic
     * @param DotbBean $team
     * @param string $event
     * @param array $args
     */
    public static function addManagerToTeam(DotbBean $team, $event, $args) {
        if ($team instanceof Team) {
            if (isset($args['relationship']) && $args['relationship'] == 'team_memberships') {
                $team->add_user_to_team($args['related_id']);
            }
        }
    }

    /**
     * Removes user-team relationship with additional business logic
     * @param DotbBean $team
     * @param string $event
     * @param array $args
     */
    public static function removeManagerFromTeam(DotbBean $team, $event, $args) {
        if ($team instanceof Team) {
            if (isset($args['relationship']) && $args['relationship'] == 'team_memberships') {
                $membership = BeanFactory::newBean('TeamMemberships');
                /**@var TeamMembership $membership */
                $membership->retrieve_by_user_and_team($args['related_id'], $team->id);
                if ($membership->id && !isset(self::$removedLinks[$membership->id])) {
                    self::$removedLinks[$membership->id] = 1;
                    $team->remove_user_from_team($args['related_id']);
                    unset(self::$removedLinks[$membership->id]);
                }
            }
        }
    }

    /** Added by HP to remove private team when show in selection list
     * @param DotbBean $team
     * @param $event
     * @param $args
     */
    public static function removePrivateTeam(DotbBean $team, $event, $args) {
        $args[0]->where()->equals('private', '0');
    }
}
