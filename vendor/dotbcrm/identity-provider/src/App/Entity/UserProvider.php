<?php

namespace Dotbcrm\IdentityProvider\App\Entity;

/**
 * Class UserProvider
 * @package Dotbcrm\IdentityProvider\App\Entity
 */
class UserProvider
{
    /**
     * @var string
     */
    private $tenantId;

    /**
     * @var string
     */
    private $userId;

    /**
     * @var string
     */
    private $providerCode;

    /**
     * @var string
     */
    private $identityValue;

    /**
     * @param array $data
     * @return UserProvider
     */
    public static function fromArray(array $data): UserProvider
    {
        $userProviders = new self();
        return $userProviders->setTenantId($data['tenant_id'])
            ->setUserId($data['user_id'])
            ->setProviderCode($data['provider_code'])
            ->setIdentityValue($data['identity_value']);
    }

    /**
     * @return string
     */
    public function getTenantId(): string
    {
        return $this->tenantId;
    }

    /**
     * @param string $tenantId
     * @return UserProvider
     */
    public function setTenantId(string $tenantId): UserProvider
    {
        $this->tenantId = $tenantId;
        return $this;
    }

    /**
     * @return string
     */
    public function getUserId(): string
    {
        return $this->userId;
    }

    /**
     * @param string $userId
     * @return UserProvider
     */
    public function setUserId(string $userId): UserProvider
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @return string
     */
    public function getProviderCode(): string
    {
        return $this->providerCode;
    }

    /**
     * @param string $providerCode
     * @return UserProvider
     */
    public function setProviderCode(string $providerCode): UserProvider
    {
        $this->providerCode = $providerCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getIdentityValue(): string
    {
        return $this->identityValue;
    }

    /**
     * @param string $identityValue
     * @return UserProvider
     */
    public function setIdentityValue(string $identityValue): UserProvider
    {
        $this->identityValue = $identityValue;
        return $this;
    }
}
