<?php

class AdminConfig extends DotbApi
{
    function registerApiRest()
    {
        return array(
            'c_admin_config_get_google_api_config' => array(
                'reqType' => 'GET',
                'path' => array('c_admin_config', 'get_google_api_config'),
                'pathVars' => array(''),
                'method' => 'getGoogleApiConfig'
            ),
            'c_admin_config_save_google_api_config' => array(
                'reqType' => 'POST',
                'path' => array('c_admin_config', 'save_google_api_config'),
                'pathVars' => array(''),
                'method' => 'saveGoogleApiConfig'
            ),
            'gallery_upload_album' => array(
                'reqType' => 'POST',
                'path' => array('gallery', 'upload_images_google_drive'),
                'pathVars' => array(''),
                'method' => 'uploadAlbum'
            ),
            'gallery_delete_pic' => array(
                'reqType' => 'POST',
                'path' => array('gallery', 'delete_images_google_drive'),
                'pathVars' => array(''),
                'method' => 'deletePic'
            ),
            'gallery_download_album' => array(
                'reqType' => 'POST',
                'path' => array('gallery', 'download_album'),
                'pathVars' => array(''),
                'method' => 'downloadAlbum'
            ),
            'gallery_check_config_api_google' => array(
                'reqType' => 'POST',
                'path' => array('gallery', 'check_config'),
                'pathVars' => array(''),
                'method' => 'checkConfig'
            ),
            'calls_complete_tasks' => array(
                'reqType' => 'POST',
                'path' => array('calls_complete_tasks'),
                'pathVars' => array(''),
                'method' => 'completeTask'
            ),
            'adminconfig_get_license' => array(
                'reqType' => 'GET',
                'path' => array('adminconfig', 'get_dotbheart'),
                'pathVars' => array(''),
                'method' => 'getLicense'
            ),
            'get_tickets' => array(
                'reqType' => 'GET',
                'path' => array('adminconfig', 'get_tickets'),
                'pathVars' => array(''),
                'method' => 'getTickets'
            ),
            'submit_tickets' => array(
                'reqType' => 'POST',
                'path' => array('adminconfig', 'submit_tickets'),
                'pathVars' => array(''),
                'method' => 'submietTickets'
            ),
            'close_tickets' => array(
                'reqType' => 'POST',
                'path' => array('adminconfig', 'close_tickets'),
                'pathVars' => array(''),
                'method' => 'closeTickets'
            ),
            'generation_license' => array(
                'reqType' => 'GET',
                'path' => array('adminconfig', 'generation_license'),
                'pathVars' => array(''),
                'method' => 'generationLicense',
                'noLoginRequired' => true,
            ),
        );
    }

    function generationLicense(ServiceBase $api, array $args)
    {
        require_once 'custom/include/KTEncrypt.php';
        $kt = new KTEncrypt();
        $t = $kt->encode(serialize(array(
            'users' => $args['users'],
            'teams' => $args['teams'],
            'students' => $args['students'],
            'storage' => $args['storages'],
            'package' => $args['type'],
            'date_expired' => $args['date_expired'],
            'date_update' => date("Y-m-d H:i:s")
        )), 'r>((5\tg&z/2y5y#\;');
        return $t;
    }
    function callApi($method, $url, $params, $token = 0)
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
        if ($token == 0) {
            curl_setopt($auth_request, CURLOPT_HTTPHEADER, array(
                "Content-Type: application/json"
            ));
        } else {
            curl_setopt($auth_request, CURLOPT_HTTPHEADER, array(
                "Content-Type: application/json",
                "oauth-token: " . $token
            ));
        }

        $json_arguments = json_encode($params);
        curl_setopt($auth_request, CURLOPT_POSTFIELDS, $json_arguments);
        $oauth2_token_response = curl_exec($auth_request);

