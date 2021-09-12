<?php



class WorkflowController extends DotbController
{
    public function preProcess()
    {
        global $current_user;
        
        $workflow_modules = get_workflow_admin_modules_for_user($current_user);
        if (!is_admin($current_user) && empty($workflow_modules))
            dotb_die("Unauthorized access to WorkFlow.");
    }
}
