<?php


namespace Dotbcrm\IdentityProvider\Authentication\Token;

use Dotbcrm\IdentityProvider\App\Authentication\AuthProviderManagerBuilder;

use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

/**
 * Factory for UsernamePasswordTokens creation.
 *
 * Class UsernamePasswordTokenFactory
 * @package Dotbcrm\IdentityProvider\Authentication\Token
 */
class UsernamePasswordTokenFactory
{
    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var array
     */
    protected $config = [];

    /**
     * UsernamePasswordTokenFactory constructor.
     * @param array $config
     * @param $username
     * @param $password
     */
    public function __construct(array $config, $username, $password)
    {
        $this->config = $config;
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * Create token for local auth.
     *
     * @return null|UsernamePasswordToken
     */
    protected function createLocalAuthenticationToken()
    {
        if (!in_array('local', $this->config['enabledProviders'])) {
            return null;
        }
        return new UsernamePasswordToken(
            $this->username,
            $this->password,
            AuthProviderManagerBuilder::PROVIDER_KEY_LOCAL
        );
    }

    /**
     * Create token for ldap auth.
     *
     * @return null|UsernamePasswordToken
     */
    protected function createLdapAuthenticationToken()
    {
        if (!in_array('ldap', $this->config['enabledProviders'])) {
            return null;
        }
        return new UsernamePasswordToken(
            $this->username,
            $this->password,
            AuthProviderManagerBuilder::PROVIDER_KEY_LDAP
        );
    }

    /**
     * Create token for local or/and LDAP auth.
     *
     * @return TokenInterface
     */
    public function createAuthenticationToken()
    {
        $tokens = [
            $this->createLdapAuthenticationToken(),
            $this->createLocalAuthenticationToken(),
        ];
        // remove not configured items
        $tokens = array_filter($tokens);

        if (count($tokens) == 1) {
            return array_shift($tokens);
        }

        $token = new MixedUsernamePasswordToken(
            $this->username,
            $this->password,
            AuthProviderManagerBuilder::PROVIDER_KEY_MIXED
        );
        array_walk($tokens, [$token, 'addToken']);
        return $token;
    }
}
