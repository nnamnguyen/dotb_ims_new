<?php


namespace Dotbcrm\Dotbcrm\Dbal\IbmDb2;

use Doctrine\DBAL\Driver\IBMDB2\DB2Statement as BaseStatement;

/**
 * IBM DB2 statement
 */
class Statement extends BaseStatement
{
    /**
     * {@inheritdoc}
     *
     * @link https://bugs.php.net/bug.php?id=74703
     * @link https://bugs.php.net/bug.php?id=74732
     */
    public function execute($params = null)
    {
        if ($params && PHP_VERSION_ID >= 70000) {
            foreach ($params as $key => $value) {
                if (is_bool($value)) {
                    // cast boolean values to integers to avoid the PHP/DB2 bugs
                    $params[$key] = (int) $value;
                }
            }
        }

        return parent::execute($params);
    }
}
