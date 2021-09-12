<?php
if (!defined('dotbEntry') || !dotbEntry) die('Not A Valid Entry Point');
class logicHolidays{
    function handleRemoveRelationship(&$bean, $event, $arguments){
        if($arguments['related_module'] == 'C_Teachers' ){
            $GLOBALS['db']->query("DELETE FROM holidays WHERE id = '{$bean->id}'");
        }
    }
}
?>