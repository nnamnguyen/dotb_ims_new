<?php


require_once('modules/UpgradeWizard/DotbMerge/ListViewMerge.php');
/**
 * SubpanelMerge is a class for merging subpanel meta data together. This subpanel meta-data is a mix of the layouts seen in listviews and editviews
 *
 */

class SubpanelMerge extends ListViewMerge{
	protected $varName = 'subpanel_layout';
	protected $viewDefs = 'SubPanel';
	/**
	 * Loads the meta data of the original, new, and custom file into the variables originalData, newData, and customData respectively it then transforms them into a structure that EditView Merge would understand
	 * 
	 * @param STRING $module - name of the module's files that are to be merged
	 * @param STRING $original_file - path to the file that originally shipped with dotb
	 * @param STRING $new_file - path to the new file that is shipping with the patch 
	 * @param STRING $custom_file - path to the custom file
	 */
	protected function loadData($module, $original_file, $new_file, $custom_file){
		parent::loadData($module, $original_file, $new_file, $custom_file);
		$this->originalData = array($module=>array( $this->viewDefs=>array($this->panelName=>array('DEFAULT'=>$this->originalData[$module]['list_fields']))));
		$this->customData = array($module=>array( $this->viewDefs=>array($this->panelName=>array('DEFAULT'=>$this->customData[$module]['list_fields']))));
		$this->mergeData = $this->newData;
		$this->newData = array($module=>array( $this->viewDefs=>array($this->panelName=>array('DEFAULT'=>$this->newData[$module]['list_fields']))));
		
	}
	
	/**
	 * We take mergeData which is a copy of the new meta data prior to merging and set it's list_fields variable to the merged panels
	 *
	 */
	protected function setPanels(){
		$this->mergeData['list_fields'] = $this->buildPanels();
	}
	
	/**
	 * This will save the merged data to a file
	 *
	 * @param STRING $to - path of the file to save it to 
	 * @return BOOLEAN - success or failure of the save
	 */
	public function save($to){
		return write_array_to_file("$this->varName", $this->newData, $to);
	}
}

?>
