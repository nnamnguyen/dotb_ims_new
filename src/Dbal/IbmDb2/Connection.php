<?php



namespace Dotbcrm\Dotbcrm\Dbal\IbmDb2;

use Doctrine\DBAL\Driver\IBMDB2\DB2Connection as BaseConnection;
use Doctrine\DBAL\Driver\IBMDB2\DB2Exception;
use Dotbcrm\Dotbcrm\Dbal\SetConnectionTrait;

/**
 * IBM DB2 connection
 */
class Connection extends BaseConnection
{
    /**
     * @var \Doctrine\DBAL\Driver\IBMDB2\DB2Statement[]
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
    public function prepare($sql)
    {
        $hash = md5($sql);

        if (isset($this->statements[$hash])) {
            return $this->statements[$hash];
        }

        $db2Stmt = @db2_prepare($this->conn, $sql);

        if (!$db2Stmt) {
            throw new DB2Exception(db2_stmt_errormsg());
        }

        $stmt = $this->statements[$hash] = new Statement($db2Stmt);

        return $stmt;
    }
}
