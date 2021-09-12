<?php



// FIXME remove this view

class ViewAjaxUI extends DotbView
{
    /**
     * Constructor
     *
     * @see DotbView::__construct()
     */
 	public function __construct()
 	{
 		$this->options['show_title'] = true;
		$this->options['show_header'] = true;
		$this->options['show_footer'] = true;
		$this->options['show_javascript'] = true;
		$this->options['show_subpanels'] = false; 
		$this->options['show_search'] = false;
		
        parent::__construct();
 	}

    public function display()
 	{
 		$user = $GLOBALS["current_user"];
 		$etag = $user->id . $user->getETagSeed("mainMenuETag");
        $etag .= $GLOBALS['current_language'];
         //Include fts engine name in etag so we don't cache searchbar.
        $etag .= DotbSearchEngineFactory::getFTSEngineNameFromConfig();
        $etag = md5($etag);
 		generateEtagHeader($etag);
        //Prevent double footers
        $GLOBALS['app']->headerDisplayed = false;
 	}
}
