<?php



require_once('include/EditView/EditView2.php');
class ViewEdit extends DotbView
{
 	var $ev;
 	var $type ='edit';
 	var $useForSubpanel = false;  //boolean variable to determine whether view can be used for subpanel creates
 	var $useModuleQuickCreateTemplate = false; //boolean variable to determine whether or not SubpanelQuickCreate has a separate display function
 	var $showTitle = true;

    /**
     * @see DotbView::preDisplay()
     */
    public function preDisplay()
    {
        $metadataFile = $this->getMetaDataFile();
        $this->ev = $this->getEditView();
        $this->ev->ss = $this->ss;
        $this->ev->setup($this->module, $this->bean, $metadataFile, DotbAutoLoader::existingCustomOne('include/EditView/EditView.tpl'));
    }

 	function display(){
		$this->ev->process();
		echo $this->ev->display($this->showTitle);
 	}

    /**
     * Get EditView object
     * @return EditView
     */
    protected function getEditView()
    {
        return new EditView();
    }
}

