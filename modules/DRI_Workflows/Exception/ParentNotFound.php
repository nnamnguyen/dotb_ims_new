<?php

require_once 'modules/DRI_Workflows/Exception/NotFound.php';

/**
 * @author Emil Kilhage <emil.kilhage@addoptify.com>
 */
class DRI_Workflows_Exception_ParentNotFound extends DRI_Workflows_Exception_NotFound
{
    /**
     *
     */
    public function __construct()
    {
        parent::__construct('Could not found parent');
    }
}
