<?php
// GENERATED CODE -- DO NOT EDIT!

// Original file comments:
// Copyright 2018 DotbCRM Inc. All rights reserved.
//
namespace Dotbcrm\Apis\Iam\Tenant\V1alpha;

/**
 * Service that implements the Tenant API
 */
class TenantAPIClient extends \Grpc\BaseStub {

    /**
     * @param string $hostname hostname
     * @param array $opts channel options
     * @param \Grpc\Channel $channel (optional) re-use channel object
     */
    public function __construct($hostname, $opts, $channel = null) {
        parent::__construct($hostname, $opts, $channel);
    }

    /**
     * Create Tenant
     * @param \Dotbcrm\Apis\Iam\Tenant\V1alpha\CreateTenantRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function CreateTenant(\Dotbcrm\Apis\Iam\Tenant\V1alpha\CreateTenantRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/dotbcrm.apis.iam.tenant.v1alpha.TenantAPI/CreateTenant',
        $argument,
        ['\Dotbcrm\Apis\Iam\Tenant\V1alpha\Tenant', 'decode'],
        $metadata, $options);
    }

    /**
     * Update an existing Tenant
     * @param \Dotbcrm\Apis\Iam\Tenant\V1alpha\UpdateTenantRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function UpdateTenant(\Dotbcrm\Apis\Iam\Tenant\V1alpha\UpdateTenantRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/dotbcrm.apis.iam.tenant.v1alpha.TenantAPI/UpdateTenant',
        $argument,
        ['\Dotbcrm\Apis\Iam\Tenant\V1alpha\Tenant', 'decode'],
        $metadata, $options);
    }

    /**
     * Retrieve a Tenant
     * @param \Dotbcrm\Apis\Iam\Tenant\V1alpha\GetTenantRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function GetTenant(\Dotbcrm\Apis\Iam\Tenant\V1alpha\GetTenantRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/dotbcrm.apis.iam.tenant.v1alpha.TenantAPI/GetTenant',
        $argument,
        ['\Dotbcrm\Apis\Iam\Tenant\V1alpha\Tenant', 'decode'],
        $metadata, $options);
    }

    /**
     * Delete Tenant
     * rpc DeleteTenant (DeleteTenantRequest) returns (google.protobuf.Empty) {
     *    option (google.api.http) = {
     *        delete: "/v1alpha/iam/tenants/{name}"
     *    };
     * }
     *
     * List Tenants
     * @param \Dotbcrm\Apis\Iam\Tenant\V1alpha\ListTenantsRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function ListTenants(\Dotbcrm\Apis\Iam\Tenant\V1alpha\ListTenantsRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/dotbcrm.apis.iam.tenant.v1alpha.TenantAPI/ListTenants',
        $argument,
        ['\Dotbcrm\Apis\Iam\Tenant\V1alpha\ListTenantsResponse', 'decode'],
        $metadata, $options);
    }

}
