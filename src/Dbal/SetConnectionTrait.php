<?php


namespace Dotbcrm\Dotbcrm\Dbal;

/**
 * Contains shared implementation of setting connection resource on the connection object
 */
trait SetConnectionTrait
{
    /**
     * @var resource|\mysqli
     */
    protected $conn;

    /**
     * Sets connection on the object
     *
     * @param resource|\mysqli $connection Connection resource or object
     */
    protected function setConnection($connection)
    {
        $re = new \ReflectionProperty(get_parent_class($this), '_conn');
        $re->setAccessible(true);
        $re->setValue($this, $connection);

        $this->conn = $connection;
    }
}
