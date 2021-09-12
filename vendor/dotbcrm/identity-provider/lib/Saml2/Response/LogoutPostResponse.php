<?php


namespace Dotbcrm\IdentityProvider\Saml2\Response;

class LogoutPostResponse extends \OneLogin_Saml2_LogoutResponse
{
    /**
     * last error
     * @var string
     */
    protected $lastError;

    /**
     * @inheritdoc
     */
    public function isValid($requestId = null, $retrieveParametersFromServer = false)
    {
        $isValid = parent::isValid($requestId, $retrieveParametersFromServer);

        if (!$isValid) {
            return $isValid;
        }

        $idpData = $this->_settings->getIdPData();
        $securityData = $this->_settings->getSecurityData();
        if (!empty($securityData['wantMessagesSigned'])) {
            try {
                $isValid = \OneLogin_Saml2_Utils::validateSign(
                    $this->document,
                    $idpData['x509cert'],
                    null,
                    null
                );
            } catch (\Exception $e) {
                $this->setLastError($e->getMessage());
                return false;
            }
        }

        return $isValid;
    }

    /**
     * Return SAML response error
     * Only one error(parent or self) can be set at one moment
     * @return string
     */
    public function getError()
    {
        return $this->lastError . parent::getError();
    }

    /**
     * set error
     * @param string $lastError
     *
     * @return LogoutPostResponse
     */
    public function setLastError($lastError)
    {
        $this->lastError = $lastError;

        return $this;
    }
}
