<?php


class MeetingsController extends DotbController
{
    protected function action_editView()
    {
        $this->view = 'edit';
       
        $editAllRecurrences = isset($_REQUEST['edit_all_recurrences']) ? $_REQUEST['edit_all_recurrences'] : false;
        $this->view_object_map['repeatData'] = CalendarUtils::getRepeatData($this->bean, $editAllRecurrences);
        
        return true;
    }
    
    protected function action_editAllRecurrences()
    {
        if (!empty($this->bean->repeat_parent_id)) {
            $id = $this->bean->repeat_parent_id;
        } else {
            $id = $this->bean->id;
        }
        header("Location: index.php?module=Meetings&action=EditView&record={$id}&edit_all_recurrences=true");
    }
    
    protected function action_removeAllRecurrences()
    {
        if (!empty($this->bean->repeat_parent_id)) {
            $id = $this->bean->repeat_parent_id;
            $this->bean->retrieve($id);
        } else {
            $id = $this->bean->id;
        }
        
        if (!$this->bean->ACLAccess('Delete')) {
            ACLController::displayNoAccess(true);
            dotb_cleanup(true);
        }
        
        CalendarUtils::markRepeatDeleted($this->bean);
        $this->bean->mark_deleted($id);
        
        header("Location: index.php?module=Meetings");
    }
}
