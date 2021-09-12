<?php


namespace Dotbcrm\Dotbcrm\Dbal\Logging;

use Doctrine\DBAL\Logging\SQLLogger;
use Psr\Log\LoggerInterface;

/**
 * Logs every query as a debug message
 */
final class DebugLogger implements SQLLogger
{
    /**
     * @var LoggerInterface
     */
    protected $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * {@inheritDoc}
     */
    public function startQuery($sql, array $params = null, array $types = null)
    {
        $this->logger->info('Query: ' . $sql, [
            'params' => $params,
            'types' => $types,
        ]);
    }

    /**
     * {@inheritDoc}
     */
    public function stopQuery()
    {
    }
}
