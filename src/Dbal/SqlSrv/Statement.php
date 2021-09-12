<?php


namespace Dotbcrm\Dotbcrm\Dbal\SqlSrv;

use Doctrine\DBAL\Driver\SQLSrv\SQLSrvStatement as BaseStatement;

/**
 * SQL Server statement
 */
class Statement extends BaseStatement
{
    /**
     * {@inheritdoc}
     *
     * Explicitly cast numeric values to string since it's important for SQL Server,
     * but Doctrine DBAL doesn't pass the "string" binding type to the DB driver
     *
     * @link https://github.com/doctrine/dbal/issues/2369
     * @link https://msdn.microsoft.com/en-us/library/ms190309.aspx
     */
    public function bindValue($param, $value, $type = null)
    {
        // until we get rid of numeric IDs, we have to cast integers to strings in order to avoid
        // string to integer conversion errors on the database side
        if (is_int($value)) {
            $value = (string) $value;
        }

        return parent::bindValue($param, $value, $type);
    }
}
