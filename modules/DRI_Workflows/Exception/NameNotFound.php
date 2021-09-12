<?php

require_once 'modules/DRI_Workflows/Exception/NotFound.php';

/**
 * @author Emil Kilhage <emil.kilhage@addoptify.com>
 */
class DRI_Workflows_Exception_NameNotFound extends DRI_Workflows_Exception_NotFound
{
    /**
     * @param string $name
     */
    public function __construct($name)
    {
        parent::__construct("Could not found Customer Insight with name '$name'");
    }
}
