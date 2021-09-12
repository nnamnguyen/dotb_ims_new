<?php


namespace Dotbcrm\Dotbcrm\IdentityProvider\Authentication\Exception;

use Symfony\Component\Security\Core\Exception\AuthenticationException;

/**
 * For portal only or is_group not empty users
 */
class InvalidUserException extends AuthenticationException
{
}
