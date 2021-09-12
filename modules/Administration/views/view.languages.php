<?php

/*********************************************************************************

 * Description:  TODO: To be written.
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/

require_once 'include/DotbObjects/LanguageManager.php';
class ViewLanguages extends DotbView
{
    /**
	 * @see DotbView::_getModuleTitleParams()
	 */
	protected function _getModuleTitleParams($browserTitle = false)
	{
	    global $mod_strings;

    	return array(
    	   "<a href='index.php?module=Administration&action=index'>".$mod_strings['LBL_MODULE_NAME']."</a>",
    	   $mod_strings['LBL_MANAGE_LANGUAGES']
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
        
        $languages = LanguageManager::getEnabledAndDisabledLanguages();

        $this->ss->assign('APP', $GLOBALS['app_strings']);
        $this->ss->assign('MOD', $GLOBALS['mod_strings']);
        $this->ss->assign('enabled_langs', json_encode($languages['enabled']));
        $this->ss->assign('disabled_langs', json_encode($languages['disabled']));
        $this->ss->assign('title',$this->getModuleTitle(false));

        echo $this->ss->fetch('modules/Administration/templates/Languages.tpl');
    }
}
