<?php

require_once 'modules/DRI_SubWorkflow_Templates/Exception/NotFound.php';

/**
 * @author Emil Kilhage <emil.kilhage@addoptify.com>
 */
class DRI_SubWorkflow_Templates_Exception_NameNotFound extends DRI_SubWorkflow_Templates_Exception_NotFound
{
    /**
     * @param string $name
     */
    public function __construct($name)
    {
        parent::__construct("Could not found Customer Insight Stage Template with name '$name'");
    }
}
