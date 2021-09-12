<?php



/**
 * Default view class for handling DetailViews
 *
 * @package MVC
 * @category Views
 */
class ViewDetail extends DotbView
{
    /**
     * @see DotbView::$type
     */
    public $type = 'detail';

    /**
     * @var DetailView2 object
     */
    public $dv;

    /**
     * @see DotbView::preDisplay()
     */
    public function preDisplay()
    {
 	    $metadataFile = $this->getMetaDataFile();
 	    $this->dv = new DetailView2();
 	    $this->dv->ss = $this->ss;
 	    $this->dv->setup($this->module, $this->bean, $metadataFile, DotbAutoLoader::existingCustomOne('include/DetailView/DetailView.tpl'));
    }

    /**
     * @see DotbView::display()
     */
    public function display()
    {
        if(empty($this->bean->id)){
            dotb_die($GLOBALS['app_strings']['ERROR_NO_RECORD']);
        }
        $this->dv->process();
        echo $this->dv->display();
    }
}
