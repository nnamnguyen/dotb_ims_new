<?php

/*********************************************************************************

 * Description: view handler for error page of the import process
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 ********************************************************************************/


class ImportViewError extends DotbView 
{	
    /**
     * @see DotbView::getMenu()
     */
    public function getMenu($module = null, $mod_strings_override = false)
    {
        global $mod_strings, $current_language;
        
        if ( empty($module) )
            $module = $_REQUEST['import_module'];
        
        $old_mod_strings = $mod_strings;
        $mod_strings = return_module_language($current_language, $module);
        $returnMenu = parent::getMenu($module, $mod_strings_override);
        $mod_strings = $old_mod_strings;
        
        return $returnMenu;
    }
    
 	/**
     * @see DotbView::_getModuleTab()
     */
 	protected function _getModuleTab()
    {
        global $app_list_strings, $moduleTabMap;
        
 		// Need to figure out what tab this module belongs to, most modules have their own tabs, but there are exceptions.
        if ( !empty($_REQUEST['module_tab']) )
            return $_REQUEST['module_tab'];
        elseif ( isset($moduleTabMap[$_REQUEST['import_module']]) )
            return $moduleTabMap[$_REQUEST['import_module']];
        // Default anonymous pages to be under Home
        elseif ( !isset($app_list_strings['moduleList'][$_REQUEST['import_module']]) )
            return 'Home';
        else
            return $_REQUEST['import_module'];
 	}
 	
 	/** 
     * @see DotbView::display()
     */
 	public function display()
    {
        $this->ss->assign("IMPORT_MODULE", $this->request->getValidInputRequest('import_module', 'Assert\Mvc\ModuleName', ''));
        $this->ss->assign("ACTION", 'Step1');
        $this->ss->assign("MESSAGE", $this->request->getValidInputRequest('message', null, ''));
        $this->ss->assign("SOURCE","");
        if ( isset($_REQUEST['source']) )
        $this->ss->assign("SOURCE", $this->request->getValidInputRequest('source', array('Assert\Choice' => array('choices' => self::getImportSourceOptions())), ''));
        
        $this->ss->display('modules/Import/tpls/error.tpl');
    }
}
