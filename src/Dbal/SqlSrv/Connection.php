<?php


namespace Dotbcrm\Dotbcrm\Dbal\SqlSrv;

use Doctrine\DBAL\Driver\SQLSrv\SQLSrvConnection as BaseConnection;

/**
 * MS SQL Server connection
 */
class Connection extends BaseConnection
{
    /**
     * @var \Doctrine\DBAL\Driver\SQLSrv\SQLSrvStatement[]
     */
    protected $statements = array();

    /**
     * @param resource $connection
     */
    public function __construct($connection)
    {
        $this->conn = $connection;
    }

    /**
     * {@inheritdoc}
     *
     * Reuse existing statements
     */
    public function prepare($sql)
    {
        $hash = md5($sql);
        if (isset($this->statements[$hash])) {
            $stmt = $this->statements[$hash];
        } else {
            $stmt = $this->statements[$hash] = new Statement($this->conn, $sql, $this->lastInsertId);
        }

        return $stmt;
    }
}
