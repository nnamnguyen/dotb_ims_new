<?php

class logicTask
{
    function handleAfterSave(&$bean, $event, $arguments)
    {
        global $db;
        if (!empty($bean->call_relate) && $bean->status == 'Completed') {
            $sql = "update calls set task_related_completed=1 where id='{$bean->call_relate}'";
            $db->query($sql);
        }
    }
}