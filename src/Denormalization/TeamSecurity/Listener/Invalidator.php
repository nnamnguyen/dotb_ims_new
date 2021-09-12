<?php


namespace Dotbcrm\Dotbcrm\Denormalization\TeamSecurity\Listener;

use Dotbcrm\Dotbcrm\Denormalization\TeamSecurity\Listener;
use Dotbcrm\Dotbcrm\Denormalization\TeamSecurity\State;

/**
 * Invalidates denormalized data upon any change
 */
final class Invalidator implements Listener
{
    /**
     * @var State
     */
    private $state;

    /**
     * Constructor
     *
     * @param State $state
     */
    public function __construct(State $state)
    {
        $this->state = $state;
    }

    /**
     * {@inheritDoc}
     *
     * No need to invalidate the data, since the deleted user is not going to interact with the system anymore.
     * Corresponding records will be removed during full rebuild.
     */
    public function userDeleted($userId)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function teamDeleted($teamId)
    {
        $this->invalidate();
    }

    /**
     * {@inheritDoc}
     */
    public function teamSetCreated($teamSetId, array $teamIds)
    {
        $this->invalidate();
    }

    /**
     * {@inheritDoc}
     *
     * No need to invalidate the data, since the deleted team set is not going to be associated with any record anymore.
     * Corresponding records will be removed during full rebuild.
     */
    public function teamSetDeleted($teamSetId)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function userAddedToTeam($userId, $teamId)
    {
        $this->invalidate();
    }

    /**
     * {@inheritDoc}
     */
    public function userRemovedFromTeam($userId, $teamId)
    {
        $this->invalidate();
    }

    /**
     * Mark the denormalized data out of date. This flag is used to determine
     * if full rebuild should be run during the next scheduler run.
     */
    private function invalidate()
    {
        $this->state->markOutOfDate();
    }

    /**
     * {@inheritDoc}
     */
    public function __toString()
    {
        return sprintf('Invalidator()');
    }
}
