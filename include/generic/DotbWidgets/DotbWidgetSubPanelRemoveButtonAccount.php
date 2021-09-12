<?php





class DotbWidgetSubPanelRemoveButtonAccount extends DotbWidgetSubPanelRemoveButton {
	/**
	 * 
	 * @see DotbWidgetSubPanelRemoveButton::displayList()
	 */
    public function displayList($layout_def)
    {
		if (!$layout_def['EditView']) {
			return false;
		}
		return parent::displayList($layout_def);
	}
}