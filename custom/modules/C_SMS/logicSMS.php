<?php
    class logicSMS {
        function before_save_SMS(&$bean, $event, $arguments){

            //Trường hợp chưa gửi SMS => Xử lý gửi
            if(empty($bean->delivery_status)){
                require_once("modules/C_SMS/SMS/SMSSender.php");
                require_once("modules/C_SMS/SMS/sms_interface.php");
                require_once("custom/include/utils/parseTemplate.php");

                $contact = BeanFactory::getBean($bean->parent_type, $bean->parent_id);
                if(!empty($contact->id) && !empty($bean->phone_number)){
                    //Sent
                    $result = SMSSender::sendSMS($bean->phone_number, $bean->description, $bean->parent_type, $bean->parent_id, $contact->team_id);
                    $return = (int)$result;
                    $status = 'RECEIVED';
                    if($return <= 0)
                        $status = 'FAILED';
                }

                $message = viToEn($bean->description);
                $bean->message_count  = countSms($message);
                $bean->delivery_status = $status;
                $bean->supplier       = getSMSSupplier($bean->phone_number);
                $bean->name           = 'Send to '.$contact->name.' - '.$bean->phone_number;
            }


            if($bean->parent_type == 'J_PTResult'){
                $rs1 = $GLOBALS['db']->query("SELECT DISTINCT
                    IFNULL(j_ptresult.id, '') primaryid,
                    IFNULL(j_ptresult.parent, '') parent_type,
                    IFNULL(l1.id, '') lead_id,
                    IFNULL(l2.id, '') student_id
                    FROM j_ptresult
                    LEFT JOIN
                    leads_j_ptresult_1_c l1_1 ON j_ptresult.id = l1_1.leads_j_ptresult_1j_ptresult_idb
                    AND l1_1.deleted = 0
                    LEFT JOIN
                    leads l1 ON l1.id = l1_1.leads_j_ptresult_1leads_ida
                    AND l1.deleted = 0
                    LEFT JOIN
                    contacts_j_ptresult_1_c l2_1 ON j_ptresult.id = l2_1.contacts_j_ptresult_1j_ptresult_idb
                    AND l2_1.deleted = 0
                    LEFT JOIN
                    contacts l2 ON l2.id = l2_1.contacts_j_ptresult_1contacts_ida
                    AND l2.deleted = 0
                    WHERE
                    j_ptresult.deleted = 0 AND j_ptresult.id = '{$bean->parent_id}'");
                $row1 = $GLOBALS['db']->fetchByAssoc($rs1);
                $bean->parent_type = $row1['parent_type'];

                if($bean->parent_type == 'Contacts')
                    $bean->parent_id = $row1['student_id'];
                elseif($bean->parent_type == 'Leads')
                    $bean->parent_id = $row1['lead_id'];
            }
        }

    }
?>
