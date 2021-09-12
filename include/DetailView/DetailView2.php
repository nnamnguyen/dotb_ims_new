<?php



require_once('include/EditView/EditView2.php');

/**
 * DetailView - display single record
 * New implementation
 * @api
 */
class DetailView2 extends EditView
{
    var $view = 'DetailView';

    /**
     * DetailView constructor
     * This is the DetailView constructor responsible for processing the new
     * Meta-Data framework
     *
     * @param $module String value of module this detail view is for
     * @param $focus An empty dotbbean object of module
     * @param $id The record id to retrieve and populate data for
     * @param $metadataFile String value of file location to use in overriding default metadata file
     * @param tpl String value of file location to use in overriding default Smarty template
     */
    function setup(
        $module,
        $focus = null,
        $metadataFile = null,
        $tpl = 'include/DetailView/DetailView.tpl',
        $createFocus = true
        )
    {
        $this->th = new TemplateHandler();
        $this->th->ss = $this->ss;
        $this->focus = $focus;
        $this->tpl = $tpl;
        $this->module = $module;
        $this->metadataFile = $metadataFile;
        if(isset($GLOBALS['dotb_config']['disable_vcr'])) {
           $this->showVCRControl = !$GLOBALS['dotb_config']['disable_vcr'];
        }

        if (!empty($this->metadataFile) && file_exists($this->metadataFile)) {
        	include($this->metadataFile);
        }

        $this->defs = $viewdefs[$this->module][$this->view];
    }

}
?>
