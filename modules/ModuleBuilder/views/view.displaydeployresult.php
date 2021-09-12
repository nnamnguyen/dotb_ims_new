<?php


class ViewDisplaydeployresult extends DotbView
{
    public function __construct()
    {
		$this->show_header = false;
		$this->show_title = false;
 		$this->show_subpanels = false;
 		$this->show_search = false;
 		$this->show_footer = true;
 		$this->show_javascript = true;
 		$this->view_print = false;
	}

	/**
	 * @see DotbView::_getModuleTitleParams()
	 */
	protected function _getModuleTitleParams($browserTitle = false)
	{
	    global $mod_strings;

    	return array(
    	   translate('LBL_MODULE_NAME','Administration'),
    	   ModuleBuilderController::getModuleTitle(),
    	   );
    }

	function display()
	{
		$message = $this->view_object_map['message'];
		echo $message.getVersionedScript('cache/javascript/dotbcrm3.min.js?')."<script type='text/javascript' language='Javascript'>YAHOO.util.Connect.asyncRequest('GET', 'index.php?module=Administration&action=RebuildRelationship&silent=true');</script>";
	}
}
