<?php

class EmployeesController extends DotbController{
	function action_editview(){
		if(is_admin($GLOBALS['current_user']) || $_REQUEST['record'] == $GLOBALS['current_user']->id) 
			$this->view = 'edit';
		else
			dotb_die("Unauthorized access to employees.");
		return true;
	}
	
	protected function action_delete()
	{
	    if($_REQUEST['record'] != $GLOBALS['current_user']->id && $GLOBALS['current_user']->isAdminForModule('Users'))
        {
            $u = BeanFactory::getBean('Users', $_REQUEST['record']);
            $u->deleted = 1;
            $u->status = 'Inactive';
            $u->employee_status = 'Terminated';
            $u->save();
            $GLOBALS['log']->info("User id: {$GLOBALS['current_user']->id} deleted user record: {$_REQUEST['record']}");
            
            if( !empty($u->user_name) ) //If user redirect back to assignment screen.
                DotbApplication::redirect("index.php?module=Users&action=reassignUserRecords&record={$u->id}");
            else
                DotbApplication::redirect("index.php?module=Employees&action=index");
        }
        else 
            dotb_die("Unauthorized access to administration.");
	}
	
}
