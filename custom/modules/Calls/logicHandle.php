<?php

class logicHandle
{
    function handleAfterSave(&$bean, $event, $arguments)
    {
        global $db;
        //person
        $person = BeanFactory::getBean($bean->parent_type, $bean->parent_id);
        //Update Lead, Prospect Status
        if ($bean->parent_type == 'Leads' || $bean->parent_type == 'Prospects') {
            //update In Process
            $lead_status = $person->status;
            if (in_array($person->status, ['New', 'Dead']) && !in_array($bean->call_result, ['Busy/No Answer', 'Invalid Number', 'Deny', 'Call Back Later']))
                $lead_status = 'In Process';
            else {
                if ($bean->parent_type == 'Prospects' && $person->status == 'New')
                    $lead_status = 'In Process';
            }
            //mark Dead
            if ($bean->move_trash) $lead_status = 'Dead';
        }

        //Update Call Status
        $person->status = $lead_status;
        $person->last_call_status = $bean->status;
        $person->last_call_date = $bean->date_start;
        $person->save();
        //end person related

        //mark favorite
        if ($bean->mark_favorite) {
            $sql = "select id from dotbfavorites where record_id='{$bean->parent_id}' and assigned_user_id='{$bean->assigned_user_id}'";
            $result = $db->query($sql);
            if ($row = $db->fetchByAssoc($result)) {
                $sql = "update dotbfavorites set deleted=0 where record_id='{$bean->parent_id}' and assigned_user_id='{$bean->assigned_user_id}'";
                $db->query($sql);
            } else {
                $tid = create_guid();
                $sql = "insert into dotbfavorites(id,module,record_id,assigned_user_id,created_by,modified_user_id)
                values('{$tid}','{$bean->parent_type}','{$bean->parent_id}','{$bean->assigned_user_id}','{$bean->created_by}','{$bean->modified_user_id}')";
                $db->query($sql);
            }
        }

        //recall
        if ($bean->status == 'Held') {
            if (!empty($bean->recall)) {
                $sql = "select id from calls where parent_call='{$bean->id}' and deleted=0";
                $result = $db->query($sql);

                if ($row = $db->fetchByAssoc($result)) $calls = BeanFactory::getBean('Calls', $row['id']);
                else $calls = BeanFactory::newBean('Calls');

                $calls->status = 'Planned';
                $calls->date_start = $bean->recall_at;
                $calls->date_end = $bean->date_start;
                $calls->reminder_time = $bean->reminder_time;
                $calls->email_reminder_time = $bean->email_reminder_time;
                $calls->parent_id = $bean->parent_id;
                $calls->direction = 'Outbound';
                $calls->parent_call = $bean->id;
                $calls->parent_type = $bean->parent_type;
                $calls->assigned_user_id = $bean->assigned_user_id;
                $calls->team_id = $bean->team_id;
                $calls->team_set_id = $bean->team_set_id;
                $calls->save();

                //add relationship
                $link_name = strtolower($calls->parent_type);
                if ($calls->load_relationship($link_name)) {
                    $calls->$link_name->add($bean->parent_id);
                }
            }
        }
    }

    function handleBeforeSave(&$bean, $event, $arguments)
    {
        $person = BeanFactory::getBean($bean->parent_type, $bean->parent_id);
        if (empty($bean->name)) {
            $bean->name = $bean->direction . ' Call ' . ($bean->direction == 'Outbound' ? 'to ' : 'from ') . $GLOBALS['app_list_strings']['parent_type_display'][$bean->parent_type] . ' : ' . $person->name;
        } else {
            if (preg_match('/^[Outbound|Inbound]/', $bean->name)) {
                $bean->name = $bean->direction . ' Call ' . ($bean->direction == 'Outbound' ? 'to ' : 'from ') . $GLOBALS['app_list_strings']['parent_type_display'][$bean->parent_type] . ': ' . $person->name;
            }
        }
    }

    function callApi($method, $url, $params = array(), $header = array("Content-Type: application/json"))
    {
        $auth_request = curl_init($url);
        curl_setopt($auth_request, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
        curl_setopt($auth_request, CURLOPT_HEADER, false);
        curl_setopt($auth_request, CURLOPT_SSL_VERIFYPEER, 0);
        if ($method == 'POST') {
            curl_setopt($auth_request, CURLOPT_POST, 1);
        } elseif ($method == 'GET') {
            curl_setopt($auth_request, CURLOPT_CUSTOMREQUEST, 'GET');
        }
        curl_setopt($auth_request, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($auth_request, CURLOPT_FOLLOWLOCATION, 0);
        curl_setopt($auth_request, CURLOPT_HTTPHEADER, $header);

        if ($method != 'GET') {
            if (count($params) > 0) {
                $json_arguments = json_encode($params);
                curl_setopt($auth_request, CURLOPT_POSTFIELDS, $json_arguments);
            }
        } else {
            $tmp = '?';
            foreach ($params as $key => $value) {
                $tmp = $key . '=' . $value . '&';
            }
            rtrim($tmp, '&');
            if ($tmp != '?') {
                $auth_request = curl_init($url . $tmp);
                curl_setopt($auth_request, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
                curl_setopt($auth_request, CURLOPT_HEADER, false);
                curl_setopt($auth_request, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($auth_request, CURLOPT_CUSTOMREQUEST, 'GET');
                curl_setopt($auth_request, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($auth_request, CURLOPT_FOLLOWLOCATION, 0);
                curl_setopt($auth_request, CURLOPT_HTTPHEADER, $header);
            }
        }

        $oauth2_token_response = curl_exec($auth_request);
        return $oauth2_token_response;
    }

    function handleAfterRetrieve($bean, $event, $arguments)
    {
        $match = array();
        if (preg_match('/^::Voip24h::(http.+)$/', $bean->call_recording, $match)) {
            $result = $this->callApi('GET',$match[1]);
            $result = json_decode($result, 1);
            if ($result['result']['recordsTotalAll'] > 0 && count($result['result']['data']) > 0 && strtoupper($result['result']['data'][0]['status']) == 'ANSWERED' && !empty($result['result']['data'][0]['recording'])) {
                $bean->call_recording = $result['result']['data'][0]['recording'];
                $GLOBALS['db']->query("update calls set call_recording='{$bean->call_recording}' where id='{$bean->id}'");
            } else {
                $bean->call_recording = '';
                if (strtotime(gmdate("Y-m-d H:i:s")) - strtotime($bean->date_entered) > 86400) {
                    $GLOBALS['db']->query("update calls set call_recording='' where id='{$bean->id}'");
                }
            }
        }
    }
}
