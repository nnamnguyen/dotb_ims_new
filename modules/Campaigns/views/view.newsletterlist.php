<?php

/*********************************************************************************
 ********************************************************************************/


class ViewNewsLetterList extends ViewList 
{    
    function processSearchForm()
    {
        // we have a query
        if(!empty($_SERVER['HTTP_REFERER']) && preg_match('/action=EditView/', $_SERVER['HTTP_REFERER'])) { // from EditView cancel
            $this->searchForm->populateFromArray($this->storeQuery->query);
        }
        else {
            $this->searchForm->populateFromRequest();
        }   
        $where_clauses = $this->searchForm->generateSearchWhere(true, $this->seed->module_dir);
        $where_clauses[] = "campaigns.campaign_type in ('NewsLetter')";
        if (count($where_clauses) > 0 )$this->where = '('. implode(' ) AND ( ', $where_clauses) . ')';
        $GLOBALS['log']->info("List View Where Clause: $this->where");


        echo $this->searchForm->display($this->headers);
    }
    
    /**
	 * @see DotbView::preDisplay()
	 */
	public function preDisplay() 
	{
        global $mod_strings;
        $mod_strings['LBL_MODULE_TITLE'] = $mod_strings['LBL_NEWSLETTER_TITLE'];
        $mod_strings['LBL_LIST_FORM_TITLE'] = $mod_strings['LBL_NEWSLETTER_LIST_FORM_TITLE'];
        parent::preDisplay();

    }        

    /**
     * @see DotbView::_getModuleTitleParams()
     */
    protected function _getModuleTitleParams($browserTitle = false)
    {
        global $mod_strings;
        $params = parent::_getModuleTitleParams($browserTitle);
        $params[] = $mod_strings['LBL_NEWSLETTER_TITLE'];        
        return $params;
    }
}
