<?php


namespace Dotbcrm\IdentityProvider\Saml2\Request;

use OneLogin_Saml2_Settings;
use Dotbcrm\IdentityProvider\Authentication\Exception\ConfigurationException;

/**
 * Class to support POST binding request.
 *
 * Class LogoutPostRequest
 * @package Dotbcrm\IdentityProvider\Saml2
 */
class LogoutPostRequest extends \OneLogin_Saml2_LogoutRequest
{
    /**
     * @inheritdoc
     */
    public function __construct(
        OneLogin_Saml2_Settings $settings,
        $request = null,
        $nameId = null,
        $sessionIndex = null
    ) {
        parent::__construct($settings, $request, $nameId, $sessionIndex);

        $spData = $settings->getSPData();
        $securityData = $settings->getSecurityData();
        if (!empty($securityData['logoutRequestSigned']) && !empty($securityData['signatureAlgorithm'])) {
            if (empty($spData['privateKey']) || empty($spData['x509cert'])) {
                throw new ConfigurationException('Private key and x509cert should be defined');
            }
            $this->_logoutRequest = \OneLogin_Saml2_Utils::addSign(
                $this->_logoutRequest,
                $spData['privateKey'],
                $spData['x509cert'],
                $securityData['signatureAlgorithm']
            );
        }
    }
}
