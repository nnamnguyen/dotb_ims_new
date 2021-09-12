<?php



class UsersViewList extends ViewList
{
    public function preDisplay()
    {
        //bug #46690: Developer Access to Users/Teams/Roles
        if (!$GLOBALS['current_user']->isAdminForModule('Users') && !$GLOBALS['current_user']->isDeveloperForModule('Users'))
        {
            //instead of just dying here with unauthorized access will send the user back to his/her settings
            DotbApplication::redirect('index.php?module=Users&action=DetailView&record=' . $GLOBALS['current_user']->id);
        }
        $this->lv = new ListViewSmarty();
        $this->lv->delete = false;
        $this->lv->email = false;
    }

 	public function listViewProcess()
 	{
 		$this->processSearchForm();
		$this->lv->searchColumns = $this->searchForm->searchColumns;

		if(!$this->headers)
			return;
		if(empty($_REQUEST['search_form_only']) || $_REQUEST['search_form_only'] == false){
			$this->lv->ss->assign("SEARCH",true);
			if(!empty($this->where)){
					$this->where .= " AND";
			}
                        $this->where .= " (users.status !='Reserved' or users.status is null) ";
			$this->lv->setup($this->seed, 'include/ListView/ListViewGeneric.tpl', $this->where, $this->params);
			$savedSearchName = empty($_REQUEST['saved_search_select_name']) ? '' : (' - ' . $_REQUEST['saved_search_select_name']);
			echo $this->lv->display();
		}
 	}
}
