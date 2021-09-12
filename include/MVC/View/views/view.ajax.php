<?php




class ViewAjax extends DotbView
{
    /**
     * Constructor
     *
     * @see DotbView::__construct()
     */
    public function __construct()
 	{
 		$this->options['show_title'] = false;
		$this->options['show_header'] = false;
		$this->options['show_footer'] = false; 	  
		$this->options['show_javascript'] = false; 
		$this->options['show_subpanels'] = false; 
		$this->options['show_search'] = false; 
		
        parent::__construct();
 	}
}
