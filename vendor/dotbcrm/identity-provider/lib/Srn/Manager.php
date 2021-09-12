<?php


namespace Dotbcrm\IdentityProvider\Srn;

/**
 * Simple operations with srn.
 */
class Manager
{
    const USERS_SERVICE = 'iam';
    /**
     * @var array
     */
    protected $config;

    /**
     * @param array $config
     */
    public function __construct(array $config)
    {
        if (empty($config['partition'])) {
            throw new \InvalidArgumentException('Partition MUST be set');
        }

        if (empty($config['region'])) {
            $config['region'] = '';
        }

        $this->config = $config;
    }

    /**
     * Create User Srn based on Srn prototype.
     *
     * @param string $tenantId Tenant id
     * @param string $userId
     * @return Srn
     */
    public function createUserSrn($tenantId, $userId)
    {
        $srn = new Srn();
        return $srn->setPartition($this->config['partition'])
            ->setService(static::USERS_SERVICE)
            ->setRegion('')
            ->setTenantId($tenantId)
            ->setResource(['user', $userId]);
    }

    /**
     * Create tenant SRN based on SRN prototype.
     *
     * @param string $tenantId Tenant id
     * @return Srn
     */
    public function createTenantSrn($tenantId)
    {
        $srn = new Srn();
        return $srn->setPartition($this->config['partition'])
            ->setService(static::USERS_SERVICE)
            ->setRegion($this->config['region'])
            ->setTenantId($tenantId)
            ->setResource(['tenant']);
    }
}
