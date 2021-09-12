<?php


namespace Dotbcrm\IdentityProvider\Authentication\UserMapping;

use Dotbcrm\IdentityProvider\Authentication\User;

/**
 * Interface MappingInterface.
 * Used for maintaining mapping of User attributes from third-party IdPs to App.
 *
 * @package Dotbcrm\IdentityProvider\Authentication\UserMapping
 */
interface MappingInterface
{
    /**
     * Map IdP's data to App User attributes.
     * The result contains 'name_id' as a main user identifier and other attributes.
     *
     * @param mixed $response
     * @return array
     */
    public function map($response);

    /**
     * Get pair ['field' => 'id-field', 'value' => 'id-value'] that can be used to search for User.
     *
     * @param mixed $response
     * @return array
     */
    public function mapIdentity($response);

    /**
     * Get SP identity value
     *
     * @param \Dotbcrm\IdentityProvider\Authentication\User
     *
     * @return string
     */
    public function getIdentityValue(User $user);
}
