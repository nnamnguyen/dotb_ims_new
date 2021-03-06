<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: user/v1alpha/user.proto

namespace Dotbcrm\Apis\Iam\User\V1alpha;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>dotbcrm.apis.iam.user.v1alpha.ListUsersResponse</code>
 */
class ListUsersResponse extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>repeated .dotbcrm.apis.iam.user.v1alpha.User users = 1;</code>
     */
    private $users;
    /**
     * Generated from protobuf field <code>string next_page_token = 2;</code>
     */
    private $next_page_token = '';

    public function __construct() {
        \GPBMetadata\User\V1Alpha\User::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>repeated .dotbcrm.apis.iam.user.v1alpha.User users = 1;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Generated from protobuf field <code>repeated .dotbcrm.apis.iam.user.v1alpha.User users = 1;</code>
     * @param \Dotbcrm\Apis\Iam\User\V1alpha\User[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setUsers($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Dotbcrm\Apis\Iam\User\V1alpha\User::class);
        $this->users = $arr;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string next_page_token = 2;</code>
     * @return string
     */
    public function getNextPageToken()
    {
        return $this->next_page_token;
    }

    /**
     * Generated from protobuf field <code>string next_page_token = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setNextPageToken($var)
    {
        GPBUtil::checkString($var, True);
        $this->next_page_token = $var;

        return $this;
    }

}

