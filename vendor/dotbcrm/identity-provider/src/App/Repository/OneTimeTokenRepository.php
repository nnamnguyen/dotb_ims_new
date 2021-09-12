<?php

namespace Dotbcrm\IdentityProvider\App\Repository;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DBALException;
use Dotbcrm\IdentityProvider\Authentication\OneTimeToken;
use Dotbcrm\IdentityProvider\Srn\Converter;

class OneTimeTokenRepository
{
    private const TABLE = 'one_time_token';

    /**
     * @var Connection
     */
    private $db;

    /**
     * Consent repository constructor.
     *
     * @param Connection $db
     */
    public function __construct(Connection $db)
    {
        $this->db = $db;
    }

    /**
     * @param string $token
     * @param string $tenantId
     * @return OneTimeToken
     * @throws \RuntimeException
     */
    public function findUserByTokenAndTenant(string $token, string $tenantId): OneTimeToken
    {
        try {
            $data = $this->db->fetchAssoc(
                sprintf(
                    'SELECT * FROM %s WHERE token = ? and tenant_id = ? AND expire_time > NOW()',
                    self::TABLE
                ),
                [$token, Converter::normalizeTenantId($tenantId)]
            );
        } catch (DBALException $e) {
            throw new \RuntimeException('One time token not found.');
        }


        if (empty($data)) {
            throw new \RuntimeException('One time token not found.');
        }

        return (new OneTimeToken())
            ->setToken($data['token'])
            ->setTenantId($data['tenant_id'])
            ->setUserId($data['user_id']);
    }

    /**
     * @param OneTimeToken $token
     * @throws DBALException
     * @throws \Doctrine\DBAL\Exception\InvalidArgumentException
     */
    public function delete(OneTimeToken $token): void
    {
        $this->db->delete(
            self::TABLE,
            ['token' => $token->getToken(), 'tenant_id' => $token->getTenantId()]
        );
    }
}
