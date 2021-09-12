<?php


namespace Dotbcrm\Dotbcrm\Security\Subject;

use Dotbcrm\Dotbcrm\Security\Subject;
use DotbBean;

/**
 * A Dotb user making changes through an API client
 */
abstract class Bean implements Subject
{
    /**
     * @var DotbBean
     */
    private $bean;

    /**
     * Constructor
     *
     * @param DotbBean $bean
     */
    public function __construct(DotbBean $bean)
    {
        $this->bean = $bean;
    }

    /**
     * {@inheritDoc}
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->bean->id,
            '_module' => $this->bean->module_name,
        ];
    }
}
