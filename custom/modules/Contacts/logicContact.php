<?php
if (!defined('dotbEntry') || !dotbEntry) die('Not A Valid Entry Point');

class logicContact
{
    public function generateContact(&$bean, $event, $arguments)
    {
        $arrayUrl = explode('/', $_REQUEST['__dotb_url']);
        $action = $arrayUrl[sizeof($arrayUrl) - 1];
        $module = $arrayUrl[sizeof($arrayUrl) - 2];
        if (empty($_REQUEST['relate_id']) && !$arguments['isUpdate'] && $action != 'MassUpdate') {
            // check email and phone
            $check_dup = $GLOBALS['db']->getOne("SELECT id as count FROM leads WHERE phone_mobile = '{$bean->phone_mobile}' AND deleted ='0'");
            if($check_dup){
                $lead = BeanFactory::getBean('Leads',$check_dup,array('disable_row_level_security' => true));
                $lead->converted = 1;
                $lead->status = 'Converted';
                $lead->contact_id = $bean->id;
                $lead->save();
            }
            else{
                $lead = new Lead();
                foreach ($lead->field_defs as $keyField => $aFieldName)
                    $lead->$keyField = $bean->$keyField;

                $lead->id = '';
                $lead->j_school_prospects_1_name = $bean->j_school_leads_1_name;
                $lead->j_school_prospects_1 = $bean->j_school_leads_1;
                $lead->j_school_prospects_1j_school_ida = $bean->j_school_leads_1j_school_ida;
                $lead->converted = 1;
                $lead->status = 'Converted';
                $lead->team_set_id = $lead->team_id;
                $lead->contact_id = $bean->id;
                $lead->save();
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
}
