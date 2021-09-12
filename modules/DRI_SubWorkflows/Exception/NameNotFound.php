<?php

require_once 'modules/DRI_SubWorkflows/Exception/NotFound.php';

/**
 * @author Emil Kilhage <emil.kilhage@addoptify.com>
 */
class DRI_SubWorkflows_Exception_NameNotFound extends DRI_SubWorkflows_Exception_NotFound
{
    /**
     * @param string $name
     */
    public function __construct($name)
    {
        parent::__construct("Could not found Customer Insight Stage with name '$name'");
    }
}
