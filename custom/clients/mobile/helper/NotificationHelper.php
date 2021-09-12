<?php
    class NotificationMobile
    {

        public function pushNotification( $title = '', $body = '', $module_name = '', $module_id = '', $to = '', $type = '', $parent_name = '', $reminder_time = ''){//, $type = 'Student'
            //Send to all User in brand
            if(!empty($GLOBALS['dotb_config']['FCM_SERVER_KEY'])){

                $lang = "";
                    if(empty($to)){
                        $curToken[0] = '/topics/all';
                        $to_id = 'all';
                    }else{
                        $to_id = $to;
                        $rs2 = $GLOBALS['db']->query("SELECT portal_app_token, full_user_name, preferred_language FROM users WHERE id = '$to_id'");
                        $r2  = $GLOBALS['db']->fetchbyAssoc($rs2);
                        $curToken = json_decode(html_entity_decode($r2['portal_app_token']),true);
                        //Add title
                        $title .= " - ".$r2['full_user_name'];
                        $lang = $r2['preferred_language'];
                    }

                if($type == "assign"){
//                    $title = translate('LBL_NEW_FORM_TITLE', 'Notifications');
//                    $body = $GLOBALS['app_list_strings']['parent_type_display'][$module_name] . ": " . $parent_name . " " . translate('LBL_ASSIGNED_INFO', 'Notifications');
                }else {
                    if ($lang == "vn_vn") {
                        $title = $GLOBALS['app_strings']['LBL_REMINDERS'] . " " . $GLOBALS['app_list_strings']['parent_type_display'][$module_name];
                    }else{
                        $title = $GLOBALS['app_list_strings']['parent_type_display'][$module_name] . " " .  $GLOBALS['app_strings']['LBL_REMINDERS'];
                    }
                    $body = $GLOBALS['app_list_strings']['parent_type_display'][$module_name] . ": " . $parent_name . translate('LBL_REMINDER_INFO', 'Notifications') . ($reminder_time/60) . translate('LBL_MINUTES', 'Notifications');
                }

                if(!empty($title)){
                    if($type == 'assign') {
                        //Create new Notification
                        $notify = BeanFactory::getBean("Notifications");
                        $notify->id = create_guid();
                        $notify->new_with_id = true;
                        $notify->name = $title;
                        //assigned student id

                        $notify->assigned_user_id = $to_id;

                        if (empty($module_id)) {  //Xử lý TH tin nhan noi bo
                            $module_id = $notify->id;
                            $module_name = 'Notifications';
                        }

                        $notify->parent_id = $module_id;
                        $notify->parent_type = $module_name;
                        if (!empty($module_id))
                            $GLOBALS['db']->query("DELETE FROM notifications WHERE parent_id='$module_id'");

                        $notify->description = $body;
                        //set is_read to no
                        $notify->is_read = 0;
                        //set the level of severity
                        $notify->severity = "success";
                        //set type (assign or reminder)
                        $notify->type = $type;
                        $notify->parent_name = $parent_name;
                        $notify->save();
                    }

                    foreach($curToken as $ind => $token){

                        $ch = curl_init();
                        $data = array (
                            'notification' =>
                            array (
                                'title' => $title,
                                'body'  => $body,
                                'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
                            ),
                            'priority' => 'high',
                            'data' =>
                            array (
                                'title' => $title,
                                'body'  => $body,
                                'click_action'  => 'FLUTTER_NOTIFICATION_CLICK',
                                'id'            => '1',
                                'status'        => 'done',
                                'primaryId'     => empty($notify->id) ? '' : $notify->id,
                                'module_name'   => $module_name,  //schedules,dailyreport,payments,payment,news
                                'record_id'     => $module_id,
                                'user_id'       => $to_id,
                                'date_entered'  => date('Y-m-d H:i:s'),
                                'type'          => $type,
                                'parent_name'          => $parent_name,
                            ),
                            'to' => $token,
                        );
                        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                        curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

                        $headers = array();
                        $headers[] = 'Content-Type: application/json';
                        $headers[] = 'Authorization: key='.$GLOBALS['dotb_config']['FCM_SERVER_KEY'];
                        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

                        $err = '';
                        $result = curl_exec($ch);
                        if (curl_errno($ch)) {
                            $err = 'Error:' . curl_error($ch);
                        }
                        curl_close ($ch);
                    }

                    return true;
                }
            }
        }

        public function deleteNotification($bean, $event, $arguments)
        {

            //            if (!empty($bean->id))
            //                $GLOBALS['db']->query("DELETE FROM notifications WHERE parent_id='{$bean->id}'");

        }
}
