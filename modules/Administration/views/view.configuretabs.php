<?php

/*********************************************************************************

 * Description:  TODO: To be written.
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/

require_once('modules/Administration/Forms.php');

class ViewConfiguretabs extends DotbView
{
    /**
	 * @see DotbView::_getModuleTitleParams()
	 */
	protected function _getModuleTitleParams($browserTitle = false)
	{
	    global $mod_strings;
	    
    	return array(
    	   "<a href='index.php?module=Administration&action=index'>".$mod_strings['LBL_MODULE_NAME']."</a>",
    	   $mod_strings['LBL_CONFIG_TABS']
    	   );
    }
    
    /**
	 * @see DotbView::preDisplay()
	 */
	public function preDisplay()
	{
	    global $current_user;
        
	    if (!is_admin($current_user)) {
	        dotb_die("Unauthorized access to administration.");
        }
	}
    
    /**
	 * @see DotbView::display()
	 */
	public function display()
	{
        global $mod_strings;
        global $app_list_strings;
        global $app_strings;
        
        $controller = new TabController();
        $tabs = $controller->get_tabs_system();
        // Remove Home module from UI.  We add it back to front of display tab list on save.
        if (isset($tabs[0]['Home'])) {
            unset($tabs[0]['Home']);
        }
        if (isset($tabs[1]['Home'])) {
            unset($tabs[1]['Home']);
        }
        $enabled= array();
        foreach ($tabs[0] as $key=>$value)
        {
            $enabled[] = array("module" => $key, 'label' => translate($key));
        }
        $disabled = array();
        foreach ($tabs[1] as $key=>$value)
        {
            $disabled[] = array("module" => $key, 'label' => translate($key));
        }
        
        $user_can_edit = $controller->get_users_can_edit();
        $this->ss->assign('APP', $GLOBALS['app_strings']);
        $this->ss->assign('MOD', $GLOBALS['mod_strings']);
        $this->ss->assign('user_can_edit',  $user_can_edit);
        $this->ss->assign('enabled_tabs', json_encode($enabled));
        $this->ss->assign('disabled_tabs', json_encode($disabled));
        $this->ss->assign('title',$this->getModuleTitle(false));
        
        //get list of all subpanels and panels to hide 
        $mod_list_strings_key_to_lower = array_change_key_case($app_list_strings['moduleList']);
        $panels_arr = SubPanelDefinitions::get_all_subpanels();
        $hidpanels_arr = SubPanelDefinitions::get_hidden_subpanels();
        
        if(!$hidpanels_arr || !is_array($hidpanels_arr)) $hidpanels_arr = array();
        
        //create array of subpanels to show, used to create Drag and Drop widget
        $enabled = array();
        foreach ($panels_arr as $key) {
            if(empty($key)) continue;
            $key = strtolower($key);
            $enabled[] =  array("module" => $key, "label" => $mod_list_strings_key_to_lower[$key]);
        }
        
        //now create array of subpanels to hide for use in Drag and Drop widget
        $disabled = array();
        foreach ($hidpanels_arr as $key) {
            if (empty($key)) continue;
            $key = strtolower($key);
            // we need this here for with RLI's are disabled as they shouldn't be seen in the list
            if ($key == 'revenuelineitems' && in_array('RevenueLineItems', $GLOBALS['modInvisList'])) {
                continue;
            }
            $disabled[] =  array("module" => $key, "label" => $mod_list_strings_key_to_lower[$key]);
        }
        
        $this->ss->assign('enabled_panels', json_encode($enabled));
        $this->ss->assign('disabled_panels', json_encode($disabled));
        
        echo $this->ss->fetch('modules/Administration/templates/ConfigureTabs.tpl');	
    }
}
