<?php


namespace Dotbcrm\Dotbcrm\Denormalization\TeamSecurity\Command;

use Psr\Log\LoggerInterface;
use Dotbcrm\Dotbcrm\Denormalization\TeamSecurity\State;

/**
 * Performs full denormalized data rebuild if required in the current state and updates the state accordingly
 */
final class StateAwareRebuild
{
    /**
     * @var State
     */
    private $state;

    /**
     * @var callable
     */
    private $command;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * Constructor
     *
     * @param State $state
     * @param callable $command
     * @param LoggerInterface $logger
     */
    public function __construct(State $state, callable $command, LoggerInterface $logger)
    {
        $this->state = $state;
        $this->command = $command;
        $this->logger = $logger;
    }

    /**
     * Rebuilds denormalized data
     *
     * @return array
     */
    public function __invoke($ignoreUpToDate = false)
    {
        if (!$this->state->isEnabled()) {
            return array(
                true,
                'The use of denormalized table is not enabled. No need to run the job.',
            );
        }

        if ($this->state->isRebuildRunning()) {
            return array(
                true,
                'Denormalized table rebuild is already running.',
            );
        }

        if (!$ignoreUpToDate && $this->state->isUpToDate()) {
            return array(
                true,
                'Denormalized data is up to date.',
            );
        }

        try {
            $table = $this->state->getStandbyTable();
            $this->state->markRebuildRunning();
            $command = $this->command;
            $command($table);
            $this->state->activateTable($table);
        } catch (\Exception $e) {
            $this->logger->critical($e);

            return array(
                false,
                sprintf(
                    'Denormalized table rebuild failed with error: %s',
                    $e->getMessage()
                ),
            );
        } finally {
            $this->state->markRebuildNotRunning();
        }

        return array(
            true,
            'Denormalized table rebuild completed',
        );
    }
}
