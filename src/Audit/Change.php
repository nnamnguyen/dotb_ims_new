<?php declare(strict_types=1);


namespace Dotbcrm\Dotbcrm\Audit;

use JsonSerializable;

/**
 * Represents a change to a field in the Audit log
 */
interface Change extends JsonSerializable
{
    /**
     * Constructs a new Audit Field Change from an in ['before', 'after'] format
     * @param array $change
     *
     * @return Change[]
     */
    public static function getAuditFieldChanges(array $change);

    /**
     * @return array[
     *  string field_name
     *  string data_type
     *  mixed before
     *  mixed after
     * ]
     */
    public function getChangeArray();
}
