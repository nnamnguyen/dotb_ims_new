<?php

/*********************************************************************************

 * Description:  TODO: To be written.
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/
 

class ViewImportvcard extends DotbView
{
    public $type = 'edit';
 	
	/**
     * @see DotbView::display()
     */
	public function display()
    {
        global $mod_strings, $app_strings;

        $this->ss->assign("ERROR_TEXT", $app_strings['LBL_EMPTY_VCARD']);
        if (isset($_REQUEST['error'])) {
            switch ($_REQUEST['error']) {
                case 'vcardErrorFilesize':
                    $error = 'LBL_VCARD_ERROR_FILESIZE';
                    break;
                case 'vcardErrorRequired':
                    $error = 'LBL_EMPTY_REQUIRED_VCARD';
                    break;
                default:
                    $error = 'LBL_VCARD_ERROR_DEFAULT';
                    break;
            }
            $this->ss->assign("ERROR", $app_strings[$error]);
        }
        $reqModule = $this->request->getValidInputRequest('module', 'Assert\Mvc\ModuleName');
        $this->ss->assign("HEADER", $app_strings['LBL_IMPORT_VCARD']);
        $this->ss->assign("MODULE", $reqModule);
        $params = array();
        $params[] = "<a href='index.php?module={$reqModule}&action=index'>{$mod_strings['LBL_MODULE_NAME']}</a>";
        $params[] = $app_strings['LBL_IMPORT_VCARD_BUTTON_LABEL'];
		echo getClassicModuleTitle($mod_strings['LBL_MODULE_NAME'], $params, true);
        $this->ss->display($this->getCustomFilePathIfExists('include/MVC/View/tpls/Importvcard.tpl'));
 	}
}
