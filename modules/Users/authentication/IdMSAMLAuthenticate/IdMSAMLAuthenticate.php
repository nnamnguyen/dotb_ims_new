<?php


use Dotbcrm\Dotbcrm\Security\InputValidation\InputValidation;
use Dotbcrm\Dotbcrm\Session\SessionStorage;
use Dotbcrm\Dotbcrm\IdentityProvider\Authentication\AuthProviderBasicManagerBuilder;
use Dotbcrm\Dotbcrm\IdentityProvider\Authentication\Config;
use Dotbcrm\Dotbcrm\IdentityProvider\Authentication\User;

use Dotbcrm\IdentityProvider\Authentication\Token\SAML\AcsToken;
use Dotbcrm\IdentityProvider\Authentication\Token\SAML\ConsumeLogoutToken;
use Dotbcrm\IdentityProvider\Authentication\Token\SAML\IdpLogoutToken;
use Dotbcrm\IdentityProvider\Authentication\Token\SAML\InitiateLogoutToken;
use Dotbcrm\IdentityProvider\Authentication\Token\SAML\InitiateToken;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

class IdMSAMLAuthenticate extends BaseAuthenticate implements ExternalLoginInterface
{
    /**
     * Get URL to follow to get logged in
     *
     * @param array $returnQueryVars Query variables that should be added to the return URL
     *
     * @return string
     * @throws AuthenticationException
     */
    public function getLoginUrl($returnQueryVars = array())
    {
        $initToken = new InitiateToken();

        $config = $this->getConfig();
        $sameWindow = $config->get('SAML_SAME_WINDOW');

        $relayStateData = [
            'dataOnly' => 1,
        ];
        foreach ($returnQueryVars as $key => $value) {
            if (!is_null($value)) {
                $relayStateData[$key] = $value;
            }
        }
        if (!empty($returnQueryVars['platform']) && $returnQueryVars['platform'] == 'base' && !empty($sameWindow)) {
            unset($relayStateData['dataOnly']);
        }

        if ($relayStateData) {
            $initToken->setAttribute('returnTo', base64_encode(json_encode($relayStateData)));
        }

        $authManager = $this->getAuthProviderBasicBuilder($config)->buildAuthProviders();

        $token = $authManager->authenticate($initToken);

        $url = $token->getAttribute('url');

        return $url;
    }

    /**
     * AuthN User via SAML.
     *
     * @inheritdoc
     */
    public function loginAuthenticate($username, $password, $fallback = false, array $params = [])
    {
        if (empty($_POST['SAMLResponse'])) {
            return $this->getDotbAuthenticate()->loginAuthenticate($username, $password, $fallback, $params);
        }

        $acsToken = new AcsToken($_POST['SAMLResponse']);
        $authManager = $this->getAuthProviderBuilder($this->getConfig())->buildAuthProviders();
        $token = $authManager->authenticate($acsToken);

        if (!$token->isAuthenticated()) {
            return false;
        }

        $session = $this->getSession();
        $session['IdPSessionIndex'] = $token->getAttribute('IdPSessionIndex');
        $session['externalLogin'] = true;

        return true;
    }

    /**
     * Get URL to follow to get logged out
     * @return string|array
     */
    public function getLogoutUrl()
    {
        global $current_user;

        $config = $this->getConfig();
        $samlConfig = $config->getSAMLConfig();
        if (empty($samlConfig['idp']['singleLogoutService']['url'])) {
            return '';
        }

        $session = $this->getSession();
        $logoutToken = new InitiateLogoutToken();
        $user = new User();
        $user->setDotbUser($current_user);
        $logoutToken->setAttribute('user', $user);
        if (array_key_exists('IdPSessionIndex', $session)) {
            $logoutToken->setAttribute('sessionIndex', $session['IdPSessionIndex']);
        }
        $authManager = $this->getAuthProviderBasicBuilder($config)->buildAuthProviders();

        $resultToken = $authManager->authenticate($logoutToken);
        switch ($resultToken->getAttribute('method')) {
            case Request::METHOD_POST:
                $params = [
                    'url' => $resultToken->getAttribute('url'),
                    'method' => $resultToken->getAttribute('method'),
                    'params' => $resultToken->getAttribute('parameters'),
                ];
                return $params;
            default:
                return $resultToken->getAttribute('url');
        }
    }

    /**
     * Called when a user requests to logout
     *
     * Override default behavior. Redirect user to special "Logged Out" page in
     * order to prevent automatic logging in.
     */
    public function logout()
    {
        $request = $this->getRequest();
        $requestRelayState = $request->getValidInputRequest('RelayState');
        $samlResponse = $request->getValidInputRequest('SAMLResponse');
        $samlRequest = $request->getValidInputRequest('SAMLRequest');
        if ($samlResponse) {
            $logoutToken = new ConsumeLogoutToken($samlResponse);
        } elseif ($samlRequest) {
            $logoutToken = new IdpLogoutToken($samlRequest);
            if ($requestRelayState) {
                $logoutToken->setAttribute('RelayState', $requestRelayState);
            }
        } else {
            return;
        }
        $logoutToken->setAuthenticated(true);

        $authManager = $this->getAuthProviderBasicBuilder($this->getConfig())->buildAuthProviders();
        $resultToken = $authManager->authenticate($logoutToken);
        if (!$resultToken->isAuthenticated()) {
            $url = $resultToken->hasAttribute('url') ? $resultToken->getAttribute('url') : $requestRelayState;
            if ($url) {
                $this->redirect($url);
            }
            $this->terminate();
        }
    }

    /**
     * Get idm configuration instance.
     *
     * @return \Dotbcrm\Dotbcrm\IdentityProvider\Authentication\Config
     */
    protected function getConfig()
    {
        return new Config(\DotbConfig::getInstance());
    }

    /**
     * @return \Dotbcrm\Dotbcrm\Session\SessionStorageInterface
     */
    protected function getSession()
    {
        return SessionStorage::getInstance();
    }

    /**
     * @return \Dotbcrm\Dotbcrm\Security\InputValidation\Request
     */
    protected function getRequest()
    {
        return InputValidation::getService();
    }

    /**
     * Redirect to the specified url
     *
     * @param string $url
     */
    protected function redirect($url)
    {
        ob_clean();
        RedirectResponse::create($url)->send();
        $this->terminate();
    }

    /**
     * Terminate execution
     */
    protected function terminate()
    {
        exit;
    }

    /**
     * @param Config $config
     *
     * @return AuthProviderBasicManagerBuilder
     */
    protected function getAuthProviderBasicBuilder(Config $config)
    {
        return new AuthProviderBasicManagerBuilder($config);
    }

    /**
     * Gets IDM dotb authenticate instance.
     *
     * @return IdMDotbAuthenticate
     */
    protected function getDotbAuthenticate()
    {
        return new IdMDotbAuthenticate();
    }
}
