<?php


namespace Dotbcrm\Dotbcrm\Dbal\Mysqli;

use Doctrine\DBAL\Driver\Mysqli\MysqliConnection as BaseConnection;
use Dotbcrm\Dotbcrm\Dbal\SetConnectionTrait;

/**
 * MySQLi connection
 */
class Connection extends BaseConnection
{
    /**
     * @var \Doctrine\DBAL\Driver\Mysqli\MysqliStatement[]
     */
    protected $statements = array();

    use SetConnectionTrait;

    /**
     * @param resource $connection
     */
    public function __construct($connection)
    {
        $this->setConnection($connection);
    }

    /**
     * {@inheritdoc}
     *
     * Reuse existing statements
     */
    public function prepare($prepareString)
    {
        $hash = md5($prepareString);
        if (isset($this->statements[$hash])) {
            $stmt = $this->statements[$hash];
        } else {
            $stmt = $this->statements[$hash] = parent::prepare($prepareString);
        }

        return $stmt;
    }
}
