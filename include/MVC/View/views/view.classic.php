<?php




class ViewClassic extends DotbView
{
    /**
     * @see DotbView::__construct()
 	 */
    public function __construct(
 	    $bean = null,
        $view_object_map = array()
        )
    {
        parent::__construct();
 		$this->type = $this->action;
 	}

 	/**
 	 * @see DotbView::display()
 	 */
    public function display()
    {
		if(($this->bean instanceof DotbBean) && isset($this->view_object_map['remap_action']) && !$this->bean->ACLAccess($this->view_object_map['remap_action']))
		{
		  ACLController::displayNoAccess(true);
		  return false;
		}
 		// Call DotbController::getActionFilename to handle case sensitive file names
 		$file = DotbController::getActionFilename($this->action);
 		$classic_file = DotbAutoLoader::existingCustomOne('modules/' . $this->module . '/'. $file . '.php');
 		if($classic_file) {
 		    $this->includeClassicFile($classic_file);
 		    return true;
 		}
		return false;
 	}
}
