<?php


namespace Dotbcrm\IdentityProvider\Authentication\Exception;

use Symfony\Component\Security\Core\Exception\LockedException;

/**
 * Thrown when User is temporarily locked upon lockout check.
 */
class TemporaryLockedUserException extends LockedException
{
}
