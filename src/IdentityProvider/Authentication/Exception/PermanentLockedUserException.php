<?php


namespace Dotbcrm\Dotbcrm\IdentityProvider\Authentication\Exception;

use Symfony\Component\Security\Core\Exception\LockedException;

/**
 * Exception is using for permanent locked users
 */
class PermanentLockedUserException extends LockedException
{
    /**
     * ask user to do some action for unlock their account
     * @var string
     */
    protected $waitingErrorMessage;

    /**
     * return message
     * @return string
     */
    public function getWaitingErrorMessage()
    {
        return $this->waitingErrorMessage;
    }

    /**
     * set message
     * @param $message
     */
    public function setWaitingErrorMessage($message)
    {
        $this->waitingErrorMessage = $message;
    }
}
