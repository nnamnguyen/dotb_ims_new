<?php
// GENERATED CODE -- DO NOT EDIT!

// Original file comments:
// Copyright 2018 DotbCRM Inc. All rights reserved.
//
namespace Dotbcrm\Apis\Iam\Provider\V1alpha;

/**
 * Service that implements the Provider API
 */
class ProviderAPIClient extends \Grpc\BaseStub {

    /**
     * @param string $hostname hostname
     * @param array $opts channel options
     * @param \Grpc\Channel $channel (optional) re-use channel object
     */
    public function __construct($hostname, $opts, $channel = null) {
        parent::__construct($hostname, $opts, $channel);
    }

    /**
     * Configure Local User Provider
     * @param \Dotbcrm\Apis\Iam\Provider\V1alpha\ConfigureLocalProviderRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function ConfigureLocalProvider(\Dotbcrm\Apis\Iam\Provider\V1alpha\ConfigureLocalProviderRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/dotbcrm.apis.iam.provider.v1alpha.ProviderAPI/ConfigureLocalProvider',
        $argument,
        ['\Dotbcrm\Apis\Iam\Provider\V1alpha\LocalProvider', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Dotbcrm\Apis\Iam\Provider\V1alpha\GetLocalProviderRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function GetLocalProvider(\Dotbcrm\Apis\Iam\Provider\V1alpha\GetLocalProviderRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/dotbcrm.apis.iam.provider.v1alpha.ProviderAPI/GetLocalProvider',
        $argument,
        ['\Dotbcrm\Apis\Iam\Provider\V1alpha\LocalProvider', 'decode'],
        $metadata, $options);
    }

    /**
     * Configure LDAP Provider
     * @param \Dotbcrm\Apis\Iam\Provider\V1alpha\ConfigureLdapProviderRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function ConfigureLdapProvider(\Dotbcrm\Apis\Iam\Provider\V1alpha\ConfigureLdapProviderRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/dotbcrm.apis.iam.provider.v1alpha.ProviderAPI/ConfigureLdapProvider',
        $argument,
        ['\Dotbcrm\Apis\Iam\Provider\V1alpha\LdapProvider', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Dotbcrm\Apis\Iam\Provider\V1alpha\GetLdapProviderRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function GetLdapProvider(\Dotbcrm\Apis\Iam\Provider\V1alpha\GetLdapProviderRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/dotbcrm.apis.iam.provider.v1alpha.ProviderAPI/GetLdapProvider',
        $argument,
        ['\Dotbcrm\Apis\Iam\Provider\V1alpha\LdapProvider', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Dotbcrm\Apis\Iam\Provider\V1alpha\DeleteLdapProviderRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function DeleteLdapProvider(\Dotbcrm\Apis\Iam\Provider\V1alpha\DeleteLdapProviderRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/dotbcrm.apis.iam.provider.v1alpha.ProviderAPI/DeleteLdapProvider',
        $argument,
        ['\Google\Protobuf\GPBEmpty', 'decode'],
        $metadata, $options);
    }

    /**
     * Configure SAML Provider
     * @param \Dotbcrm\Apis\Iam\Provider\V1alpha\ConfigureSamlProviderRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function ConfigureSamlProvider(\Dotbcrm\Apis\Iam\Provider\V1alpha\ConfigureSamlProviderRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/dotbcrm.apis.iam.provider.v1alpha.ProviderAPI/ConfigureSamlProvider',
        $argument,
        ['\Dotbcrm\Apis\Iam\Provider\V1alpha\SamlProvider', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Dotbcrm\Apis\Iam\Provider\V1alpha\GetSamlProviderRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function GetSamlProvider(\Dotbcrm\Apis\Iam\Provider\V1alpha\GetSamlProviderRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/dotbcrm.apis.iam.provider.v1alpha.ProviderAPI/GetSamlProvider',
        $argument,
        ['\Dotbcrm\Apis\Iam\Provider\V1alpha\SamlProvider', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Dotbcrm\Apis\Iam\Provider\V1alpha\DeleteSamlProviderRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function DeleteSamlProvider(\Dotbcrm\Apis\Iam\Provider\V1alpha\DeleteSamlProviderRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/dotbcrm.apis.iam.provider.v1alpha.ProviderAPI/DeleteSamlProvider',
        $argument,
        ['\Google\Protobuf\GPBEmpty', 'decode'],
        $metadata, $options);
    }

}
