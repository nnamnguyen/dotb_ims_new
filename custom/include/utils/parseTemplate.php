<?php
function parse_template_SMS($tpl_id = '', $module_dir = '', $focus_id = '', $content = ''){
    global $timedate;
    //Check 1
    if(empty($tpl_id) && empty($content))
        return '';

    if(!empty($tpl_id)){
        $qtemplate  = $GLOBALS['db']->query("SELECT name, body FROM email_templates WHERE id = '$tpl_id' AND deleted = 0");
        $template   = $GLOBALS['db']->fetchByAssoc($qtemplate);
        $body       = $template['body'];
    }
    if(!empty($content))
        $body       = $content;

    //Replace Team Code
    if(!empty($module_dir) && !empty($focus_id)){
        $focus = BeanFactory::getBean($module_dir, $focus_id);
        $qTeam = $GLOBALS['db']->query("SELECT short_name, name, sms_config FROM teams WHERE id = '{$focus->team_id}'");
        $team = $GLOBALS['db']->fetchByAssoc($qTeam);

        $sms_config = json_decode(html_entity_decode($team['sms_config']),true);

        $body = replaceSMS("\$team_code", $team['short_name'], $body, "{Trung tam}");
        $body = replaceSMS("\$team_name", $team['name'], $body, "{Trung tam}");

        //brand
        $brand = $GLOBALS['dotb_config']['brand_name'];
        if(empty($brand)) $brand = $sms_config['sms_ws_brandname'];

        $body = replaceSMS("\$brand_name", mb_strtoupper($brand), $body,"{Trung tam}");
        $body = replaceSMS("\$brand", mb_strtoupper($brand), $body,"{Trung tam}");


        //Replace name
        $body = str_replace("\$name", $focus->name, $body);
        $body = str_replace("\$student_name", $focus->last_name.' '.$focus->first_name, $body);
        $body = str_replace("\$full_name", $focus->last_name.' '.$focus->first_name, $body);

        $body = str_replace("\$first_name", $focus->first_name, $body);
        $body = str_replace("\$last_name", $focus->last_name, $body);

        $body = str_replace("\$class_name", $focus->name, $body);
        $body = str_replace("\$ten_lop", $focus->name, $body);

    }
    //Replace Tran trong, Cam on, Lien he
    $body = str_replace("\$tran_trong", 'Trân trọng,', $body);
    $body = str_replace("\$cam_on", 'Xin cảm ơn,', $body);
    $body = str_replace("\$thankyou", 'Xin cảm ơn,', $body);

    //Replace today
    $dateSplit = explode(" ",$timedate->now());
    $body = str_replace("\$hom_nay", $dateSplit[0], $body);
    $body = str_replace("\$today", $dateSplit[0], $body);

    return $body;
}

function replaceSMS($oldStr,$newStr,$content,$defaultStr = ""){
    $newStr = (!empty($newStr)) ? $newStr : $defaultStr;
    return str_replace($oldStr, $newStr, $content);
}
// Dem so luong ky tu trong SMS
function countSms($content){
    $maximum_messages = 3;
    $length = strlen($content);
    $per_message = 160;
    if($length > $per_message)
        $per_message = 153;
    $message = ceil($length/$per_message);
    return $message;
}
//Lay nha mang SMS
function getSMSSupplier($phone_number){
    $fixedPhoneNumber = preg_replace('/[^0-9]/', '', $phone_number);
    $fixedPhoneNumber = (substr($fixedPhoneNumber,0 , 1) == '0') ? substr_replace($fixedPhoneNumber,'84',0,1) : $fixedPhoneNumber;
    $phoneNumberPrefix = $app_list_strings['phone_number_prefix_options'];
    $supplier = "other";
    foreach ($phoneNumberPrefix as $key => $value) {
        if ((substr($fixedPhoneNumber,0 , 4) == $key) || (substr($fixedPhoneNumber,0 , 5) == $key)){
            $supplier = $value;
        }
    }
    return $supplier;
}
//Loc so dien thoai de gui tin nhan eg: 84...
function parsePhoneNumber($phone_number){
    $phone_number = preg_replace("/&#?[a-z0-9]+;/i", '', $phone_number);
    $phone_number = preg_replace('/[^0-9]/', '', $phone_number);
    $phone_number = preg_replace('/\s+/', '', $phone_number);
    if(substr($phone_number,0 , 1) != '0' && substr($phone_number,0 , 2) != '84') $phone_number = '0'.$phone_number;
    $phone_number = (substr($phone_number,0 , 1) == '0') ? substr_replace($phone_number,'84',0,1) : $phone_number;
    return $phone_number;
}
