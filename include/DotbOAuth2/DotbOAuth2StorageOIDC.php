<?php


use Symfony\Component\Security\Core\Exception\AuthenticationException;

/**
 * Provides legacy clients support which do not support oauth2/OIDC protocol
 * and uses username/password for authentication
 */
class DotbOAuth2StorageOIDC extends DotbOAuth2Storage
{
    /**
     * @inheritdoc
     */
    public function checkUserCredentials($client_id, $username, $password)
    {
        try {
            // noHooks since we'll take care of the hooks on API level, to make it more generalized
            $loginResult = $this->getAuthController()->login(
                $username,
                $password,
                ['passwordEncrypted' => false, 'noRedirect' => true, 'noHooks' => true]
            );
            if ($loginResult) {
                return $loginResult;
            }
        } catch (AuthenticationException $e) {
            throw new DotbApiExceptionNeedLogin($e->getMessage());
        }

        throw new DotbApiExceptionNeedLogin($this->getTranslatedMessage('ERR_INVALID_PASSWORD', 'Users'));
    }

    /**
     * @return AuthenticationController
     */
    protected function getAuthController()
    {
        return AuthenticationController::getInstance();
    }

    /**
     * Translate message by its label for a specified module.
     * Wrapper for Dotb's translate function.
     *
     * @param string $label
     * @param string $module
     * @return string
     */
    protected function getTranslatedMessage($label, $module)
    {
        return translate($label, $module);
    }
}
