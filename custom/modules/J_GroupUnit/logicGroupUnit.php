<?php
class groupUnitLogicHook{
    function handleAfterSave($bean, $event, $arguments){
        if(!$arguments['isUpdate']) {
            $unit_bean = BeanFactory::newBean('J_Unit');
            $unit_bean->is_primary = true;
            $unit_bean->name = $bean->primary_unit;
            if ($unit_bean->load_relationship('group_unit_link'))
                $unit_bean->group_unit_id = $bean->id;
            $unit_bean->assigned_user_id = $GLOBALS['current_user']->id;
        }
        else{
            $sql = "SELECT id FROM j_unit WHERE deleted = 0 AND is_primary = 1 AND group_unit_id = '{$bean->id}'";
            $unit_id = $GLOBALS['db']->getOne($sql);
            $unit_bean = BeanFactory::getBean('J_Unit',$unit_id);
            $unit_bean->name = $bean->primary_unit;
        }

        $unit_bean->save();

    }

    function handleBeforeDelete($bean, $event, $arguments){
        $sql = "UPDATE j_unit SET deleted = 1, date_modified='{$GLOBALS['timedate']->nowDb()}',modified_user_id='{$GLOBALS['current_user']->id}' WHERE group_unit_id = '{$bean->id}'";
        $GLOBALS['db']->query($sql);
    }
}
?>
