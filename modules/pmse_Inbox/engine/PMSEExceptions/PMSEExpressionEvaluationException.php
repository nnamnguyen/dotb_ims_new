<?php



/**
 * Define a custom exception class
 */
class PMSEExpressionEvaluationException extends Exception
{
    protected $expressionArray;
    // Redefine the exception so message isn't optional
    public function __construct($message, $expressionArray, $code = 0, Exception $previous = null)
    {
        // make sure everything is assigned properly
        $this->expressionArray = $expressionArray;
        parent::__construct($message, $code, $previous);
        $this->logMessage();
    }

    public function getExpressionArray () {
        return $this->expressionArray;
    }

    // custom string representation of object
    public function __toString()
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }

    public function logMessage()
    {
        // Since we need to log our exceptions, let's get the logger

        $logMessage = get_class($this) . ' : ' . $this->message;

        // Log it
        PMSELogger::getInstance()->alert($logMessage);
    }
}
