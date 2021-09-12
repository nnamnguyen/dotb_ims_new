<?php

/*********************************************************************************
 * Description:  TODO: To be written.
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/

class ViewRepair extends DotbView
{
    /**
     * @see DotbView::display()
     */
    public function display()
    {
        global $current_user;
        if ($current_user->id != '1') die('Repair is not defined for you!');
        // To prevent lag in the rendering of the page after clicking the quick repair link...
        echo "<h2>{$GLOBALS['mod_strings']['LBL_BEGIN_QUICK_REPAIR_AND_REBUILD']}</h2>";
        ob_flush();
        $randc = new RepairAndClear();
        $actions = array();
        $actions[] = 'clearAll';
        $randc->repairAndClearAll($actions, array(translate('LBL_ALL_MODULES')), false, true, '');

        echo <<<EOHTML
<br /><br /><a href="index.php?module=Administration&action=index">{$GLOBALS['mod_strings']['LBL_DIAGNOSTIC_DELETE_RETURN']}</a>
EOHTML;
    }
}
