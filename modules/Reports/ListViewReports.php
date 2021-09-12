<?php

/*********************************************************************************
 * Description:  TODO To be written.
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/


class ListViewReports extends ListViewSmarty {
    var $displayEndTpl;

    public function display($end = true)
    {
        global $current_user, $app_strings, $mod_strings;
		$admin = is_admin($current_user) || is_admin_for_module($current_user,'Reports');
        foreach($this->data['data'] as $i => $rowData) {
            if(isset($this->data['data'][$i]['IS_PUBLISHED'])) {
                $this->data['data'][$i]['IS_PUBLISHED'] = "<input type='checkbox' ";
                if($rowData['IS_PUBLISHED'] == 'yes') {
                     $this->data['data'][$i]['IS_PUBLISHED'] .= ' checked '; 
                }
                if($admin) {
                    $this->data['data'][$i]['IS_PUBLISHED'] .= " onclick='location.href=\"index.php?module=Reports&action=index&publish=no&publish_report_id={$rowData['ID']}\";'>";
                }
                else {
                    $this->data['data'][$i]['IS_PUBLISHED'] .= ' disabled=true>';
                }
            }
            if(isset($this->data['data'][$i]['IS_SCHEDULED'])) {
                $this->data['data'][$i]['IS_SCHEDULED'] = "<a href='#' onclick=\"schedulePOPUP('{$rowData['ID']}'); return false\" class='listViewTdToolsS1'>{$rowData['IS_SCHEDULED_IMG']} {$rowData['IS_SCHEDULED']}</a>";
            }

            if(!isset($this->data['data'][$i]['IS_EDIT'])) {
            	if ($this->data['data'][$i]['ASSIGNED_USER_ID'] != $current_user->id || !ACLController::checkAccess('Reports', 'edit', $this->data['data'][$i]['ASSIGNED_USER_ID'])) {
            		$this->data['data'][$i]['IS_EDIT'] = "&nbsp;";
            	} else {
                	$this->data['data'][$i]['IS_EDIT'] = "<a title=\"{$app_strings['LBL_EDIT_BUTTON']}\" href=\"index.php?action=ReportsWizard&module=Reports&page=report&record={$rowData['ID']}\">".DotbThemeRegistry::current()->getImage("edit_inline", '', null, null, ".gif", $mod_strings['LBL_EDIT'])."</a>";
            	}
            }
        }

        $this->ss->assign('act', 'ReportsWizard');
        return parent::display($end);
    }
    
    function displayEnd() {
        $smarty = new Dotb_Smarty();
        return $smarty->fetch($this->displayEndTpl);
    }
}