        return $oauth2_token_response;
    }

    function getAPIToken()
    {
        $auth_url = "https://ims.dotb.cloud/rest/v11_3/oauth2/token";
        $oauth2_token_arguments = array(
            "grant_type" => "password",
            "client_id" => 'website',
            "client_secret" => 'dotb@crm@###',
            "platform" => 'mobile',
            "username" => 'serviceapi',
            "password" => '*q+f&9dLL%1)X.z9+K&v@UM+xcouTX'
        );
        $res = $this->callApi('POST', $auth_url, $oauth2_token_arguments);
        $res = json_decode($res, true);
        return $res['access_token'];
    }

    function getTickets(ServiceBase $api, array $args)
    {
        $data = [
            'filter' => [['account_id' => $GLOBALS['dotb_config']['ticket_id']]],
            'order_by' => ['date_modified' => 'DESC'],
            'fields' => ['id', 'case_number', 'name', 'type', 'date_entered', 'date_modified', 'status', 'description', 'assigned_user_name', 'resolution'],
            'max_num' => 100
        ];
        $token = $this->getAPIToken();
        $res = $this->callApi('GET', 'https://ims.dotb.cloud/rest/v11_3/Cases', $data, $token);
        $response = json_decode($res, true);
        $count = 0;
        while (!empty($response['error']) && ($response['error'] == 'need_login' || $response['error'] == 'not_authorized') && $count < 10) {
            $count++;
            $token = $this->getAPIToken();
            $res = $this->callApi('GET', 'https://ims.dotb.cloud/rest/v11_3/Cases', $data, $token);
            $response = json_decode($res, true);
        }

        if (!empty($response['error']) && ($response['error'] == 'need_login' || $response['error'] == 'not_authorized')) {
            return array('success' => 0, 'message' => 'Error!');
        } else {
            return array(
                'success' => 1,
                'data' => $response['records']);
        }
    }

    function submietTickets(ServiceBase $api, array $args)
    {
        $data = array(
            'name' => $args['name'],
            'type' => $args['type'],
            'priority' => $args['priority'],
            'description' => $args['description'],
            'account_id' => $args['account_id'],
            'status' => $args['status'],
            'case_number' => $args['case_number']
        );
        $token = $this->getAPIToken();
        $res = $this->callApi('POST', 'https://ims.dotb.cloud/rest/v11_3/Cases/duplicateCheck', $data, $token);
        $response = json_decode($res, true);
        $count = 0;
        while (!empty($response['error']) && $response['error'] == 'need_login' && $count < 10) {
            $count++;
            $token = $this->getAPIToken();
            $res = $this->callApi('POST', 'https://ims.dotb.cloud/rest/v11_3/Cases/duplicateCheck', $data, $token);
            $response = json_decode($res, true);
        }
        if (empty($response['records']) || count($response['records']) <= 0) {
            $res = $this->callApi('POST', 'https://ims.dotb.cloud/rest/v11_3/Cases', $data, $token);
            $response = json_decode($res, true);
            $count = 0;
            while (!empty($response['error']) && ($response['error'] == 'need_login' || $response['error'] == 'not_authorized') && $count < 10) {
                $count++;
                $token = $this->getAPIToken();
                $res = $this->callApi('POST', 'https://ims.dotb.cloud/rest/v11_3/Cases', $data, $token);
                $response = json_decode($res, true);
            }
            if (!empty($response['error']) && ($response['error'] == 'need_login' || $response['error'] == 'not_authorized')) {
                return array('success' => 0, 'message' => 'Error!');
            } else {
                return array(
                    'success' => 1,
                    'data' => array(
                        'case_number' => $response['case_number'],
                        'name' => $response['name'],
                        'type' => $response['type'],
                        'date_entered' => $response['date_entered'],
                        'date_modified' => $response['date_modified'],
                        'status' => $response['status'],
                        'description' => $response['description'],
                    ));
            }
        } else {
            return array('success' => 0, 'message' => 'Duplicated');
        }
    }

    function closeTickets(ServiceBase $api, array $args)
    {
        $data = ['id' => $args['id']];
        $token = $this->getAPIToken();
        $res = $this->callApi('POST', 'https://ims.dotb.cloud/rest/v11_3/ticket/close', $data, $token);
        $response = json_decode($res, true);
        $count = 0;
        while (!empty($response['error']) && ($response['error'] == 'need_login' || $response['error'] == 'not_authorized') && $count < 10) {
            $count++;
            $token = $this->getAPIToken();
            $res = $this->callApi('PUT', 'https://ims.dotb.cloud/rest/v11_3/Cases/' . $args['id'], $data, $token);
            $response = json_decode($res, true);
        }
        if (!empty($response['error']) && ($response['error'] == 'need_login' || $response['error'] == 'not_authorized')) {
            return ['success' => 0];
        }
        return ['success' => 1];
    }

    function getLicense(ServiceBase $api, array $args)
    {
        global $db;
        if ($db->fetchByAssoc($db->query("SHOW COLUMNS FROM users LIKE teacher_id")))
            $sql = "select count(id) from users where status='Active' and deleted=0 and user_name not in('admin','super_admin') and (teacher_id=='' or teacher_id is null)";
        else $sql = "select count(id) from users where status='Active' and deleted=0 and user_name not in('admin','super_admin')";
        $user = $GLOBALS['db']->getOne($sql);

        $sql = "SELECT DISTINCT
                        COUNT(IFNULL(t1.id, '')) count_team
                    FROM
                        teams t1
                            INNER JOIN
                        teams t2 ON t1.parent_id = t2.id AND t2.deleted = 0
                            AND t1.deleted = 0
                            AND t1.id NOT IN (SELECT DISTINCT
                                tt.parent_id
                            FROM
                                teams tt
                            WHERE
                                tt.private = 0 AND tt.deleted = 0
                                    AND (tt.parent_id <> ''
                                    AND tt.parent_id IS NOT NULL))";
        $team = $GLOBALS['db']->getOne($sql);

        $sql = "select count(id) from contacts where deleted=0";
        $student = $GLOBALS['db']->getOne($sql);

        //db size
        $result = $GLOBALS['db']->query("SHOW TABLE STATUS");
        $dbsize = 0;
        while ($row = $GLOBALS['db']->fetchByAssoc($result)) {
            $dbsize += $row["Data_length"] + $row["Index_length"];
        }
        //source size
        $io = popen('/usr/bin/du -sk', 'r');
        $size = fgets($io, 4096);
        $size = substr($size, 0, strpos($size, "\t"));
        pclose($io);

        return array(
            'users' => $user,
            'teams' => $team,
            'students' => $student,
            'storage' => number_format($dbsize / 1024 / 1024 / 1024 + $size / 1024 / 1024, 2)
        );
    }

    function completeTask(ServiceBase $api, array $args)
    {
        global $db;
        $sql = "update tasks set status='{$args['status']}' where call_relate='{$args['id']}'";
        $db->query($sql);
        return array('success' => 1);
    }

    function getFieldValue(ServiceBase $api, array $args)
    {
        global $db;
        $sql = "select {$args['field']} from {$args['module']} where {$args['field_related']}='{$args['related_id']}'";
        $rs = $db->query($sql);
        if ($row = $db->fetchByAssoc($rs)) return $row[$args['field']];
        return null;
    }

    function uploadAlbum(ServiceBase $api, array $args)
    {
        $data = array();
        global $db;
        require_once 'custom/include/GoogleAPI/class.google.php';
        require_once 'custom/include/GoogleAPI/class.drive.php';
        $admin = new Administration();
        $admin->retrieveSettings();
        $gg = new PHPGoogle();
        if (empty($admin->settings['default_google_api_token'])) return array('success' => 0);
        $gg->setAccessToken($admin->settings['default_google_api_token']);
        $drive = new PHPDrive($gg->client);
        foreach ($args['list_pic_id'] as $id) {
            $res = $db->query("select file_mime_type,filename from notes where id='{$id}'");
            if ($res = $db->fetchByAssoc($res)) {
                $file = $drive->uploadFile($res['filename'], $admin->settings['default_google_folder'], 'upload/' . $id, $res['file_mime_type']);
                $data[$id] = array('pic_gg_id' => $file->id, 'link_pic_url' => $file->webViewLink);
            }
        }
        return array('success' => 1, 'data' => $data);
    }

    function deletePic(ServiceBase $api, array $args)
    {
        require_once 'custom/include/GoogleAPI/class.google.php';
        require_once 'custom/include/GoogleAPI/class.drive.php';
        $admin = new Administration();
        $admin->retrieveSettings();
        $gg = new PHPGoogle();
        if (empty($admin->settings['default_google_api_token'])) return array('success' => 0);
        $gg->setAccessToken($admin->settings['default_google_api_token']);
        $drive = new PHPDrive($gg->client);

        foreach ($args['list_pic_gg_id'] as $id) {
            $drive->deleteFile($id);
        }
        return array('success' => 1);
    }

    function downloadAlbum(ServiceBase $api, array $args)
    {
        require_once 'custom/include/GoogleAPI/class.drive.php';
    }

    function getGoogleApiConfig(ServiceBase $api, array $args)
    {
        require_once 'custom/include/GoogleAPI/class.google.php';
        $admin = new Administration();
        $admin->retrieveSettings();
        if (empty($admin->settings['default_google_api_token'])) $code = '';
        else $code = 'author code entered';
        return array(
            'code' => $code,
            'link' => PHPGoogle::getLinkToGetAuthorCode(array(
                'https://www.googleapis.com/auth/drive',
                'https://www.googleapis.com/auth/drive.appdata',
                'https://www.googleapis.com/auth/drive.file'
            ))
        );
    }

    function saveGoogleApiConfig(ServiceBase $api, array $args)
    {
        require_once 'custom/include/GoogleAPI/class.google.php';
        $admin = new Administration();
        $admin->retrieveSettings();
        if (empty($args['code'])) $admin->saveSetting('default', 'google_api_token', '');
        else {
            $gg = new PHPGoogle();
            $gg->setAuthorCode($args['code']);
            $admin->saveSetting('default', 'google_api_token', $gg->accessToken);
        }
        if (empty($args['folder'])) $admin->saveSetting('default', 'google_folder', 'root');
        else $admin->saveSetting('default', 'google_folder', $args['folder']);
        return array("success" => 1);
    }

    function checkConfig(ServiceBase $api, array $args)
    {
        $admin = new Administration();
        $admin->retrieveSettings();
        if (empty($admin->settings['default_google_api_token'])) return array('success' => 0);
        return array("success" => 1);
    }
}