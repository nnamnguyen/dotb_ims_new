<?php


namespace Dotbcrm\Dotbcrm\ProcessManager\Exception;

/**
 * Class BaseException
 * @package ProcessManager
 */
class BaseException extends \Exception
{

    public function __construct($message = null, $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->logMessage();
    }

    public function logMessage()
    {
        // Since we need to log our exceptions, let's get the logger

        $logMessage = get_class($this) . ' : ' . $this->message;

        // Log it
        \PMSELogger::getInstance()->alert($logMessage);
    }
}
