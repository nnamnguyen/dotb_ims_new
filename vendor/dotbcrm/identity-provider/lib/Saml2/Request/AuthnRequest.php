<?php


namespace Dotbcrm\IdentityProvider\Saml2\Request;

use Dotbcrm\IdentityProvider\CSPRNG\GeneratorInterface;

/**
 * @inheritDoc
 * Class AuthnRequest
 * @package Dotbcrm\IdentityProvider\Saml2\Request
 */
class AuthnRequest extends \OneLogin_Saml2_AuthnRequest
{
    const REQUEST_ID_LENGTH = 40;

    const REQUEST_ID_PREFIX = 'IDM_';

    /**
     * @var GeneratorInterface
     */
    protected $generator;

    /**
     * SAML AuthNRequest string
     * @var string
     */
    protected $_authnRequest;

    /**
     * SAML AuthNRequest ID.
     * @var string
     */
    protected $_id;

    /**
     * @param \OneLogin_Saml2_Settings $settings
     * @param GeneratorInterface $generator
     * @param bool|false $forceAuthn
     * @param bool|false $isPassive
     * @param bool|true $setNameIdPolicy
     */
    public function __construct(
        \OneLogin_Saml2_Settings $settings,
        GeneratorInterface $generator,
        $forceAuthn = false,
        $isPassive = false,
        $setNameIdPolicy = true
    ) {
        $this->generator = $generator;

        parent::__construct($settings, $forceAuthn, $isPassive, $setNameIdPolicy);

        $id = $this->generator->generate(self::REQUEST_ID_LENGTH, self::REQUEST_ID_PREFIX);
        $oldId = parent::getId();
        $request = parent::getXML();
        $request = str_replace($oldId, $id, $request);

        $this->_authnRequest = $request;
        $this->_id = $id;
    }

    /**
     * @inheritDoc
     */
    public function getRequest($deflate = null)
    {
        $subject = $this->_authnRequest;

        if (is_null($deflate)) {
            $deflate = $this->_settings->shouldCompressRequests();
        }

        if ($deflate) {
            $subject = gzdeflate($this->_authnRequest);
        }

        $base64Request = base64_encode($subject);
        return $base64Request;
    }

    /**
     * @inheritDoc
     */
    public function getXML()
    {
        return $this->_authnRequest;
    }

    /**
     * @inheritDoc
     */
    public function getId()
    {
        return $this->_id;
    }
}
