<?php

/*********************************************************************************
 * $Id: view.detail.php 
 * Description: This file is used to override the default Meta-data EditView behavior
 * to provide customization specific to the Calls module.
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/

class ProjectViewList extends ViewList{
 	/*
 	 * Override listViewProcess with addition to where clause to exclude project templates
 	 */
    function listViewProcess()
    {
        $this->processSearchForm();
                

        // RETRIEVE PROJECTS NOT SET AS PROJECT TEMPLATES
        if ($this->where != "")
        {
            $this->where .= ' and ' . $this->seed->table_name . '.is_template = 0 ';
        }
        else
        {
            $this->where .= $this->seed->table_name . '.is_template = 0 ';
        }
        
        $this->lv->searchColumns = $this->searchForm->searchColumns;
        
        if(!$this->headers)
            return;
            
        if(empty($_REQUEST['search_form_only']) || $_REQUEST['search_form_only'] == false)
        {
            $this->lv->setup($this->seed, 'include/ListView/ListViewGeneric.tpl', $this->where, $this->params);
            $savedSearchName = empty($_REQUEST['saved_search_select_name']) ? '' : (' - ' . $_REQUEST['saved_search_select_name']);
            echo $this->lv->display();
        }
    }

}
