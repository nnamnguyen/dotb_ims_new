<?php


namespace Dotbcrm\Dotbcrm\Dbal\SqlSrv;

use Doctrine\DBAL\Driver\SQLSrv\Driver as BaseDriver;

/**
 * MS SQL Server driver
 */
class Driver extends BaseDriver
{
    /**
     * {@inheritdoc}
     */
    public function connect(array $params, $username = null, $password = null, array $driverOptions = array())
    {
        return new Connection($params['connection']);
    }
}
