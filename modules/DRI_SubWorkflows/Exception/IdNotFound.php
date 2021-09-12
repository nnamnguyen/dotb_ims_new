<?php

require_once 'modules/DRI_SubWorkflows/Exception/NotFound.php';

/**
 * @author Emil Kilhage <emil.kilhage@addoptify.com>
 */
class DRI_SubWorkflows_Exception_IdNotFound extends DRI_SubWorkflows_Exception_NotFound
{
    /**
     * @param string $id
     */
    public function __construct($id)
    {
        parent::__construct("Could not found Customer Insight Stage with id '$id'");
    }
}
