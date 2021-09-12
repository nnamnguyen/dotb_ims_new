<?php

namespace Dotbcrm\IdentityProvider\Authentication;

/**
 * Class OneTimeToken
 * @package Dotbcrm\IdentityProvider\Authentication
 */
class OneTimeToken
{
    /**
     * @var string
     */
    protected $token;

    /**
     * @var string
     */
    protected $tenantId;

    /**
     * @var string
     */
    protected $userId;

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     *
     * @return OneTimeToken
     */
    public function setToken(string $token): self
    {
        $this->token = $token;
        return $this;
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
     *
     * @return OneTimeToken
     */
    public function setTenantId(string $tenantId): self
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
     *
     * @return OneTimeToken
     */
    public function setUserId(string $userId): self
    {
        $this->userId = $userId;
        return $this;
    }
}
