<?php


/**
 * This class contains logic hooks related to the Addoptify Customer Insight plugin for the leads module
 *
 * @author Emil Kilhage <emil.kilhage@addoptify.com>
 */
class LogicHook_Notification
{

    public function createNotification($bean, $event, $arguments)
    {

        if ((empty($bean->fetched_row)) || (!empty($bean->fetched_row) && $bean->fetched_row['assigned_user_id'] != $bean->assigned_user_id)) {
            //initialize notification bean
            $nt = BeanFactory::getBean("Notifications");
            $nt->name = $GLOBALS['app_list_strings']['parent_type_display'][$bean->module_name] . ": " . $bean->name . translate('LBL_ASSIGNED_INFO', 'Notifications');
            //assigned user should be record assigned user
            $nt->assigned_user_id = $bean->assigned_user_id;
            $nt->parent_id = $bean->id;
            $nt->parent_type = $bean->module_name;
            $nt->created_by = $bean->modified_user_id;
            $GLOBALS['db']->query("DELETE FROM notifications WHERE parent_id='{$bean->id}'");
            $nt->description = $bean->description;
            //set is_read to no
            $nt->is_read = 0;
            //set the level of severity
            $nt->severity = "information";
            $nt->save();
        }

    }

    public function deleteNotification($bean, $event, $arguments)
    {
        if (!empty($bean->id))
            $GLOBALS['db']->query("UPDATE notifications SET deleted = 1 WHERE parent_id='{$bean->id}' AND parent_type='{$bean->module_name}'");
    }

    public function updateNotification($bean, $event, $arguments)
    {
        if (!empty($bean->id))
            $GLOBALS['db']->query("UPDATE notifications SET is_read = 1 WHERE parent_type='{$bean->module_name}' and parent_id='{$bean->id}' AND deleted = 0 AND is_read = 0");

    }
}
