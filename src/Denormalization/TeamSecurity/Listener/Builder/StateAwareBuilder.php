<?php


namespace Dotbcrm\Dotbcrm\Denormalization\TeamSecurity\Listener\Builder;

use Doctrine\DBAL\Connection;
use Dotbcrm\Dotbcrm\Denormalization\TeamSecurity\Listener\Builder;
use Dotbcrm\Dotbcrm\Denormalization\TeamSecurity\Listener\Composite;
use Dotbcrm\Dotbcrm\Denormalization\TeamSecurity\Listener\Invalidator;
use Dotbcrm\Dotbcrm\Denormalization\TeamSecurity\Listener\NullListener;
use Dotbcrm\Dotbcrm\Denormalization\TeamSecurity\Listener\Recorder;
use Dotbcrm\Dotbcrm\Denormalization\TeamSecurity\Listener\Updater;
use Dotbcrm\Dotbcrm\Denormalization\TeamSecurity\Listener\UserOnly;
use Dotbcrm\Dotbcrm\Denormalization\TeamSecurity\State;

/**
 * Creates a listener implementation according to the current state
 */
final class StateAwareBuilder implements Builder
{
    /**
     * @var Connection
     */
    private $conn;

    /**
     * @var State
     */
    private $state;

    /**
     * Constructor
     *
     * @param Connection $conn
     * @param State $state
     */
    public function __construct(Connection $conn, State $state)
    {
        $this->conn = $conn;
        $this->state = $state;
    }

    /**
     * {@inheritDoc}
     */
    public function createListener()
    {
        $components = [];

        if ($this->state->isEnabled()) {
            if ($this->state->isAvailable()) {
                $updater = new Updater(
                    $this->conn,
                    $this->state->getActiveTable()
                );

                if (!$this->state->shouldHandleAdminUpdatesInline()) {
                    if ($this->state->isUpToDate()) {
                        $adminListener = new Invalidator($this->state);
                    } else {
                        $adminListener = new NullListener();
                    }

                    $updater = new UserOnly($updater, $adminListener);
                }

                $components[] = $updater;
            }

            if ($this->state->isRebuildRunning()) {
                $components[] = new Recorder($this->conn);
            }
        } elseif ($this->state->isUpToDate()) {
            $components[] = new Invalidator($this->state);
        }

        if (count($components) === 0) {
            return new NullListener();
        }

        if (count($components) === 1) {
            return $components[0];
        }

        return new Composite(...$components);
    }
}
