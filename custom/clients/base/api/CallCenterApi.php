<?php

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;

class CallCenterApi extends DotbApi
{
    function registerApiRest()
    {
        return array(
            'callcenter_config' => array(
                'reqType' => 'GET',
                'path' => array('callcenter', 'config'),
                'pathVars' => array(),
                'method' => 'getConfig'
            ),
            'callcenter_saveConfig' => array(
                'reqType' => 'PUT',
                'path' => array('callcenter', 'saveConfig'),
                'pathVars' => array(),
                'method' => 'saveConfig'
            ),
            'callcenter-getScript' => array(
                'reqType' => 'GET',
                'path' => array('callcenter', 'getScript'),
                'pathVars' => array(),
                'method' => 'getScript'
            ),
            'callcenter-getBeans' => array(
                'reqType' => 'PUT',
                'path' => array('callcenter', 'getBeans'),
                'pathVars' => array(),
                'method' => 'getBeans'
            ),
            'callcenter-save' => array(
                'reqType' => 'PUT',
                'path' => array('callcenter', 'save'),
                'pathVars' => array(),
                'method' => 'save'
            ),

            /**
             * oncall
             */
            'callcenter-oncall-clicktocall' => array(
                'reqType' => 'PUT',
                'path' => array('callcenter', 'oncall', 'clicktocall'),
                'pathVars' => array(),
                'method' => 'oncallClickToCall'
            ),
            'callcenter-oncall-webhook-get' => array(
                'reqType' => 'GET',
                'path' => array('callcenter', 'oncall', 'webhook'),
                'pathVars' => array(),
                'method' => 'oncallWebhook',
                'noLoginRequired' => true,
            ),
            'callcenter-oncall-webhook-post' => array(
                'reqType' => 'POST',
                'path' => array('callcenter', 'oncall', 'webhook'),
                'pathVars' => array(),
                'method' => 'oncallWebhook',
                'noLoginRequired' => true,
            ),
            'callcenter-oncall-get-recording' => array(
                'reqType' => 'PUT',
                'path' => array('callcenter', 'oncall', 'recording'),
                'pathVars' => array(),
                'method' => 'oncallGetRecording'
            ),

            /**
             * worldfone
             */
            'callcenter-worldfone-webhook-get' => array(
                'reqType' => 'GET',
                'path' => array('callcenter', 'worldfone', 'webhook'),
                'pathVars' => array(),
                'method' => 'worldfoneWebhook',
                'noLoginRequired' => true,
            ),
            'callcenter-worldfone-webhook-post' => array(
                'reqType' => 'POST',
                'path' => array('callcenter', 'worldfone', 'webhook'),
                'pathVars' => array(),
                'method' => 'worldfoneWebhook',
                'noLoginRequired' => true,
            ),

            /**
             * cloudfone
             */
            'callcenter-cloudfone-webhook-get' => array(
                'reqType' => 'GET',
                'path' => array('callcenter', 'cloudfone', 'webhook'),
                'pathVars' => array(),
                'method' => 'cloudfoneWebhook',
                'noLoginRequired' => true,
            ),
            'callcenter-cloudfone-webhook-post' => array(
                'reqType' => 'POST',
                'path' => array('callcenter', 'cloudfone', 'webhook'),
                'pathVars' => array(),
                'method' => 'cloudfoneWebhook',
                'noLoginRequired' => true,
            ),

            /**
             * voicecloud
             */
            'callcenter-voicecloud-hangup' => array(
                'reqType' => 'POST',
                'path' => array('callcenter', 'voicecloud', 'hangup'),
                'pathVars' => array(),
                'method' => 'voiceCloudHangup',
                'noLoginRequired' => true,
            ),
            'callcenter-voicecloud-hangup-get' => array(
                'reqType' => 'GET',
                'path' => array('callcenter', 'voicecloud', 'hangup'),
                'pathVars' => array(),
                'method' => 'voiceCloudHangup',
                'noLoginRequired' => true,
            ),
            'callcenter-voicecloud-answer' => array(
                'reqType' => 'POST',
                'path' => array('callcenter', 'voicecloud', 'log'),
                'pathVars' => array(),
                'method' => 'voiceCloudLog',
                'noLoginRequired' => true,
            ),
            'callcenter-voicecloud-answer-get' => array(
                'reqType' => 'GET',
                'path' => array('callcenter', 'voicecloud', 'log'),
                'pathVars' => array(),
                'method' => 'voiceCloudLog',
                'noLoginRequired' => true,
            ),
            'callcenter-voicecloud-call' => array(
                'reqType' => 'POST',
                'path' => array('callcenter', 'voicecloud', 'call'),
                'pathVars' => array(),
                'method' => 'voiceCloudCall',
                'noLoginRequired' => true,
            ),
            'callcenter-voicecloud-callcomming' => array(
                'reqType' => 'POST',
                'path' => array('callcenter', 'voicecloud', 'callcomming'),
                'pathVars' => array(),
                'method' => 'voiceCloudCallcomming',
                'noLoginRequired' => true,
            ),
            'callcenter-voicecloud-callcomming-get' => array(
                'reqType' => 'GET',
                'path' => array('callcenter', 'voicecloud', 'callcomming'),
                'pathVars' => array(),
                'method' => 'voiceCloudCallcomming',
                'noLoginRequired' => true,
            ),
        );
    }

