<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: app/v1alpha/app.proto

namespace Dotbcrm\Apis\Iam\App\V1alpha;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>dotbcrm.apis.iam.app.v1alpha.UpdateAppRequest</code>
 */
class UpdateAppRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * The application to create
     *
     * Generated from protobuf field <code>.dotbcrm.apis.iam.app.v1alpha.App app = 1;</code>
     */
    private $app = null;

    public function __construct() {
        \GPBMetadata\App\V1Alpha\App::initOnce();
        parent::__construct();
    }

    /**
     * The application to create
     *
     * Generated from protobuf field <code>.dotbcrm.apis.iam.app.v1alpha.App app = 1;</code>
     * @return \Dotbcrm\Apis\Iam\App\V1alpha\App
     */
    public function getApp()
    {
        return $this->app;
    }

    /**
     * The application to create
     *
     * Generated from protobuf field <code>.dotbcrm.apis.iam.app.v1alpha.App app = 1;</code>
     * @param \Dotbcrm\Apis\Iam\App\V1alpha\App $var
     * @return $this
     */
    public function setApp($var)
    {
        GPBUtil::checkMessage($var, \Dotbcrm\Apis\Iam\App\V1alpha\App::class);
        $this->app = $var;

        return $this;
    }

}

