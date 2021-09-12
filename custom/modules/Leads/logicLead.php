<?php
if (!defined('dotbEntry') || !dotbEntry) die('Not A Valid Entry Point');

class logicLead
{
    public function generateTarget(&$bean, $event, $arguments)
    {
        $arrayUrl = explode('/', $_REQUEST['__dotb_url']);
        $action = $arrayUrl[sizeof($arrayUrl) - 1];
        $module = $arrayUrl[sizeof($arrayUrl) - 2];
        if (empty($_REQUEST['relate_id']) && !$arguments['isUpdate'] && $action != 'MassUpdate') {
            // check email and phone
            $check_dup = $GLOBALS['db']->getOne("SELECT id as count FROM prospects WHERE phone_mobile = '{$bean->phone_mobile}' AND deleted ='0'");
            if($check_dup){
                $prospect = BeanFactory::getBean('Prospects',$check_dup,array('disable_row_level_security' => true));
                $prospect->converted = 1;
                $prospect->status = 'Converted';
                $prospect->lead_id = $bean->id;
                $prospect->save();
            }
            else{
                $prospect = new Prospect();
                foreach ($prospect->field_defs as $keyField => $aFieldName)
                    $prospect->$keyField = $bean->$keyField;

                $prospect->id = '';
                $prospect->j_school_prospects_1_name = $bean->j_school_leads_1_name;
                $prospect->j_school_prospects_1 = $bean->j_school_leads_1;
                $prospect->j_school_prospects_1j_school_ida = $bean->j_school_leads_1j_school_ida;
                $prospect->converted = 1;
                $prospect->status = 'Transferred';
                $prospect->team_set_id = $prospect->team_id;
                $prospect->lead_id = $bean->id;
                $prospect->save();
            }
        }
        //Xu ly Import user_name
        if ($_POST['module'] == 'Import') {
            $user_id = $GLOBALS['db']->getOne("SELECT id FROM users WHERE user_name = '{$bean->assigned_user_name}' AND deleted = 0");
            if (!empty($user_id)){
                $bean->assigned_user_id = $user_id;
            }
        }
    }

    public function handleBeforeSave(&$bean, $event, $arguments){
        if(!isset($bean->fetched_row['id'])) {
            require_once("custom/clients/mobile/helper/NotificationHelper.php");
            //Push notification
            $notify = new NotificationMobile();
            $notify->pushNotification('Có Leads mới ' . trim(ucwords($bean->last_name, " ") . ' ' . ucwords($bean->first_name, " ")), 'Được tạo từ ' . $bean->lead_source, 'Leads', $bean->id, '', 'assign');
        }
    }
}
