<?php


//this widget is used only by the contracts module..


class DotbWidgetSubPanelGetLatestButton extends DotbWidgetField
{
    public function displayHeaderCell($layout_def)
	{
		return '&nbsp;';
	}

    public function displayList($layout_def)
	{
		//if the contract has been executed or selected_revision is same as latest revision
		//then hide the latest button. 		
		//if the contract state is executed or document is not a template hide this action.
		if ((!empty($layout_def['fields']['CONTRACT_STATUS']) && $layout_def['fields']['CONTRACT_STATUS']=='executed') or
			$layout_def['fields']['SELECTED_REVISION_ID']== $layout_def['fields']['LATEST_REVISION_ID']) {
			return "";
		}
		
		global $app_strings;
		

		$href = 'index.php?module=' . $layout_def['module']
			. '&action=' . 'GetLatestRevision'
			. '&record=' . $layout_def['fields']['ID']
			. '&return_module=' . $_REQUEST['module']
			. '&return_action=' . 'DetailView'
			. '&return_id=' . $_REQUEST['record']
			. '&get_latest_for_id=' . $layout_def['fields']['LINKED_ID'];

		$edit_icon_html = DotbThemeRegistry::current()->getImage( 'getLatestDocument','align="absmiddle" border="0"',null,null,'.gif',$app_strings['LNK_GET_LATEST']);
		if($layout_def['EditView']){
			return '<a href="' . $href . '"' . "title ='". $app_strings['LNK_GET_LATEST_TOOLTIP']  ."'"
			. 'class="listViewTdToolsS1">' . $edit_icon_html . '&nbsp;' . $app_strings['LNK_GET_LATEST'] .'</a>&nbsp;';
		}else{
			return '';
		}
	}
		
}
