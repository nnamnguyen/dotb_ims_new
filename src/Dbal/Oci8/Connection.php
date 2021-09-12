<?php



namespace Dotbcrm\Dotbcrm\Dbal\Oci8;

use Doctrine\DBAL\Driver\OCI8\OCI8Connection as BaseConnection;

/**
 * Oci8 connection
 */
class Connection extends BaseConnection
{
    /**
     * @param resource $connection
     */
    public function __construct($connection)
    {
        $this->dbh = $connection;
    }
}
