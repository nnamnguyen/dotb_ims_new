<?php
include_once('modules/Configurator/Configurator.php');
require_once('modules/C_SMS/SMS/sms.php');
include_once('dotb_version.php');
require_once("modules/Administration/smsPhone/sms_enzyme.php");
require_once("custom/include/utils/parseTemplate.php");
class SMSApi extends DotbApi {
    function registerApiRest() {
        return array(
            'open-popup-send-sms' => array(
                'reqType' => 'GET',
                'path' => array('open-popup-send-sms'),
                'pathVars' => array(''),
                'method' => 'openPopup',
                'shortHelp' => '',
                'longHelp' => ''
            ),

            'send-sms' => array(
                'reqType' => 'PUT',
                'path' => array('send-sms'),
                'pathVars' => array(''),
                'method' => 'sendSMS',
                'shortHelp' => '',
                'longHelp' => '',
            ),
            'sms-template' => array(
                'reqType' => 'GET',
                'path' => array('sms-template'),
                'pathVars' => array(''),
                'method' => 'template',
                'shortHelp' => '',
                'longHelp' => '',
            ),

            'test' => array(
                'reqType' => 'POST',
                'path' => array('test'),
                'pathVars' => array(''),
                'method' => 'test',
                'shortHelp' => '',
                'longHelp' => '',
            ),
        );
    }

    function sendSMS(ServiceBase $api, array $args) {

        if (isset($args) && !empty($args)) {
            $sms = new sms();
            if ($args["send_to_multi"]) {
                #multiple recipient
                $sms->parent_type = $args['ptype'];
                $mod_key_sing = $GLOBALS["beanList"][$args['ptype']];
                $object_name = $mod_key_sing == 'aCase' ? 'Case' : $mod_key_sing;
                $mod_bean_files = $GLOBALS["beanFiles"][$mod_key_sing];
                # retrieve configured SMS phone field for the active module
                require_once("modules/Administration/smsPhone/sms_enzyme.php");
                $e = new sms_enzyme($args['ptype']);
                $sms_field = $e->get_custom_phone_field();
                $summary = array();
                $pids = explode(",", $args['pid']);
                if (sizeof($pids) && $sms_field != NULL) {
                    require_once($mod_bean_files);
                    $number = array();
                    $recipient = array();
                    $i = 0;
                    foreach ($pids as $pid) {
                        $parent = new $object_name;
                        if ($parent->retrieve($pid)) {
                            $fone = preg_replace('/[^0-9]/', '', $parent->$sms_field);
                            $number[$i] = array($parent->name, $fone, $pid);
                            $recipient[$pid]['name'] = $parent->name;
                            $i++;
                        }
                    }
                    if (!empty($number)) {
                        $summary = $sms->send_batch_message($number, $args["sms_msg"], $args['ptype'], $args['template_id'], $args['date_in_content']);
                    }

                    $result = "<h1>SUMMARY:</h1>";
                    if (is_array($summary)) {
                        $result .= "<table width='100%' border='0' cellpadding='2'>";
                        foreach ($summary as $detail) {
                            $result .= "<tr><td valign='top'>" . $detail[0] . "</td>";
                            if ($detail[1] === 'Failed') {
                                $color = 'red';
                            } else {
                                $color = 'green';
                            }
                            $result .= "<td valign='top'><strong style='color:{$color}'>{$detail[1]}</strong></td></tr>";
                        }
                        $result .= "</table>";
                    } else {
                        $result .= $summary;
                    }
                    $result .= "<div style='margin-top:15px;'>Press <strong style='color:red;'>ESC</strong> key or click the gray area to close this message.</div>";
                    return $result;
                }

            } else {
                # single recipient
                $status = '';
                $result = (int)$sms->send_message($args["num"], $args["sms_msg"], $args['ptype'], $args['pid'], $GLOBALS['current_user']->id, $args['template_id'], $args['date_in_content'], $args['team_id']);
                $status = '<Strong style="color:green">Received</Strong>';
                if ($result <= 0) {
                    $status = '<Strong style="color:red;">Failed</Strong>';
                }
                return 'Send to ' . $args["num"] . ' ' . $status . "<div style='margin-top:15px;'>Press <strong style='color:red;'>ESC</strong> key or click the gray area to close this message.</div>";
            }

        } else {
            return "Message sending failed. The data you submitted is empty.";
        }


    }

    function openPopup(ServiceBase $api, array $args) {
        $mod_key_sing = $GLOBALS["beanList"][$args['ptype']];
        $mod_bean_files = $GLOBALS["beanFiles"][$mod_key_sing];

        # retrieve configured SMS phone field for the active module
        require_once("modules/Administration/smsPhone/sms_enzyme.php");
        $e = new sms_enzyme($args['ptype']);
        $sms_field = $e->get_custom_phone_field();

        $msg = "";
        $pid = $args['pid'];
        $pids = explode(",", $pid);
        $ptype = $args['ptype'];
        $template = $args["template"] != "" ? $args["template"] : $args["ptype"];
        $phone_number = $args['num'];
        $onclick = "send_sms();";
        $send_to_multi = $args['num'] == 'multi' ? '1' : '0';
        $result = '';
        include_once("modules/Administration/smsPhone/sms_editor.php");
        return $result;
    }

    function template(ServiceBase $api, array $args){
        if(isset($_GET['id']))
            return array(
                'success' =>'1',
                'content' => parse_template_SMS($_GET['id'], $_GET['mod'], $_GET['rec']),
            );
        else
        return array(
                'success' =>'0'
            );
    }

    function test(ServiceBase $api, array $args){
        require_once 'custom\clients\mobile\helper\NotificationHelper.php';
        pushNotification();
    }
}