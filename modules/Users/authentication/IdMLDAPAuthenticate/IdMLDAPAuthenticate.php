<?php

use Dotbcrm\Dotbcrm\IdentityProvider\Authentication\Config;

/**
 * IdM LDAP login
 */
class IdMLDAPAuthenticate extends BaseAuthenticate implements LoginInterface
{
    /**
     * AuthN user over ldap service.
     *
     * @inheritdoc
     */
    public function loginAuthenticate($username, $password, $fallback = false, array $params = [])
    {
        $authManager = $this->getAuthProviderBuilder(new Config(\DotbConfig::getInstance()))->buildAuthProviders();
        $tokenFactory = $this->getUsernamePasswordTokenFactory($username, $password, $params);
        $ldapToken = $tokenFactory->createLdapAuthenticationToken();
        $localToken = $tokenFactory->createLocalAuthenticationToken();

        $mixedToken = $tokenFactory->createMixedAuthenticationToken();
        $mixedToken->addToken($ldapToken);
        $mixedToken->addToken($localToken);

        $token = $authManager->authenticate($mixedToken);
        return $token && $token->isAuthenticated();
    }
}
