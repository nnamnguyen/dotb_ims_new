<?php


class DotbQueryException extends DotbException
{
    public $errorLabel = 'unknown_exception';
    public $messageLabel = 'EXCEPTION_UNKNOWN_EXCEPTION';
    public $msgArgs = null;
    protected $moduleName = null;

    /**
     * Extra data attached to the exception
     * @var array
     */
    public $extraData = array();

    /**
     * @param string $messageLabel optional Label for error message.  Used to load the appropriate translated message.
     * @param array $msgArgs optional set of arguments to substitute into error message string
     * @param string|null $moduleName Provide module name if $messageLabel is a module string, leave empty if
     *  $messageLabel is in app strings.
     * @param int $httpCode
     * @param string $errorLabel
     */
    function __construct($messageLabel = null, $msgArgs = null, $moduleName = null, $errorLabel = null)
    {

        if (!empty($messageLabel)) {
            $this->messageLabel = $messageLabel;
        }

        if (!empty($errorLabel)) {
            $this->errorLabel = $errorLabel;
        }

        if (!empty($moduleName)) {
            $this->moduleName = $moduleName;
        }

        if (!empty($msgArgs)) {
            $this->msgArgs = $msgArgs;
        }

        $this->setMessage($this->messageLabel, $this->msgArgs, $this->moduleName);

        parent::__construct($this->message);
    }

    /**
     * Each Dotb API exception should have a unique label that clients can use to identify which
     * Dotb API exception was thrown.
     *
     * @return null|string Unique error label
     */
    public function getErrorLabel()
    {
        return $this->errorLabel;
    }

    /**
     * Sets the user locale appropriate message that is suitable for clients to display to end users.
     * Message is based upon the message label provided when this DotbApiException was constructed.
     *
     * If the message label isn't found in app_strings or mod_strings, we'll use the label itself as the message.
     *
     * @param string $messageLabel required Label for error message.  Used to load the appropriate translated message.
     * @param array $msgArgs optional set of arguments to substitute into error message string
     * @param string|null $moduleName Provide module name if $messageLabel is a module string, leave empty if
     *  $messageLabel is in app strings.
     */
    public function setMessage($messageLabel, $msgArgs = null, $moduleName = null)
    {
        // If no message label, don't bother looking it up
        if (empty($messageLabel)) {
            $this->message = null;
            return;
        }
        $message = translate($messageLabel, $moduleName);

        // If no arguments provided, return message.
        // If there are arguments, insert into message then return formatted message
        if (empty($msgArgs)) {
            $this->message = $message;
        } else {
            $this->message = string_format($message, $msgArgs);
        }
    }

    /**
     * Set exception extra data
     * @param string $key
     * @param mixed $data
     * @return DotbApiException
     */
    public function setExtraData($key, $data)
    {
        $this->extraData[$key] = $data;
        return $this;
    }

}