    function voiceCloudHangup(ServiceBase $api, array $args)
    {
        return array('success' => 1);
    }

    function voiceCloudLog(ServiceBase $api, array $args)
    {
        $admin = new Administration();
        $admin->retrieveSettings();
        $config = $admin->settings['callcenter_config'];
        foreach ($config as $c) {
            if ($c['ext'] == $args['extension']) {
                include 'custom/include/socket.io.class.php';
                $socket = new SocketIO('localhost', 3002);
                $socket->send(array(
                    'receiver' => $GLOBALS['dotb_config']['unique_key'] . $c['user'],
                    'data' => $args
                ));
            }
        }

        return array('success' => 1);
    }

    function voiceCloudCall(ServiceBase $api, array $args)
    {
        return array('success' => 1);
    }

    function voiceCloudCallcomming(ServiceBase $api, array $args)
    {
        return array('success' => 1);
    }

    function oncallClickToCall(ServiceBase $api, array $args)
    {
        $GLOBALS['log']->fatal(array(
            'success' => 1
        ));
        require_once 'custom/include/guzzlehttp/vendor/autoload.php';
        $client = new GuzzleHttp\Client(['base_uri' => 'http://118.68.169.39:8899']);
        $r = $client->post('api/extensions/call', array(
            'body' => json_encode($args['data'])
        ));
        $GLOBALS['log']->fatal($r);

        return array('success' => 1);
    }

    function cloudfoneWebhook(ServiceBase $api, array $args)
    {
        $GLOBALS['log']->fatal($args);
        $admin = new Administration();
        $admin->retrieveSettings();
        $callcenterSupplier = $admin->settings['callcenter_supplier'];
        $callcenterPort = $admin->settings['callcenter_port'];
        if ($callcenterSupplier != 'Cloudfone') return array('success' => 0);

        include 'custom/include/socket.io.class.php';
        $socket = new SocketIO('localhost', ((int)$callcenterPort - 1));
        $callcenterSettings = $admin->settings['callcenter_config'];

        if (in_array($args['Status'], array('Ringing'))) {
            $args['dotb_direction'] = 'Outbound';
            $args['dotb_call_status'] = 'Waiting';

            foreach ($callcenterSettings as $st) {
                if ($st['ext'] == $args['CallNumber']) {
                    $args['dotb_user'] = $st['user'];
                    break;
                }
            }

            $args['dotb_source'] = 'Cloudfone';

            $socket->send(array(
                'receiver_id' => $args['dotb_user'],
                'data' => $args
            ));
        }
        return array('success' => 1);
    }

