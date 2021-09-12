<?php


namespace Dotbcrm\Dotbcrm\IdentityProvider\Authentication\Exception;

use Symfony\Component\Security\Core\Exception\LockedException;

/**
 * Exception is using for temporary locked users
 */
class TemporaryLockedUserException extends LockedException
{
}
