<?php

require_once 'modules/DRI_Workflow_Templates/Exception/NotFound.php';

/**
 * @author Emil Kilhage <emil.kilhage@addoptify.com>
 */
class DRI_Workflow_Templates_Exception_IdNotFound extends DRI_Workflow_Templates_Exception_NotFound
{
    /**
     * @param string $id
     */
    public function __construct($id)
    {
        parent::__construct("Could not found Customer Insight Template with id '$id'");
    }
}
