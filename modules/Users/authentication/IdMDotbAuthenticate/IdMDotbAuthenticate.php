<?php


use Dotbcrm\Dotbcrm\IdentityProvider\Authentication\Config;

class IdMDotbAuthenticate extends BaseAuthenticate implements LoginInterface
{
    /**
     * Authenticates a user based on the username and password
     * returns true if the user was authenticated false otherwise
     * it also will load the user into current user if he was authenticated
     *
     * @inheritdoc
     */
    public function loginAuthenticate($username, $password, $fallback = false, array $params = [])
    {
        $authManager = $this->getAuthProviderBuilder(new Config(\DotbConfig::getInstance()))->buildAuthProviders();
        $token = $this->getUsernamePasswordTokenFactory($username, $password, $params)
                      ->createLocalAuthenticationToken();
        $token = $authManager->authenticate($token);
        return $token && $token->isAuthenticated();
    }
}
