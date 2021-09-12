<?php



class ProjectViewTemplatesEdit extends ViewEdit 
{
 	/**
	 * @see DotbView::_getModuleTitleParams()
	 */
	protected function _getModuleTitleParams($browserTitle = false)
	{
	    global $mod_strings;
	    
	    $crumbs = array();
	    $crumbs[] = $this->_getModuleTitleListParam($browserTitle);
	    if(!empty($this->bean->id)){
	    	$crumbs[] =  "<a href='index.php?module=Project&action=EditView&record={$this->bean->id}'>{$this->bean->name}</a>";
	    }
	    $crumbs[] = $mod_strings['LBL_PROJECT_TEMPLATE'];
    	return $crumbs;
    }
    
	function display() 
	{
        $this->bean->is_template = 1;
        $this->ev->ss->assign("is_template", 1);

 		parent::display();
 	}
}
