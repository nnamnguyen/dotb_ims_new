<?php
    include_once("modules/C_SMS/SMS/SMSSender.php");
    require_once ("modules/C_SMS/SMS/sms_interface.php");
    require_once("custom/include/utils/parseTemplate.php");
    class sms implements sms_interface {
        //sending on izeno
        function send_message($to, $text, $parent_type, $parent_id, $user_id, $template_id = "", $date_in_content = "", $team_id = "") {
            $result = SMSSender::sendSMS($to, $text, $parent_type, $parent_id, $team_id, $template_id);
            $return = (int)$result;
            $status = 'RECEIVED';
            if($return <= 0)
                $status = 'FAILED';
            $this->createSMSRecord($to, $text, $status, $parent_type, $parent_id, $user_id, $template_id, $date_in_content,$team_id);
            return $return;
        }
        //sending on izeno
        private function send_to_multi($to_array, $text,$parent_type, $template_id = "", $date_in_content = "", $team_id = "") {
            $summary = array();
            for($i = 0; $i<count($to_array); $i++){
                $arrData    = $to_array[$i];
                $name       = $arrData[0];
                $phone      = $arrData[1];
                $module     = $parent_type;
                $parent_id  = $arrData[2];
                $phone      = preg_replace('/[^0-9]/', '', $phone);

                //Find student to save SMS record
                if ($parent_type == "J_StudentSituations"){
                    $studentSituation = BeanFactory::getBean("J_StudentSituations", $parent_id);
                    $student = BeanFactory::getBean("Contacts", $studentSituation->student_id);
                    $module = "Contacts";
                    $parent_id = $student->id;
                    $phone = $student->phone_mobile;
                }

                //Can not detect phone number
                if (empty($phone)){
                    $summary[$i] = array(0 => 'Send to '.$name.'<empty phone number>', 1 => 'Failed');
                    continue;
                }

                $result = SMSSender::sendSMS($phone,$text,$module,$parent_id,$team_id, $template_id);
                $return = (int)$result;

                if($return <= 0){
                    $status = 'FAILED';
                    $summary[$i] = array(0 => 'Send to '.$name.' - '.$phone, 1 => 'Failed');
                }else{
                    $status = 'RECEIVED';
                    $summary[$i] = array(0 => 'Send to '.$name.' - '.$phone, 1 => 'Received');
                }

                $this->createSMSRecord($phone, $text, $status, $module, $parent_id, $GLOBALS['current_user']->id, $template_id, $date_in_content, $team_id);
            }
            return $summary;
        }

        # need to create batch sending on izeno
        function send_batch_message($to_array,$text,$parent_type, $template_id = "", $date_in_content = "") {
            global $current_user;
            $summary = $this->send_to_multi($to_array, $text,$parent_type,$template_id,$date_in_content);
            return $summary;

        }



        function createSMSRecord($phone_number, $message, $status, $parent_type, $parent_id, $user_id, $template_id = "", $date_in_content = "", $team_id = ""){
            global $app_list_strings, $timedate;
            $receiver = BeanFactory::getBean($parent_type,$parent_id);
            //Generate template to content

            if(empty($team_id))
                $team_id = $GLOBALS['current_user']->team_id;
            $supplier     = getSMSSupplier($phone_number);

            $message      = parse_template_SMS($template_id, $parent_type, $parent_id, $message);
            $message      = viToEn($message);

            $c_sms 						= new C_SMS();
            $c_sms->name 				= 'Send to '.$receiver->name.' - '.$phone_number;
            $c_sms->description 		= $message;
            $c_sms->parent_type 		= $parent_type;
            $c_sms->parent_id 			= $parent_id;
            $c_sms->phone_number        = $phone_number;
            $c_sms->supplier     		= $supplier;
            $c_sms->delivery_status     = $status;

            $c_sms->message_count       = countSms($message);
            //$c_sms->template_id         = $template_id;
            $c_sms->date_in_content 	= (!empty($date_in_content)) ? $date_in_content : $timedate->nowDate();
            $c_sms->assigned_user_id 	= $user_id;
            $c_sms->team_id 			= $team_id;
            $c_sms->team_set_id 		= $c_sms->team_id;
            $c_sms->save();
        }
    }
?>
