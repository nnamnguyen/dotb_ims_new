<?php


namespace Dotbcrm\IdentityProvider\App\Repository;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DBALException;
use Dotbcrm\IdentityProvider\Authentication\Tenant;
use Dotbcrm\IdentityProvider\Srn\Converter;

class TenantRepository
{
    public const TABLE = 'tenants';

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
     * @param string $id
     * @return Tenant
     *
     * @throws \RuntimeException
     */
    public function findTenantById(string $id): Tenant
    {
        try {
            $data = $this->db->fetchAssoc(
                sprintf('SELECT * FROM %s WHERE id = ?', self::TABLE),
                [Converter::normalizeTenantId($id)]
            );
        } catch (DBALException $e) {
            throw new \RuntimeException('Tenant not found.');
        }


        if (empty($data)) {
            throw new \RuntimeException('Tenant not found.');
        }

        return Tenant::fromArray($data);
    }
}
