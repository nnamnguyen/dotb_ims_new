<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: consent/v1alpha/consent.proto

namespace Dotbcrm\Apis\Iam\Consent\V1alpha;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>dotbcrm.apis.iam.consent.v1alpha.RegisterConsentRequest</code>
 */
class RegisterConsentRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>.dotbcrm.apis.iam.consent.v1alpha.Consent consent = 1;</code>
     */
    private $consent = null;

    public function __construct() {
        \GPBMetadata\Consent\V1Alpha\Consent::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>.dotbcrm.apis.iam.consent.v1alpha.Consent consent = 1;</code>
     * @return \Dotbcrm\Apis\Iam\Consent\V1alpha\Consent
     */
    public function getConsent()
    {
        return $this->consent;
    }

    /**
     * Generated from protobuf field <code>.dotbcrm.apis.iam.consent.v1alpha.Consent consent = 1;</code>
     * @param \Dotbcrm\Apis\Iam\Consent\V1alpha\Consent $var
     * @return $this
     */
    public function setConsent($var)
    {
        GPBUtil::checkMessage($var, \Dotbcrm\Apis\Iam\Consent\V1alpha\Consent::class);
        $this->consent = $var;

        return $this;
    }

}

