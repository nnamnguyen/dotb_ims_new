<?php

namespace Dotbcrm\IdentityProvider\App\Repository;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DBALException;
use Dotbcrm\IdentityProvider\App\Entity\UserProvider;
use Dotbcrm\IdentityProvider\Authentication\Provider\Providers;
use Dotbcrm\IdentityProvider\Srn\Converter;

/**
 * Class UserProvidersRepository
 * @package Dotbcrm\IdentityProvider\App\Repository
 */
class UserProvidersRepository
{
    public const TABLE = 'user_providers';

    /**
     * @var Connection
     */
    private $db;

    /**
     * @param Connection $db
     */
    public function __construct(Connection $db)
    {
        $this->db = $db;
    }

    /**
     * @param string $tenantId
     * @param string $identityValue
     * @return UserProvider
     */
    public function findLocalByTenantAndIdentity(string $tenantId, string $identityValue): UserProvider
    {
        try {
            $data = $this->db->fetchAssoc(
                sprintf(
                    'SELECT * FROM %s WHERE tenant_id = ? AND provider_code = ? AND identity_value = ?',
                    self::TABLE
                ),
                [Converter::normalizeTenantId($tenantId), Providers::LOCAL, $identityValue]
            );
        } catch (DBALException $e) {
            throw new \RuntimeException('User not found.');
        }


        if (empty($data)) {
            throw new \RuntimeException('User not found.');
        }

        return UserProvider::fromArray($data);
    }
}
