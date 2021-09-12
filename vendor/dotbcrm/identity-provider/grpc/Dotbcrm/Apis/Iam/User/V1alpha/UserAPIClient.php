<?php
// GENERATED CODE -- DO NOT EDIT!

// Original file comments:
// Copyright 2018 DotbCRM Inc. All rights reserved.
//
namespace Dotbcrm\Apis\Iam\User\V1alpha;

/**
 * Service that implements the User API
 */
class UserAPIClient extends \Grpc\BaseStub {

    /**
     * @param string $hostname hostname
     * @param array $opts channel options
     * @param \Grpc\Channel $channel (optional) re-use channel object
     */
    public function __construct($hostname, $opts, $channel = null) {
        parent::__construct($hostname, $opts, $channel);
    }

    /**
     * Create User
     * @param \Dotbcrm\Apis\Iam\User\V1alpha\CreateUserRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function CreateUser(\Dotbcrm\Apis\Iam\User\V1alpha\CreateUserRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/dotbcrm.apis.iam.user.v1alpha.UserAPI/CreateUser',
        $argument,
        ['\Dotbcrm\Apis\Iam\User\V1alpha\User', 'decode'],
        $metadata, $options);
    }

    /**
     * Update an existing User
     * @param \Dotbcrm\Apis\Iam\User\V1alpha\UpdateUserRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function UpdateUser(\Dotbcrm\Apis\Iam\User\V1alpha\UpdateUserRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/dotbcrm.apis.iam.user.v1alpha.UserAPI/UpdateUser',
        $argument,
        ['\Dotbcrm\Apis\Iam\User\V1alpha\User', 'decode'],
        $metadata, $options);
    }

    /**
     * Retrieve a User
     * @param \Dotbcrm\Apis\Iam\User\V1alpha\GetUserRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function GetUser(\Dotbcrm\Apis\Iam\User\V1alpha\GetUserRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/dotbcrm.apis.iam.user.v1alpha.UserAPI/GetUser',
        $argument,
        ['\Dotbcrm\Apis\Iam\User\V1alpha\User', 'decode'],
        $metadata, $options);
    }

    /**
     * Delete a User
     * @param \Dotbcrm\Apis\Iam\User\V1alpha\DeleteUserRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function DeleteUser(\Dotbcrm\Apis\Iam\User\V1alpha\DeleteUserRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/dotbcrm.apis.iam.user.v1alpha.UserAPI/DeleteUser',
        $argument,
        ['\Google\Protobuf\GPBEmpty', 'decode'],
        $metadata, $options);
    }

    /**
     * List Users
     * @param \Dotbcrm\Apis\Iam\User\V1alpha\ListUsersRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function ListUsers(\Dotbcrm\Apis\Iam\User\V1alpha\ListUsersRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/dotbcrm.apis.iam.user.v1alpha.UserAPI/ListUsers',
        $argument,
        ['\Dotbcrm\Apis\Iam\User\V1alpha\ListUsersResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * Set the password for an existing User
     * This is only applicable for local users.
     * @param \Dotbcrm\Apis\Iam\User\V1alpha\SetPasswordRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function SetPassword(\Dotbcrm\Apis\Iam\User\V1alpha\SetPasswordRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/dotbcrm.apis.iam.user.v1alpha.UserAPI/SetPassword',
        $argument,
        ['\Google\Protobuf\GPBEmpty', 'decode'],
        $metadata, $options);
    }

    /**
     * Send the email with one-time token to a specific User with a link for resetting password.
     * This is only applicable for local users.
     * @param \Dotbcrm\Apis\Iam\User\V1alpha\SendEmailForResetPasswordRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function SendEmailForResetPassword(\Dotbcrm\Apis\Iam\User\V1alpha\SendEmailForResetPasswordRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/dotbcrm.apis.iam.user.v1alpha.UserAPI/SendEmailForResetPassword',
        $argument,
        ['\Google\Protobuf\GPBEmpty', 'decode'],
        $metadata, $options);
    }

}
