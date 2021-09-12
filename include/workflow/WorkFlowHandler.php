<?php


use Dotbcrm\Dotbcrm\Security\Subject\Cli;

require_once('include/workflow/workflow_utils.php');

/**
 * Workflow manager class
 * @api
 */
class WorkFlowHandler {

    public function __construct(DotbBean $focus, $event)
    {
    	//Confirm we are not running populating seed data
    	if(isset($_SESSION['disable_workflow'])) return;

        //Now just include the modules workflow from this bean
    	global $triggeredWorkflows;
    	//Ensure that the array is set, but don't reset it if it is not empty.
    	if (empty($triggeredWorkflows))
    	{
    		$triggeredWorkflows = array();
    	}

    	if($event=="before_save") {
    		foreach(DotbAutoLoader::existing("custom/modules/".$focus->module_dir."/workflow/workflow.php") as $workflow_path) {
    			include_once($workflow_path);
    			$target_class = $focus->module_dir."_workflow";
    			$workflow_class = new $target_class();
                $workflow_class->process_wflow_triggers($focus);
    		}
    	}
    	//Reset the infinit loop check for workflows
    	$triggeredWorkflows = array();
    }


    /**
     * Process all of the workflow alerts in the session for this bean
     * @param focus - the bean to use in the alert
     * @param alerts - the alerts that were saved in the session
     *
     */
    function process_alerts(&$focus, $alerts){

    	//Confirm we are not running populating seed data
    	if(isset($_SESSION['disable_workflow'])) return;

        //Now just include the modules workflow from this bean
        foreach(DotbAutoLoader::existing("custom/modules/".$focus->module_dir."/workflow/workflow.php") as $workflow_path) {
            include_once($workflow_path);

            $target_class = $focus->module_dir."_workflow";
            $workflow_class = new $target_class();

            // Bug 45142 - dates need to be converted to DB format for
            // workflow alerts to work properly in Alerts then Actions
            // situations - rgonzalez
            $focus->fixUpFormatting();
            // End Bug 45142

            foreach(DotbAutoLoader::existing("custom/modules/".$focus->module_dir."/workflow/workflow_alerts.php") as $file) {
                include_once($file);
                foreach($alerts as $alert){
                    $alert_target_class = $focus->module_dir."_alerts";
                    if(class_exists($alert_target_class)){
                        $alert_class = new $alert_target_class();
                        $function_name = "process_wflow_".$alert;
                        $alert_class->$function_name($focus);
                    }
                }
            }
        }
    }
}
