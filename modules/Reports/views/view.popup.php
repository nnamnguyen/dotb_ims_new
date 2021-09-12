<?php

class ReportsViewPopup extends ViewPopup
{
	var $type ='list';

	function display()
	{
		global $popupMeta, $mod_strings;

        if(($this->bean instanceOf DotbBean) && !$this->bean->ACLAccess('list')){
            ACLController::displayNoAccess();
            dotb_cleanup(true);
        }

		if(isset($_REQUEST['metadata']) && strpos($_REQUEST['metadata'], "..") !== false) {
		    ACLController::displayNoAccess();
		    dotb_cleanup(true);
		}

		$popupMeta = DotbAutoLoader::loadPopupMeta($this->module, isset($_REQUEST['metadata'])?$_REQUEST['metadata']:null);

		$defs = $this->loadWithPopup('listviewdefs');
		if(is_array($defs)) {
		    $listViewDefs[$this->module] = $defs;
		} elseif(!empty($defs)) {
		    require $defs;
		}

		$defs = $this->loadWithPopup('searchdefs');
		if(is_array($defs)) {
			$searchdefs[$this->module]['layout']['advanced_search'] = $defs;
		} elseif(!empty($defs)) {
			require $defs;
		}

        if(!empty($this->bean) && isset($_REQUEST[$this->module.'2_'.strtoupper($this->bean->object_name).'_offset'])) {//if you click the pagination button, it will populate the search criteria here
            if(!empty($_REQUEST['current_query_by_page'])) {
                $current_query_by_page = $this->request->getValidInputRequest(
                    'current_query_by_page',
                    array('Assert\PhpSerialized' => array('base64Encoded' => true))
                );
                $blockVariables = array('mass', 'uid', 'massupdate', 'delete', 'merge', 'selectCount', 'lvso', 'sortOrder', 'orderBy', 'request_data', 'current_query_by_page');
                foreach($current_query_by_page as $search_key=>$search_value) {
                    if($search_key != $this->module.'2_'.strtoupper($this->bean->object_name).'_offset' && !in_array($search_key, $blockVariables)) {
						$_REQUEST[$search_key] = $GLOBALS['db']->quote($search_value);
                    }
                }
            }
        }

		foreach(DotbAutoLoader::existing('modules/' . $this->module . '/Popup_picker.php',
		    'include/Popups/Popup_picker.php') as $file) {
		    require_once $file;
		    break;
		}

		$popup = new Popup_Picker();
		$popup->_hide_clear_button = true;
		echo $popup->process_page();
	}
}
