<?php


namespace Dotbcrm\Dotbcrm\Logger;

use Psr\Log\AbstractLogger;
use Psr\Log\LogLevel;


/**
 *
 * PSR-0 adapter for DotbLogger until Monolog is integrated.
 *
 */
class LoggerTransition extends AbstractLogger
{
    /**
     * @var \LoggerManager
     */
    protected $logger;

    /**
     * @var array Mapping from PSR0 to Dotb log levels
     */
    protected $psrDotbMap = array();

    /**
     * Constructor.
     * @param \DotbLogger $logger
     */
    public function __construct(\LoggerManager $logger)
    {
        $this->logger = $logger;
        $this->initMap();
    }

    /**
     * Initialize the mapping between PSR level and dotb level.
     */
    public function initMap()
    {
        if (empty($this->psrDotbMap)) {
            $this->psrDotbMap = array(
                LogLevel::EMERGENCY => 'fatal',
                LogLevel::ALERT => 'fatal',
                LogLevel::CRITICAL => 'fatal',
                LogLevel::ERROR => 'error',
                LogLevel::WARNING => 'warn',
                LogLevel::NOTICE => 'info',
                LogLevel::INFO => 'info',
                LogLevel::DEBUG => 'debug',
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function log($level, $message, array $context = array())
    {
        $callBack = array($this->logger, $this->getDotbLevel($level));

        // LoggerManager doesn't support context so lets skip it for now
        return call_user_func($callBack, $message);
    }

    /**
     * @return LoggerManager
     */
    public function getDotbLogger()
    {
        return $this->logger;
    }

    /**
     * Get the corresponding PSR-0 level, given a dotb level.
     * @param string $level
     * @return string
     */
    protected function getDotbLevel($level)
    {
        return $this->psrDotbMap[$level];
    }

}
