<?php



namespace Dotbcrm\Dotbcrm\Dbal\Oci8;

use Doctrine\DBAL\Driver\OCI8\Driver as BaseDriver;

/**
 * Oci8 driver
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
