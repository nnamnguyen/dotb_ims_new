<?php


use Dotbcrm\Dotbcrm\Logger\Factory;
use Dotbcrm\Dotbcrm\Logger\BackwardCompatibleAdapter;

require_once 'include/DotbLogger/LoggerTemplate.php';

/**
 * DotBCRM adapter for PSR-3 compatible logger
 */
class DotbPsrLogger implements LoggerTemplate
{
    /**
     * Backward compatible PSR-3 logger
     *
     * @var BackwardCompatibleAdapter
     */
    protected $psrLogger;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->psrLogger = Factory::getInstance()->createLoggerForLoggerManager('default');
    }

    /**
     * {@inheritDoc}
     */
    public function log($method, $message)
    {
        // for compatibility with LoggerManager::__call() and DotbLogger::log()
        if (is_array($message)) {
            if (count($message) == 1) {
                $message = array_shift($message);
            } else {
                $message = print_r($message, true);
            }
        }

        $this->psrLogger->$method($message);
    }
}
