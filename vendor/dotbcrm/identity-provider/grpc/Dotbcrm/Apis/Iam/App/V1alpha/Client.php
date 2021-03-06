<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: app/v1alpha/client.proto

namespace Dotbcrm\Apis\Iam\App\V1alpha;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * OAuth2 client
 *
 * Generated from protobuf message <code>dotbcrm.apis.iam.app.v1alpha.Client</code>
 */
class Client extends \Google\Protobuf\Internal\Message
{
    /**
     * Base OAuth2 parameters
     *
     * Generated from protobuf field <code>string client_id = 1;</code>
     */
    private $client_id = '';
    /**
     * Generated from protobuf field <code>string client_secret = 2;</code>
     */
    private $client_secret = '';
    /**
     * Generated from protobuf field <code>string tenant_id = 3;</code>
     */
    private $tenant_id = '';
    /**
     * Generated from protobuf field <code>string issuer = 4;</code>
     */
    private $issuer = '';
    /**
     * Generated from protobuf field <code>string auth_uri = 5;</code>
     */
    private $auth_uri = '';
    /**
     * Generated from protobuf field <code>string token_uri = 6;</code>
     */
    private $token_uri = '';
    /**
     * Generated from protobuf field <code>repeated string redirect_uris = 7;</code>
     */
    private $redirect_uris;
    /**
     * JWT bearer flow parameters
     *
     * Generated from protobuf field <code>string key_set_id = 8;</code>
     */
    private $key_set_id = '';
    /**
     * Generated from protobuf field <code>string private_key = 9;</code>
     */
    private $private_key = '';
    /**
     * Generated from protobuf field <code>string public_key = 10;</code>
     */
    private $public_key = '';
    /**
     * Generated from protobuf field <code>string public_key_uri = 11;</code>
     */
    private $public_key_uri = '';

    public function __construct() {
        \GPBMetadata\App\V1Alpha\Client::initOnce();
        parent::__construct();
    }

    /**
     * Base OAuth2 parameters
     *
     * Generated from protobuf field <code>string client_id = 1;</code>
     * @return string
     */
    public function getClientId()
    {
        return $this->client_id;
    }

    /**
     * Base OAuth2 parameters
     *
     * Generated from protobuf field <code>string client_id = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setClientId($var)
    {
        GPBUtil::checkString($var, True);
        $this->client_id = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string client_secret = 2;</code>
     * @return string
     */
    public function getClientSecret()
    {
        return $this->client_secret;
    }

    /**
     * Generated from protobuf field <code>string client_secret = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setClientSecret($var)
    {
        GPBUtil::checkString($var, True);
        $this->client_secret = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string tenant_id = 3;</code>
     * @return string
     */
    public function getTenantId()
    {
        return $this->tenant_id;
    }

    /**
     * Generated from protobuf field <code>string tenant_id = 3;</code>
     * @param string $var
     * @return $this
     */
    public function setTenantId($var)
    {
        GPBUtil::checkString($var, True);
        $this->tenant_id = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string issuer = 4;</code>
     * @return string
     */
    public function getIssuer()
    {
        return $this->issuer;
    }

    /**
     * Generated from protobuf field <code>string issuer = 4;</code>
     * @param string $var
     * @return $this
     */
    public function setIssuer($var)
    {
        GPBUtil::checkString($var, True);
        $this->issuer = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string auth_uri = 5;</code>
     * @return string
     */
    public function getAuthUri()
    {
        return $this->auth_uri;
    }

    /**
     * Generated from protobuf field <code>string auth_uri = 5;</code>
     * @param string $var
     * @return $this
     */
    public function setAuthUri($var)
    {
        GPBUtil::checkString($var, True);
        $this->auth_uri = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string token_uri = 6;</code>
     * @return string
     */
    public function getTokenUri()
    {
        return $this->token_uri;
    }

    /**
     * Generated from protobuf field <code>string token_uri = 6;</code>
     * @param string $var
     * @return $this
     */
    public function setTokenUri($var)
    {
        GPBUtil::checkString($var, True);
        $this->token_uri = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>repeated string redirect_uris = 7;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getRedirectUris()
    {
        return $this->redirect_uris;
    }

    /**
     * Generated from protobuf field <code>repeated string redirect_uris = 7;</code>
     * @param string[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setRedirectUris($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::STRING);
        $this->redirect_uris = $arr;

        return $this;
    }

    /**
     * JWT bearer flow parameters
     *
     * Generated from protobuf field <code>string key_set_id = 8;</code>
     * @return string
     */
    public function getKeySetId()
    {
        return $this->key_set_id;
    }

    /**
     * JWT bearer flow parameters
     *
     * Generated from protobuf field <code>string key_set_id = 8;</code>
     * @param string $var
     * @return $this
     */
    public function setKeySetId($var)
    {
        GPBUtil::checkString($var, True);
        $this->key_set_id = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string private_key = 9;</code>
     * @return string
     */
    public function getPrivateKey()
    {
        return $this->private_key;
    }

    /**
     * Generated from protobuf field <code>string private_key = 9;</code>
     * @param string $var
     * @return $this
     */
    public function setPrivateKey($var)
    {
        GPBUtil::checkString($var, True);
        $this->private_key = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string public_key = 10;</code>
     * @return string
     */
    public function getPublicKey()
    {
        return $this->public_key;
    }

    /**
     * Generated from protobuf field <code>string public_key = 10;</code>
     * @param string $var
     * @return $this
     */
    public function setPublicKey($var)
    {
        GPBUtil::checkString($var, True);
        $this->public_key = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string public_key_uri = 11;</code>
     * @return string
     */
    public function getPublicKeyUri()
    {
        return $this->public_key_uri;
    }

    /**
     * Generated from protobuf field <code>string public_key_uri = 11;</code>
     * @param string $var
     * @return $this
     */
    public function setPublicKeyUri($var)
    {
        GPBUtil::checkString($var, True);
        $this->public_key_uri = $var;

        return $this;
    }

}

