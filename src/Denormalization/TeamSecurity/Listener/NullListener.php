<?php


namespace Dotbcrm\Dotbcrm\Denormalization\TeamSecurity\Listener;

use Dotbcrm\Dotbcrm\Denormalization\TeamSecurity\Listener;

/**
 * Null implementation of the listener
 *
 * @codeCoverageIgnore
 */
final class NullListener implements Listener
{
    /**
     * {@inheritDoc}
     */
    public function userDeleted($userId)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function teamDeleted($teamId)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function teamSetCreated($teamSetId, array $teamIds)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function teamSetDeleted($teamSetId)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function userAddedToTeam($userId, $teamId)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function userRemovedFromTeam($userId, $teamId)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function __toString()
    {
        return sprintf('Null()');
    }
}
