<?php





class DotbWidgetSubPanelEditRoleButton extends DotbWidgetField
{
    public function displayHeaderCell($layout_def)
	{
		return '&nbsp;';
	}

    public function displayList($layout_def)
	{
		global $app_strings;
        global $subpanel_item_count;
        $unique_id = $layout_def['subpanel_id']."_edit_".$subpanel_item_count; //bug 51512
	
		$href = 'index.php?module=' . $layout_def['module']
			. '&action=' . 'ContactOpportunityRelationshipEdit'
			. '&record=' . $layout_def['fields']['OPPORTUNITY_ROLE_ID']
			. '&return_module=' . $_REQUEST['module']
			. '&return_action=' . 'DetailView'
			. '&return_id=' . $_REQUEST['record'];
			
	//based on listview since that lets you select records
	if($layout_def['ListView']){
		return '<a href="' . $href . '"'
            . "id=\"$unique_id\""
			. 'class="listViewTdToolsS1">' . $app_strings['LNK_EDIT'] .'</a>&nbsp;';
	}else{
		return '';
	}
	}
}
