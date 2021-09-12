<?php



namespace Dotbcrm\Dotbcrm\Dbal\IbmDb2;

use Doctrine\DBAL\Driver\IBMDB2\DB2Driver as BaseDriver;
use Dotbcrm\Dotbcrm\Dbal\Platforms\IbmDb2Platform;

/**
 * IBM DB2 driver
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
