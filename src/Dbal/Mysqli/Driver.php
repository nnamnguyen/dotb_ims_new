<?php


namespace Dotbcrm\Dotbcrm\Dbal\Mysqli;

use Doctrine\DBAL\Driver\Mysqli\Driver as BaseDriver;

/**
 * MySQLi driver
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
