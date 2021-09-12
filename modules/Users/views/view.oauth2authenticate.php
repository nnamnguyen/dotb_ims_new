<?php


use Dotbcrm\Dotbcrm\IdentityProvider\OAuth2StateRegistry;

class UsersViewOAuth2Authenticate extends LumiaView
{
    /**
     * @inheritdoc
     */
    public function __construct()
    {
        parent::__construct();
        $this->options['show_header'] = false;
    }

    /**
     * @inheritdoc
     */
    public function preDisplay($params = array()) : void
    {
        $code = $this->request->getValidInputGet('code');
        $scope = $this->request->getValidInputGet('scope');
        $state = $this->request->getValidInputGet('state');
        if (!$code || !$scope || !$state) {
            $this->redirect();
        }
        list($platform, $state) = explode('_', $state);

        $stateRegistry = $this->getStateRegistry();
        $isStateRegistered = $stateRegistry->isStateRegistered($state);
        $stateRegistry->unregisterState($state);
        if (!$isStateRegistered) {
            $this->redirect();
        }

        $oAuthServer = \DotbOAuth2Server::getOAuth2Server();

        try {
            $this->authorization = $oAuthServer->grantAccessToken([
                'grant_type' => 'authorization_code',
                'code' => $code,
                'scope' => $scope,
            ]);

            // Adding the setcookie() here instead of calling $api->setHeader() because
            // manually adding a cookie header will break 3rd party apps that use cookies
            setcookie(
                RestService::DOWNLOAD_COOKIE . '_' . $platform,
                $this->authorization['download_token'],
                time() + $this->authorization['refresh_expires_in'],
                ini_get('session.cookie_path'),
                ini_get('session.cookie_domain'),
                ini_get('session.cookie_secure'),
                true
            );
        } catch (\Exception $e) {
            $this->redirect();
        }

        parent::preDisplay($params);
    }

    /**
     * @return OAuth2StateRegistry
     */
    protected function getStateRegistry() : OAuth2StateRegistry
    {
        return new OAuth2StateRegistry();
    }

    /**
     * Redirects to the main page.
     */
    protected function redirect(): void
    {
        DotbApplication::redirect('./#stsAuthError');
    }
}
