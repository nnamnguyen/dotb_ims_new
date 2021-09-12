<?php


namespace Dotbcrm\Dotbcrm\Dbal;

use Doctrine\DBAL\Cache\QueryCacheProfile;
use Doctrine\DBAL\Portability\Connection as BaseConnection;
use Doctrine\DBAL\DBALException;
use Dotbcrm\Dotbcrm\Dbal\Query\QueryBuilder;

/**
 * {@inheritDoc}
 */
class Connection extends BaseConnection
{
    /**
     * {@inheritDoc}
     *
     * @return \Dotbcrm\Dotbcrm\Dbal\Query\QueryBuilder
     */
    public function createQueryBuilder()
    {
        return new QueryBuilder($this);
    }

    /**
     * {@inheritDoc}
     */
    public function executeQuery($query, array $params = array(), $types = array(), QueryCacheProfile $qcp = null)
    {
        try {
            return parent::executeQuery($query, $params, $types, $qcp);
        } catch (DBALException $e) {
            $this->logException($e);
            throw $e;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function executeUpdate($query, array $params = array(), array $types = array())
    {
        try {
            return parent::executeUpdate($query, $params, $types);
        } catch (DBALException $e) {
            $this->logException($e);
            throw $e;
        }
    }

    /**
     * Logs DBAL exception
     *
     * @param DBALException $e Exception
     */
    protected function logException(DBALException $e)
    {
        $GLOBALS['log']->fatal($e->getMessage());
    }
}
