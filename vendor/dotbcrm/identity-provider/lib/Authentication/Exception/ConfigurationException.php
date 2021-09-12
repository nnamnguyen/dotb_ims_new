<?php


namespace Dotbcrm\IdentityProvider\Authentication\Exception;

use Symfony\Component\Security\Core\Exception\AuthenticationException;

/**
 * Class ConfigurationException
 *
 * Exception should occur when some config parameters for authentication are missing
 *
 * @package Dotbcrm\IdentityProvider\Authentication\Exception
 */
class ConfigurationException extends AuthenticationException
{
}
