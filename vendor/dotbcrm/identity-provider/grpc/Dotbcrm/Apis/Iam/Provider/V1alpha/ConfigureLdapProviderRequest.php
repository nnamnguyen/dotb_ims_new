<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: provider/v1alpha/provider.proto

namespace Dotbcrm\Apis\Iam\Provider\V1alpha;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>dotbcrm.apis.iam.provider.v1alpha.ConfigureLdapProviderRequest</code>
 */
class ConfigureLdapProviderRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>.dotbcrm.apis.iam.provider.v1alpha.LdapProvider provider = 1;</code>
     */
    private $provider = null;

    public function __construct() {
        \GPBMetadata\Provider\V1Alpha\Provider::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>.dotbcrm.apis.iam.provider.v1alpha.LdapProvider provider = 1;</code>
     * @return \Dotbcrm\Apis\Iam\Provider\V1alpha\LdapProvider
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * Generated from protobuf field <code>.dotbcrm.apis.iam.provider.v1alpha.LdapProvider provider = 1;</code>
     * @param \Dotbcrm\Apis\Iam\Provider\V1alpha\LdapProvider $var
     * @return $this
     */
    public function setProvider($var)
    {
        GPBUtil::checkMessage($var, \Dotbcrm\Apis\Iam\Provider\V1alpha\LdapProvider::class);
        $this->provider = $var;

        return $this;
    }

}

