<?php


namespace Dotbcrm\Dotbcrm\Denormalization\TeamSecurity\Command;

use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\Connection;
use Psr\Log\LoggerInterface;
use Dotbcrm\Dotbcrm\Denormalization\TeamSecurity\Listener\Recorder;
use Dotbcrm\Dotbcrm\Denormalization\TeamSecurity\Listener\Updater;

/**
 * Performs full denormalized data rebuild
 */
final class Rebuild
{
    /**
     * @var Connection
     */
    private $conn;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * Constructor
     *
     * @param Connection $conn
     * @param LoggerInterface $logger
     */
    public function __construct(Connection $conn, LoggerInterface $logger)
    {
        $this->conn = $conn;
        $this->logger = $logger;
    }

    /**
     * Rebuilds denormalized data and store it in the given table
     *
     * @param string $table
     *
     * @throws DBALException
     */
    public function __invoke($table)
    {
        $this->conn->executeQuery(<<<SQL
DELETE FROM $table
SQL
        );

        $this->conn->executeQuery(<<<SQL
INSERT INTO $table
SELECT
    ts.id AS team_set_id,
    tm.user_id AS user_id
FROM team_sets ts
INNER JOIN team_sets_teams tst
    ON ts.id = tst.team_set_id
INNER JOIN teams t
    ON tst.team_id = t.id
    AND t.deleted = 0
INNER JOIN team_memberships tm
    ON t.id = tm.team_id
    AND tm.deleted = 0
GROUP BY ts.id, tm.user_id
SQL
        );

        $recorder = new Recorder($this->conn);
        $updater = new Updater($this->conn, $table);
        $recorder->replay($updater, $this->logger);
    }
}
