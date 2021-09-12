<?php


namespace Dotbcrm\IdentityProvider\Authentication\Token;

use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

/**
 * Mixed token which main contain different UsernamePassword tokens
 * Class MixedUsernamePasswordToken
 * @package Dotbcrm\IdentityProvider\Authentication\Token
 */
class MixedUsernamePasswordToken extends UsernamePasswordToken
{
    /**
     * Authentication chain storage
     * @var array
     */
    protected $mixedTokens = [];

    /**
     * Add token to authentication chain
     * @param UsernamePasswordToken $token
     */
    public function addToken(UsernamePasswordToken $token)
    {
        $this->mixedTokens[] = $token;
    }

    /**
     * Gets all tokens from authentication chain
     * @return array
     */
    public function getTokens()
    {
        return $this->mixedTokens;
    }
}
