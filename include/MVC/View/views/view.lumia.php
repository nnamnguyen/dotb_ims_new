<?php




class ViewLumia extends LumiaView
{
    /**
     * Constructor
     *
     * @see LumiaView::LumiaView()
     */
 	public function __construct($bean = null, $view_object_map = array())
 	{
        $this->options['show_title'] = false;
        $this->options['show_header'] = false;
        $this->options['show_footer'] = false;
        $this->options['show_javascript'] = false;
        $this->options['show_subpanels'] = false;
        $this->options['show_search'] = false;
 		parent::__construct($bean = null, $view_object_map = array());
 	}

}
