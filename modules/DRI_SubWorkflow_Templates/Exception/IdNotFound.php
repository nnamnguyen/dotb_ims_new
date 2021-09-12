<?php

require_once 'modules/DRI_SubWorkflow_Templates/Exception/NotFound.php';

/**
 * @author Emil Kilhage <emil.kilhage@addoptify.com>
 */
class DRI_SubWorkflow_Templates_Exception_IdNotFound extends DRI_SubWorkflow_Templates_Exception_NotFound
{
    /**
     * @param string $id
     */
    public function __construct($id)
    {
        parent::__construct("Could not found Customer Insight Stage Template with id '$id'");
    }
}
