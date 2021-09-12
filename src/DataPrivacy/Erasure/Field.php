<?php declare(strict_types=1);


namespace Dotbcrm\Dotbcrm\DataPrivacy\Erasure;

use JsonSerializable;
use DotbBean;

/**
 * Represents a field marked for erasure
 */
interface Field extends JsonSerializable
{
    /**
     * Erases data from the given bean
     *
     * @param DotbBean $bean
     */
    public function erase(DotbBean $bean) : void;
}
