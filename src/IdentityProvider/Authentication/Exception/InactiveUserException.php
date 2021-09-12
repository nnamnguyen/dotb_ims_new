<?php


namespace Dotbcrm\Dotbcrm\IdentityProvider\Authentication\Exception;

use Symfony\Component\Security\Core\Exception\AuthenticationException;

/**
 * User with status inactive auth exception
 */
class InactiveUserException extends AuthenticationException
{
}
