<?php



class ViewDownloadplugin extends ViewAjax
{
    /**
     * @see DotbView::display()
     */
    public function display()
    {
		$sp = new DotbPlugins();
		$sp->downloadPlugin($_REQUEST['plugin']);	
    }
}
