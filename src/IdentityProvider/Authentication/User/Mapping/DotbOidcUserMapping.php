<?php


namespace Dotbcrm\Dotbcrm\IdentityProvider\Authentication\User\Mapping;

use Dotbcrm\IdentityProvider\Authentication\UserMapping\MappingInterface;
use Dotbcrm\IdentityProvider\Authentication\User as IdmUser;
use Dotbcrm\Dotbcrm\IdentityProvider\Authentication\User;
use Dotbcrm\IdentityProvider\Srn\Converter;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;

class DotbOidcUserMapping implements MappingInterface
{
    const OIDC_USER_STATUS_ACTIVE = 0;
    const OIDC_USER_STATUS_INACTIVE = 1;

    protected $userMapping = [
        'user_name' => 'preferred_username',
        'first_name' => 'given_name',
        'last_name' => 'family_name',
        'phone_work' => 'phone_number',
        'email' => 'email',
    ];

    protected $addressMapping = [
        'address_street' => 'street_address',
        'address_city' => 'locality',
        'address_state' => 'region',
        'address_country' => 'country',
        'address_postalcode' => 'postal_code',
    ];

    /**
     * Map OIDC response to dotb user fields
     * @param array $response
     * @return array
     */
    public function map($response)
    {
        if (empty($response) || !is_array($response)) {
            return [];
        }

        $userData = ['status' => $this->getUserStatus($response)];

        foreach ($this->userMapping as $mangoKey => $oidcKey) {
            $userData[$mangoKey] = $this->getAttribute($response, $oidcKey);
        }
        foreach ($this->addressMapping as $mangoKey => $oidcKey) {
            $userData[$mangoKey] = $this->getAddressAttribute($response, $oidcKey);
        }
        return array_filter($userData, function ($value) {
            return !is_null($value);
        });
    }

    /**
     * @inheritDoc
     * @throws UsernameNotFoundException
     */
    public function mapIdentity($response)
    {
        if (!is_array($response) || empty($response['sub'])) {
            throw new UsernameNotFoundException('User not found in response');
        }

        return [
            'field' => 'id',
            'value' => $this->getUserIdFromSrn($response['sub']),
        ];
    }

    /**
     * @inheritDoc
     */
    public function getIdentityValue(IdmUser $user)
    {
        return $this->getUserIdFromSrn($user->getSrn());
    }

    /**
     * get user id from srn
     * @param string $srn
     * @return string
     * @throws UsernameNotFoundException
     */
    protected function getUserIdFromSrn($srn)
    {
        $userSrn = Converter::fromString($srn);
        $userResource = $userSrn->getResource();
        if (empty($userResource) || $userResource[0] != 'user' || empty($userResource[1])) {
            throw new UsernameNotFoundException('User not found in SRN');
        }
        return $userResource[1];
    }

    /**
     * get user attribute
     * @param array $response
     * @param string $name
     * @return mixed
     */
    protected function getAttribute(array $response, $name)
    {
        return isset($response[$name]) ? $response[$name] : null;
    }

    /**
     * get address value from token ID extension
     * @param array $response
     * @param string $name
     * @return null
     */
    protected function getAddressAttribute(array $response, $name)
    {
        return !empty($response['address'][$name]) ? $response['address'][$name] : null;
    }

    /**
     * return user status
     * @param array $response
     * @return null|string
     */
    protected function getUserStatus(array $response)
    {
        $status = $this->getAttribute($response, 'status');
        if (is_null($status)) {
            return null;
        }
        return (int) $status == self::OIDC_USER_STATUS_ACTIVE
            ? User::USER_STATUS_ACTIVE
            : User::USER_STATUS_INACTIVE;
    }
}
