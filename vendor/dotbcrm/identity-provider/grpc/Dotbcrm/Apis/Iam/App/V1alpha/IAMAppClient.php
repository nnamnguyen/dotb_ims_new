<?php
// GENERATED CODE -- DO NOT EDIT!

// Original file comments:
// Copyright 2017 DotbCRM Inc. All rights reserved.
//
namespace Dotbcrm\Apis\Iam\App\V1alpha;

/**
 */
class IAMAppClient extends \Grpc\BaseStub {

    /**
     * @param string $hostname hostname
     * @param array $opts channel options
     * @param \Grpc\Channel $channel (optional) re-use channel object
     */
    public function __construct($hostname, $opts, $channel = null) {
        parent::__construct($hostname, $opts, $channel);
    }

    /**
     * Registers a new server side application
     *
     * Setttings:
     *  - response_type: code, token, id_token
     *  - grant_type: authorization_code, refresh_token
     *  - public: false
     *  - redirect URI (configurable):
     *      - only https://
     *      - http://localhost
     * @param \Dotbcrm\Apis\Iam\App\V1alpha\RegisterServerSideAppRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function RegisterServerSideApp(\Dotbcrm\Apis\Iam\App\V1alpha\RegisterServerSideAppRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/dotbcrm.apis.iam.app.v1alpha.IAMApp/RegisterServerSideApp',
        $argument,
        ['\Dotbcrm\Apis\Iam\App\V1alpha\App', 'decode'],
        $metadata, $options);
    }

    /**
     * Registers a new native application
     * TODO: hydra does not support dynamic ports on loopback
     *
     * Setttings:
     *  - response_type: code, token, id_token
     *  - grant_type: authorization_code, refresh_token
     *  - public: true
     *  - redirect URI: (not-configurable)
     *      - http://127.0.0.1:range
     *      - http://[::1]:range
     *      - OOB copy/paste URL
     * @param \Dotbcrm\Apis\Iam\App\V1alpha\RegisterNativeAppRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function RegisterNativeApp(\Dotbcrm\Apis\Iam\App\V1alpha\RegisterNativeAppRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/dotbcrm.apis.iam.app.v1alpha.IAMApp/RegisterNativeApp',
        $argument,
        ['\Dotbcrm\Apis\Iam\App\V1alpha\App', 'decode'],
        $metadata, $options);
    }

    /**
     * Registers a new mobile application
     * TODO: same as native, but requires PKCE
     * rpc RegisterMobileApp (RegisterSPAAppRequest) returns (App) {}
     *
     * Registers a new client side application
     * TODO: implicit vs same as native but with validated redirect uri and cors
     *
     * Setttings:
     *  - response_type: token, id_token
     *  - grant_type: none
     *  - public: false
     * rpc RegisterClientSideApp (RegisterClientSideAppRequest) returns (App) {}
     *
     * Registers a new service application
     * TODO: cross check JWT bearer flow storing keys
     *
     * Setttings:
     *  - response_type: none
     *  - grant_type: client_credentials
     *  - public: false
     * rpc RegisterServiceApp (RegisterServiceAppRequest) returns (App) {}
     *
     * Update app.
     * @param \Dotbcrm\Apis\Iam\App\V1alpha\UpdateAppRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function UpdateApp(\Dotbcrm\Apis\Iam\App\V1alpha\UpdateAppRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/dotbcrm.apis.iam.app.v1alpha.IAMApp/UpdateApp',
        $argument,
        ['\Dotbcrm\Apis\Iam\App\V1alpha\App', 'decode'],
        $metadata, $options);
    }

    /**
     * Get app.
     * @param \Dotbcrm\Apis\Iam\App\V1alpha\GetAppRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function GetApp(\Dotbcrm\Apis\Iam\App\V1alpha\GetAppRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/dotbcrm.apis.iam.app.v1alpha.IAMApp/GetApp',
        $argument,
        ['\Dotbcrm\Apis\Iam\App\V1alpha\App', 'decode'],
        $metadata, $options);
    }

    /**
     * Delete app.
     * @param \Dotbcrm\Apis\Iam\App\V1alpha\DeleteAppRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function DeleteApp(\Dotbcrm\Apis\Iam\App\V1alpha\DeleteAppRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/dotbcrm.apis.iam.app.v1alpha.IAMApp/DeleteApp',
        $argument,
        ['\Google\Protobuf\GPBEmpty', 'decode'],
        $metadata, $options);
    }

    /**
     * List registered apps.
     * @param \Dotbcrm\Apis\Iam\App\V1alpha\ListAppsRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function ListApps(\Dotbcrm\Apis\Iam\App\V1alpha\ListAppsRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/dotbcrm.apis.iam.app.v1alpha.IAMApp/ListApps',
        $argument,
        ['\Dotbcrm\Apis\Iam\App\V1alpha\ListAppsResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * Regenerate secret.
     * @param \Dotbcrm\Apis\Iam\App\V1alpha\RegenerateSecretRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function RegenerateSecret(\Dotbcrm\Apis\Iam\App\V1alpha\RegenerateSecretRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/dotbcrm.apis.iam.app.v1alpha.IAMApp/RegenerateSecret',
        $argument,
        ['\Google\Protobuf\GPBEmpty', 'decode'],
        $metadata, $options);
    }

    /**
     * Only applicable for non-public apps (webapp, native ????)
     * @param \Dotbcrm\Apis\Iam\App\V1alpha\EnableIdentityRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function EnableIdentity(\Dotbcrm\Apis\Iam\App\V1alpha\EnableIdentityRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/dotbcrm.apis.iam.app.v1alpha.IAMApp/EnableIdentity',
        $argument,
        ['\Google\Protobuf\GPBEmpty', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Dotbcrm\Apis\Iam\App\V1alpha\RemoveIdentityRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function RemoveIdentity(\Dotbcrm\Apis\Iam\App\V1alpha\RemoveIdentityRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/dotbcrm.apis.iam.app.v1alpha.IAMApp/RemoveIdentity',
        $argument,
        ['\Google\Protobuf\GPBEmpty', 'decode'],
        $metadata, $options);
    }

}