    /**
     * @param ServiceBase $api
     * @param array $args : dotb_ext, dotb_phone, dotb_call_status,dotb_direction
     * @return |null
     */
    function oncallWebhook(ServiceBase $api, array $args)
    {
        $admin = new Administration();
        $admin->retrieveSettings();
        $callcenterSupplier = $admin->settings['callcenter_supplier'];
        $callcenterPort = $admin->settings['callcenter_port'];
        if ($callcenterSupplier != 'Oncall') return null;

        include 'custom/include/socket.io.class.php';
        $socket = new SocketIO('localhost', ((int)$callcenterPort - 1));
        $callcenterSettings = $admin->settings['callcenter_config'];

        $args['dotb_ext'] = false;
        if (in_array($args['event_type'], array('call_established', 'call_ended', 'call_start'))) {
            $matchr = array();
            preg_match('/sip:([0-9]+)@/', $args['caller'], $matchr);
            $matche = array();
            preg_match('/sip:([0-9]+)@/', $args['callee'], $matche);

            if (strlen($matchr[1]) > 4) {
                $args['dotb_phone'] = $matchr[1];
                $args['dotb_direction'] = 'Inbound';
            } else {
                $args['dotb_ext'] = $matchr[1];
                $args['dotb_direction'] = 'Outbound';
            }

            if (strlen($matche[1]) > 4) $args['dotb_phone'] = $matche[1];
            else $args['dotb_ext'] = $matche[1];

            foreach ($callcenterSettings as $st) {
                if ($st['ext'] == $args['dotb_ext']) {
                    $args['dotb_user'] = $st['user'];
                    break;
                }
            }

            //call status
            if ($args['event_type'] == 'call_start') $args['dotb_call_status'] = 'Waiting';
            elseif ($args['event_type'] == 'call_established') $args['dotb_call_status'] = 'Connected';
            elseif ($args['event_type'] == 'call_ended') $args['dotb_call_status'] = 'Hangup';

            //source
            $args['dotb_source'] = 'Oncall';

            $socket->send(array(
                'receiver_id' => $args['dotb_user'],
                'data' => $args
            ));
        }
    }

