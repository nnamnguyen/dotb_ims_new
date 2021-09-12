<?php


namespace Dotbcrm\Dotbcrm\Denormalization\TeamSecurity\Listener;

use Dotbcrm\Dotbcrm\Denormalization\TeamSecurity\Listener;

/**
 * Composite listener
 *
 * Replays invocations on all underlying listeners.
 */
final class Composite implements Listener
{
    /**
     * @var Listener[]
     */
    private $listeners;

    /**
     * Constructor
     *
     * @param Listener $listener1
     * @param Listener $listener2
     * @param Listener[] $listeners
     */
    public function __construct(Listener $listener1, Listener $listener2, Listener ...$listeners)
    {
        $this->listeners = array_merge([$listener1, $listener2], $listeners);
    }

    /**
     * {@inheritDoc}
     */
    public function userDeleted($userId)
    {
        array_walk($this->listeners, function (Listener $listener) use ($userId) {
            $listener->userDeleted($userId);
        });
    }

    /**
     * {@inheritDoc}
     */
    public function teamDeleted($teamId)
    {
        array_walk($this->listeners, function (Listener $listener) use ($teamId) {
            $listener->teamDeleted($teamId);
        });
    }

    /**
     * {@inheritDoc}
     */
    public function teamSetCreated($teamSetId, array $teamIds)
    {
        array_walk($this->listeners, function (Listener $listener) use ($teamSetId, $teamIds) {
            $listener->teamSetCreated($teamSetId, $teamIds);
        });
    }

    /**
     * {@inheritDoc}
     */
    public function teamSetDeleted($teamSetId)
    {
        array_walk($this->listeners, function (Listener $listener) use ($teamSetId) {
            $listener->teamSetDeleted($teamSetId);
        });
    }

    /**
     * {@inheritDoc}
     */
    public function userAddedToTeam($userId, $teamId)
    {
        array_walk($this->listeners, function (Listener $listener) use ($userId, $teamId) {
            $listener->userAddedToTeam($userId, $teamId);
        });
    }

    /**
     * {@inheritDoc}
     */
    public function userRemovedFromTeam($userId, $teamId)
    {
        array_walk($this->listeners, function (Listener $listener) use ($userId, $teamId) {
            $listener->userRemovedFromTeam($userId, $teamId);
        });
    }

    /**
     * {@inheritDoc}
     */
    public function __toString()
    {
        return sprintf('Composite(%s)', implode(', ', $this->listeners));
    }
}
