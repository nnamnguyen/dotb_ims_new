<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: provider/v1alpha/provider.proto

namespace Dotbcrm\Apis\Iam\Provider\V1alpha;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>dotbcrm.apis.iam.provider.v1alpha.LocalProvider</code>
 */
class LocalProvider extends \Google\Protobuf\Internal\Message
{
    /**
     * srn:cloud:idp:eu:1234567890:auth-config:local
     *
     * Generated from protobuf field <code>string name = 1;</code>
     */
    private $name = '';
    /**
     * Local configuration
     *
     * Generated from protobuf field <code>.dotbcrm.apis.iam.provider.v1alpha.LocalConfig config = 2;</code>
     */
    private $config = null;

    public function __construct() {
        \GPBMetadata\Provider\V1Alpha\Provider::initOnce();
        parent::__construct();
    }

    /**
     * srn:cloud:idp:eu:1234567890:auth-config:local
     *
     * Generated from protobuf field <code>string name = 1;</code>
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * srn:cloud:idp:eu:1234567890:auth-config:local
     *
     * Generated from protobuf field <code>string name = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setName($var)
    {
        GPBUtil::checkString($var, True);
        $this->name = $var;

        return $this;
    }

    /**
     * Local configuration
     *
     * Generated from protobuf field <code>.dotbcrm.apis.iam.provider.v1alpha.LocalConfig config = 2;</code>
     * @return \Dotbcrm\Apis\Iam\Provider\V1alpha\LocalConfig
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Local configuration
     *
     * Generated from protobuf field <code>.dotbcrm.apis.iam.provider.v1alpha.LocalConfig config = 2;</code>
     * @param \Dotbcrm\Apis\Iam\Provider\V1alpha\LocalConfig $var
     * @return $this
     */
    public function setConfig($var)
    {
        GPBUtil::checkMessage($var, \Dotbcrm\Apis\Iam\Provider\V1alpha\LocalConfig::class);
        $this->config = $var;

        return $this;
    }

}