    /**
     * @param ServiceBase $api
     * @param array $args
     * @return |null
     * [
     * {
     * "pbx_customer_code": "C0581",
     * "secret": "854795eea8ca3f432fa4d53fece48c2f",
     * "callstatus": "Dialing",
     * "calluuid": "1595005183.51414",
     * "direction": "outbound",
     * "callernumber": "101",
     * "destinationnumber": "0336634028",
     * "agentname": "101",
     * "starttime": "20200717T235945",
     * "dnis": "2836222703",
     * "calltype": "Outbound_non-ACD",
     * "version": "4"
     * },
     * {
     * "pbx_customer_code": "C0581",
     * "secret": "854795eea8ca3f432fa4d53fece48c2f",
     * "callstatus": "DialAnswer",
     * "calluuid": "1595005183.51414",
     * "childcalluuid": "1595005185.51415",
     * "callernumber": "2836222703",
     * "destinationnumber": "0336634028",
     * "answertime": "20200717T235956",
     * "version": "4",
     * "direction": "outbound"
     * },
     * {
     * "pbx_customer_code": "C0581",
     * "secret": "854795eea8ca3f432fa4d53fece48c2f",
     * "callstatus": "CDR",
     * "calluuid": "1595005183.51414",
     * "starttime": "20200717T235945",
     * "answertime": "20200717T235956",
     * "endtime": "20200718T000005",
     * "billduration": "9",
     * "totalduration": "20",
     * "disposition": "ANSWERED",
     * "monitorfilename": "/mnt/sipcloud9_1/C0581/callout/20200717/SIP/C0581101-0000c61c-101-1595005183.51414.mp3",
     * "direction": "outbound",
     * "hangup_by": "",
     * "version": "4"
     * }
     * ]
     */
    function worldfoneWebhook(ServiceBase $api, array $args)
    {
        $GLOBALS['log']->fatal($args);
        $admin = new Administration();
        $admin->retrieveSettings();
        $callcenterSupplier = $admin->settings['callcenter_supplier'];
        $callcenterPort = $admin->settings['callcenter_port'];
        if ($callcenterSupplier != 'Worldfone') return null;

        include 'custom/include/socket.io.class.php';
        $socket = new SocketIO('localhost', ((int)$callcenterPort - 1));
        $callcenterSettings = $admin->settings['callcenter_config'];

        if (in_array($args['callstatus'], array('Dialing', 'DialAnswer', 'CDR'))) {
            foreach ($callcenterSettings as $st) {
                if ($st['ext'] == $args['callernumber']) {
                    $args['dotb_user'] = $st['user'];
                    break;
                }
            }
            if (empty($args['dotb_user'])) $args['dotb_user'] = 0;

            //call status
            if ($args['callstatus'] == 'Dialing') $args['dotb_call_status'] = 'Waiting';
            elseif ($args['callstatus'] == 'DialAnswer') $args['dotb_call_status'] = 'Connected';
            elseif ($args['callstatus'] == 'CDR') $args['dotb_call_status'] = 'Hangup';

            //source
            $args['dotb_source'] = 'Worldfone';

            $socket->send(array(
                'receiver_id' => $args['dotb_user'],
                'data' => $args
            ));
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

    function getConfig(ServiceBase $api, array $args)
    {
        $data = array();

        //config
        $admin = new Administration();
        $admin->retrieveSettings();
        $callcenterSettings = $admin->settings['callcenter_config'];
        $callcenterSupplier = $admin->settings['callcenter_supplier'];
        $callcenterPort = $admin->settings['callcenter_port'];
        $callcenterUsername = $admin->settings['callcenter_username'];
        $callcenterPassword = $admin->settings['callcenter_password'];

        if (!empty($callcenterSettings)) {
            $data['config'] = $callcenterSettings;
        } else {
            $data['config'] = array();
        }

        if (!empty($callcenterSupplier)) {
            $data['supplier'] = $callcenterSupplier;
        } else {
            $data['supplier'] = '';
        }

        if (!empty($callcenterPort)) {
            $data['port'] = $callcenterPort;
        } else {
            $data['port'] = '';
        }

        if (!empty($callcenterUsername)) {
            $data['username'] = $callcenterUsername;
        } else {
            $data['username'] = '';
        }

        if (!empty($callcenterPassword)) {
            $data['password'] = $callcenterPassword;
        } else {
            $data['password'] = '';
        }

        //users
        $users = array();
        $result = $GLOBALS['db']->query("select id,user_name,concat(first_name,' ',last_name) as full_name from users where deleted=0 and status='active' order by last_name");
        while ($row = $GLOBALS['db']->fetchByAssoc($result)) {
            $users[$row['id']] = $row['user_name'] . ' (' . $row['full_name'] . ')';
        }
        $data['users'] = $users;

        return $data;
    }

    function saveConfig(ServiceBase $api, array $args)
    {
        $admin = new Administration();
        $admin->retrieveSettings();
        $admin->saveSetting('callcenter', 'config', json_encode($args['config']));
        $admin->saveSetting('callcenter', 'supplier', $args['supplier']);
        $admin->saveSetting('callcenter', 'port', $args['port']);
        $admin->saveSetting('callcenter', 'username', $args['username']);
        $admin->saveSetting('callcenter', 'password', $args['password']);

        return array('success' => 1);
    }

    function getBeans(ServiceBase $api, array $args)
    {
        global $locale, $db;
        $listBean = array();
        if (!empty($args['beanName']) && !empty($args['beanId'])) {
            $bean = BeanFactory::getBean($args['beanName'], $args['beanId']);
            $dataBean = array(
                'id' => $bean->id,
                'beanName' => $args['beanName'],
                'name' => in_array($args['beanName'], array('Prospects', 'Leads', 'Contacts')) ? $locale->getLocaleFormattedName($bean->first_name, $bean->last_name) : $bean->name,
                'status' => empty($bean->status) ? '' : $bean->status,
                'phoneNumber' => empty($args['phoneNumber']) ? (empty($bean->phone_mobile) ? '' : $bean->phone_mobile) : $args['phoneNumber'],
                'email' => empty($bean->email1) ? '' : $bean->email1
            );
            if ($args['beanName'] == 'Accounts') {
                $dataBean['address'] = array(
                    'address_street' => $bean->billing_address_street,
                    'address_state' => $bean->billing_address_state,
                    'address_city' => $bean->billing_address_city,
                    'address_country' => $bean->billing_address_country
                );
            } else {
                $dataBean['address'] = array(
                    'address_street' => $bean->primary_address_street,
                    'address_state' => $bean->primary_address_state,
                    'address_city' => $bean->primary_address_city,
                    'address_country' => $bean->primary_address_country
                );
            }
            $listBean[] = $dataBean;
        } else {
            $listBeanId = array();

            $fieldPhone = array();
            $bean = BeanFactory::newBean('Contacts');
            foreach ($bean->field_defs as $field) if ($field['type'] == 'phone') $fieldPhone[] = "{$field['name']} like '{$args['phoneNumber']}'";
            $sql = "select id,'Contacts' as module from contacts where deleted=0 and (" . implode(' OR ', $fieldPhone) . ")";
            $result = $db->query($sql);
            while ($row = $db->fetchByAssoc($result)) $listBeanId[$row['id']] = $row;

            $fieldPhone = array();
            $bean = BeanFactory::newBean('Accounts');
            foreach ($bean->field_defs as $field) if ($field['type'] == 'phone') $fieldPhone[] = "{$field['name']} like '{$args['phoneNumber']}'";
            $sql = "select id,'Accounts' as module from accounts where deleted=0 and (" . implode(' OR ', $fieldPhone) . ")";
            $result = $db->query($sql);
            while ($row = $db->fetchByAssoc($result)) $listBeanId[$row['id']] = $row;

            $fieldPhone = array();
            $bean = BeanFactory::newBean('Leads');
            foreach ($bean->field_defs as $field) if ($field['type'] == 'phone') $fieldPhone[] = "{$field['name']} like '{$args['phoneNumber']}'";
            $sql = "select id,'Leads' as module from leads where deleted=0 and (" . implode(' OR ', $fieldPhone) . ")";
            $result = $db->query($sql);
            while ($row = $db->fetchByAssoc($result)) $listBeanId[$row['id']] = $row;

            $fieldPhone = array();
            $bean = BeanFactory::newBean('Prospects');
            foreach ($bean->field_defs as $field) if ($field['type'] == 'phone') $fieldPhone[] = "{$field['name']} like '{$args['phoneNumber']}'";
            $sql = "select id,'Prospects' as module from prospects where deleted=0 and (" . implode(' OR ', $fieldPhone) . ")";
            $result = $db->query($sql);
            while ($row = $db->fetchByAssoc($result)) $listBeanId[$row['id']] = $row;

            foreach ($listBeanId as $id => $item) {
                $bean = BeanFactory::getBean($item['module'], $id);
                $dataBean = array(
                    'id' => $bean->id,
                    'beanName' => $item['module'],
                    'name' => in_array($item['module'], array('Prospects', 'Leads', 'Contacts')) ? $locale->getLocaleFormattedName($bean->first_name, $bean->last_name) : $bean->name,
                    'status' => empty($bean->status) ? '' : $bean->status,
                    'phoneNumber' => empty($args['phoneNumber']) ? (empty($bean->phone_mobile) ? '' : $bean->phone_mobile) : $args['phoneNumber'],
                    'email' => empty($bean->email1) ? '' : $bean->email1
                );
                if ($item['module'] == 'Accounts') {
                    $dataBean['address'] = array(
                        'address_street' => $bean->billing_address_street,
                        'address_state' => $bean->billing_address_state,
                        'address_city' => $bean->billing_address_city,
                        'address_country' => $bean->billing_address_country
                    );
                } else {
                    $dataBean['address'] = array(
                        'address_street' => $bean->primary_address_street,
                        'address_state' => $bean->primary_address_state,
                        'address_city' => $bean->primary_address_city,
                        'address_country' => $bean->primary_address_country
                    );
                }
                $listBean[] = $dataBean;
            }
        }
        return $listBean;
    }

    function save(ServiceBase $api, array $args)
    {
        global $db, $current_user, $timedate, $app_list_strings;
        $sql = "SELECT id FROM calls WHERE outlook_id = '{$args['callId']}' AND deleted = 0 ORDER BY date_modified DESC LIMIT 1";
        $id = $db->getOne($sql);

        if ($args['direction'] == 'Inbound') {
            $callSubject = "Inbound Call from: " . $args['phoneNumber'];
            $sourceNumber = $args['phoneNumber'];
            $destinationNumber = $args['ext'];
        } else {
            $callSubject = "Outbound Call to: " . $args['phoneNumber'];
            $sourceNumber = $args['ext'];
            $destinationNumber = $args['phoneNumber'];
        }

        if (empty($id)) $call = BeanFactory::newBean('Calls');
        else $call = BeanFactory::getBean('Calls', $id);

        $call->name = $callSubject;
        $call->outlook_id = $args['callId'];
        $call->direction = $args['direction'];
        $call->status = 'Held';
        $call->description = $args['description'];
        $call->parent_type = $args['beanName'];
        $call->parent_id = $args['id'];
        $call->call_result = $args['callResult'];
        $call->call_purpose = $args['callPurpose'];
        $call->assigned_user_id = $current_user->id;
        $call->team_id = $current_user->team_id;
        $call->move_trash = $args['deadlead'];
        $call->mark_favorite = $args['favorite'];
        $call->call_source = $sourceNumber;
        $call->call_destination = $destinationNumber;
        $call->call_entrysource = $args['source'];
        $call->duration = (int)$args['duration'];
        $call->call_recording = $args['recording'];
        if (!empty($args['start'])) $call->date_start = gmdate("Y-m-d H:i:s", strtotime($args['start']));
        else $call->date_start = $timedate->nowDb();
        if (!empty($args['end'])) $call->date_end = gmdate("Y-m-d H:i:s", strtotime($args['end']));
        if (isset($app_list_strings['calls_duration_options'][$call->duration])) $call->call_duration = (int)$args['duration'];
        else {
            $call->call_duration = 99999;
            if (empty($call->date_end)) {
                $tmp = strtotime($call->date_start) + $call->duration;
                $call->date_end = gmdate("Y-m-d H:i:s", $tmp);
            }
        }
        $call->duration_hours = (int)date("H", $call->duration);
        $call->duration_minutes = (int)date("i", $call->duration);
        $call->recall = $args['recall'];
        if ($call->recall != 0 && $call->recall != 99999) {
            $call->recall_at = date("Y-m-d H:i:s", $call->recall + strtotime($call->date_start) + $call->duration);
        } elseif ($call->recall == 0) {
            $call->recall_at = null;
        } else {
            $call->recall_at = $args['recall_at'];
        }

        $call->save();

        $nowDb = $timedate->nowDb();
        if ($call->parent_type == 'Leads') {
            $id = create_guid();
            $db->query("delete from calls_leads where call_id='{$call->id}' and lead_id='{$call->parent_id}'");
            $db->query("insert into calls_leads(id, call_id, lead_id, date_modified) values('{$id}','{$call->id}','{$call->parent_id}','{$nowDb}')");
        } elseif ($call->parent_type == 'Contacts') {
            $id = create_guid();
            $db->query("delete from calls_contacts where call_id='{$call->id}' and contact_id='{$call->parent_id}'");
            $db->query("insert into calls_contacts(id, call_id, contact_id, date_modified) values('{$id}','{$call->id}','{$call->parent_id}','{$nowDb}')");
        }
        //return result
        return array(
            "success" => 1
        );
    }

    function getScript(ServiceBase $api, array $args)
    {
        global $current_user;

        $admin = new Administration();
        $admin->retrieveSettings();
        $callcenter_config = $admin->settings['callcenter_config'];
        $callcenter_supplier = $admin->settings['callcenter_supplier'];
        $callcenter_port = $admin->settings['callcenter_port'];
        $callcenter_username = $admin->settings['callcenter_username'];
        $callcenter_password = $admin->settings['callcenter_password'];

        if (!empty($callcenter_supplier)) {
            foreach ($callcenter_config as $config) {
                if ($current_user->id == $config['user']) {
                    if ($callcenter_supplier == 'Asterisk' && !empty($config['ip']) && !empty($config['ext']) && !empty($config['chanel']) && !empty($config['context'])) {
                        $html = "<script type='text/javascript'>
                                            window.poll_rate = 10000;
                                            window.current_user_id = '{$current_user->id}';
                                            window.no_Of_users = 1;
                                            window.AsteriskIP = '{$config['ip']}';
                                            window.RelateAccount = '1';
                                            window.RelateContact = '1';
                                            window.PhoneExtension ='{$config['ext']}';
                                            window.CreateAccount = '1';
                                            window.CreateLead = '1';
                                            window.CreateContact = '1';
                                            window.CallTransfer = '1';
                                            window.CallHold = '';
                                            window.CallHangup = '1';
                                            window.ShowPopup = '1';
                                            window.createCase = '1';
                                            window.DialoutPrefix = '{$config['chanel']}';
                                            window.DialPlan = '{$config['context']}';
                                            window.LastCall = '1';
                                            window.uservalue = '1';
                                            window.RelateCase = '1';
                                            window.scheduleCall = '1';
                                            window.taskCall = '1';
                                    </script>
                                    <script src='custom/modules/Asterisk/include/jWebSocket.js'></script>
                                    <script src='custom/modules/Asterisk/asterisk.js'></script>";
                        return array(
                            'success' => 1,
                            'supplier' => 'Asterisk',
                            'html' => $html
                        );
                    } elseif ($callcenter_supplier == 'Oncall' && !empty($config['ext']) && !empty($config['ip']) && !empty($config['context'])) {
                        return array(
                            'success' => 1,
                            'supplier' => 'Oncall',
                            'port' => $callcenter_port,
                            'username' => $callcenter_username,
                            'password' => $callcenter_password,
                            'config' => array(
                                'ext' => $config['ext'],
                                'ip' => $config['ip'],
                                'context' => $config['context'],
                                'port' => $callcenter_port
                            )
                        );
                    } elseif ($callcenter_supplier == 'Voip24h' && !empty($config['ext']) && !empty($callcenter_port) && !empty($callcenter_username) && !empty($callcenter_password)) {
                        return array(
                            'success' => 1,
                            'supplier' => 'Voip24h',
                            'ip' => $callcenter_port,
                            'key' => $callcenter_username,
                            'secret' => $callcenter_password,
                            'ext' => $config['ext']
                        );
                    } elseif ($callcenter_supplier == 'Worldfone' && !empty($config['ext']) && !empty($callcenter_password)) {
                        return array(
                            'success' => 1,
                            'supplier' => 'Worldfone',
                            'secret' => $callcenter_password,
                            'ext' => $config['ext'],
                            'port' => $callcenter_port,
                        );
                    } elseif ($callcenter_supplier == 'Cloudfone' && !empty($config['ext']) && !empty($config['chanel']) && !empty($callcenter_port) && !empty($callcenter_username) && !empty($callcenter_password)) {
                        return array(
                            'success' => 1,
                            'supplier' => 'Cloudfone',
                            'key' => $callcenter_username,
                            'secret' => $callcenter_password,
                            'ext' => $config['ext'],
                            'service_name' => $config['chanel'],
                            'port' => $callcenter_port,
                        );
                    } elseif ($callcenter_supplier == 'VoiceCloud' && !empty($config['ext']) && !empty($callcenter_port) && !empty($callcenter_username) && !empty($callcenter_password)) {
                        return array(
                            'success' => 1,
                            'supplier' => 'VoiceCloud',
                            'domain' => $callcenter_username,
                            'key' => $callcenter_password,
                            'ext' => $config['ext'],
                            'callcenter_domain' => $callcenter_port,
                        );
                    }
                }
            }
        }
        return array(
            'success' => 0
        );
    }
}
