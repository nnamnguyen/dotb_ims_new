<?php


namespace Dotbcrm\IdentityProvider\Authentication\Exception;

use Symfony\Component\Security\Core\Exception\LockedException;

/**
 * Thrown when User is locked permanently upon lockout check.
 */
class PermanentLockedUserException extends LockedException
{
}
