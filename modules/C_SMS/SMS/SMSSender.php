<?php
//require_once('nusoap/nusoap.php');
require_once("modules/C_SMS/SMS/SMS_Provider.php");
class SMSSender{
    /**
    * Function send a sms to target
    *
    * @param mixed $phone_number
    * @param mixed $content content of  sms
    * @return mixed
    */

    function sendSMS($phone_number = '', $content = '', $parent_type = 'Users',$parent_id = '1', $team_id = '', $template_id = ''){
        global $current_user, $dotb_config;
        if (empty($team_id))
            $team_id = $current_user->team_id;

        $team = BeanFactory::getBean('Teams', $team_id);

        $sms_config = array();
        $sms_config = json_decode(html_entity_decode($team->sms_config),true);
        if (empty($team->sms_config)) return  0;
        if (empty($phone_number)) return 0;
        //Khóa chức năng gửi SMS
        //if(!$dotb_config['sendSMS']) return 0;

        $phone_number = parseSMSPhoneNumber($phone_number);
        $supplier     = getSMSSupplier($phone_number);
        //Generate template to content

        $content    = parse_template_SMS($template_id, $parent_type, $parent_id, $content);

        $content        = viToEn($content);
        //Replace "test" to "t est" with Viettel
        if($supplier == 'viettel'){
            $content = str_replace("test", 't_est', $content);
            $content = str_replace("Test", 'T_est', $content);
            $content = str_replace("TEST", 'T_EST', $content);
        }
        $content = str_replace("giam doc", 'GD', $content);
        $content = str_replace("Giam doc", 'GD', $content);
        $content = str_replace("giam", 'giam_', $content);
        $content = str_replace("Giam", 'Giam_', $content);
        $content = str_replace("tang", 'tang_', $content);
        $content = str_replace("Tang", 'Tang_', $content);

        $ws_server      = $sms_config['sms_ws_link'];
        $ws_pass        = $sms_config['sms_ws_pass'];
        $ws_account     = $sms_config['sms_ws_account'];
        $ws_brandname   = $sms_config['sms_ws_brandname'];
        $ws_supplier    = $sms_config['sms_ws_supplier'];

        $ws_server 		= $sms_config['sms_ws_link'];
        $ws_pass 		= $sms_config['sms_ws_pass'];
        $ws_account 	= $sms_config['sms_ws_account'];
        $ws_brandname   = $sms_config['sms_ws_brandname'];
        $ws_supplier    = $sms_config['sms_ws_supplier'];
        $ws_groupid 	= $sms_config['sms_ws_groupid'];

        //Fix loi khong gui duoc SMS
        $SMS_Provider   = new SMS_Provider($ws_server,$ws_account,$ws_pass);
        $result         = $SMS_Provider->send_sms($phone_number,$content,$ws_brandname,$ws_supplier,$ws_groupid);

        return $result;
    }
}

?>
