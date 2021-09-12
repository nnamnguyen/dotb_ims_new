<?php

require_once 'modules/DRI_Workflow_Task_Templates/Exception/NotFound.php';

/**
 * @author Emil Kilhage <emil.kilhage@addoptify.com>
 */
class DRI_Workflow_Task_Templates_Exception_NameNotFound extends DRI_Workflow_Task_Templates_Exception_NotFound
{
    /**
     * @param string $name
     */
    public function __construct($name)
    {
        parent::__construct("Could not found Customer Insight Activity Template with name '$name'");
    }
}
