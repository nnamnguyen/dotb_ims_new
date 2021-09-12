<?php

class IMSServerAPI extends DotbApi
{
    function registerApiRest()
    {
        return array(
            'ims_server_update_code' => array(
                'reqType' => 'POST',
                'path' => array('ims', 'server', 'update_code'),
                'pathVars' => array(''),
                'method' => 'updateCode'
            ),
            'recheck-app-license' => array(
                'reqType' => 'POST',
                'path' => array('ims', 'server', 'recheck-app-license'),
                'pathVars' => array(''),
                'method' => 'reCheckAppLicense'
            ),
            'get-app-license' => array(
                'reqType' => 'GET',
                'path' => array('ims', 'server', 'get-app-license'),
                'pathVars' => array(''),
                'method' => 'getAppLicense',
                'noLoginRequired' => true
            ),
            'get-crm-license' => array(
                'reqType' => 'GET',
                'path' => array('ims', 'server', 'get-crm-license'),
                'pathVars' => array(''),
                'method' => 'getCRMLicense',
                'noLoginRequired' => true
            ),
            'get-parent-app-license' => array(
                'reqType' => 'GET',
                'path' => array('ims', 'server', 'get-parent-app-license'),
                'pathVars' => array(''),
                'method' => 'getParentAppLicense',
                'noLoginRequired' => true
            ),
            'add-parent-app-license' => array(
                'reqType' => 'GET',
                'path' => array('ims', 'server', 'add-parent-app-license'),
                'pathVars' => array(''),
                'method' => 'addParentAppLicense',
                'noLoginRequired' => true
            ),

            'del-parent-app-license' => array(
                'reqType' => 'GET',
                'path' => array('ims', 'server', 'del-parent-app-license'),
                'pathVars' => array(''),
                'method' => 'delParentAppLicense',
                'noLoginRequired' => true
            ),
            'cap_lead_p_v2' => array(
                'reqType' => 'POST',
                'path' => array('cap_lead_v2_1'),
                'pathVars' => array(),
                'method' => 'capLeadAPI',
                'noLoginRequired' => true
            ),
        );
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

    function delParentAppLicense(ServiceBase $api, array $args)
    {
        $license = $this->getParentAppLicense($api, $args);
        foreach ($license as $lic) {
            if ($lic['used'] > 0) {
                $GLOBALS['db']->query("update c_parentapplicense set used=used-1 where id='{$lic['id']}'");
                break;
            }
        }
    }

    function addParentAppLicense(ServiceBase $api, array $args)
    {
        $GLOBALS['db']->query("update c_parentapplicense set used=used+1 where id='{$args['id']}'");
    }

    function getParentAppLicense(ServiceBase $api, array $args)
    {
        $sql = "select p.name, p.total, p.used, p.package, p.start, p.expired,p.id
                    from c_parentapplicense as p
                             inner join c_sitedeployment_c_parentapplicense_1_c as sp on sp.c_sitedeployment_c_parentapplicense_1c_parentapplicense_idb = p.id and sp.deleted = 0
                    inner join c_sitedeployment as s on s.id=sp.c_sitedeployment_c_parentapplicense_1c_sitedeployment_ida and s.deleted=0
                    where s.name = '{$args['domain']}' 
                      and p.deleted=0
                    order by p.expired desc";
        $result = $GLOBALS['db']->query($sql);
        $data = array();
        while ($row = $GLOBALS['db']->fetchByAssoc($result)) {
            $data[] = $row;
        }
        return $data;
    }

    function getCRMLicense(ServiceBase $api, array $args)
    {
        $sql = "select lic_users,lic_storages,lic_teams,date_expired,date_start,lic_type from c_sitedeployment where name='{$args['domain']}' and deleted=0";
        $result = $GLOBALS['db']->query($sql);
        $row = $GLOBALS['db']->fetchByAssoc($result);
        if ($row) {
            $row['date_start_time'] = strtotime($row['date_start'] . ' 00:00:00');
            $row['date_expired_time'] = strtotime($row['date_expired'] . ' 23:59:59');
        }
        return array('success' => 1, 'data' => $row);
    }

    function updateCode(ServiceBase $api, array $args)
    {
        shell_exec("cd /home/cloud/domains/{$args['domain']}/public_html;git -c user.name='TKT' -c user.email='toan.tran@dotb.vn' pull;");
        shell_exec("cd /home/cloud/domains/{$args['domain']}/public_html;git add .;git -c user.email='toan.tran@dotb.vn' -c user.name='TKT' commit -m '️★★AUTO COMMIT FROM SERVER★★';git push origin master;");
        return array('success' => 1);
    }

    function getAppLicense(ServiceBase $api, array $args)
    {
        $current = (int)$args['app_license'];

        //get current license used, server
        $sql = "select sum(c.used)
                    from c_parentapplicense as c
                             inner join c_sitedeployment_c_parentapplicense_1_c cs on cs.c_sitedeployment_c_parentapplicense_1c_parentapplicense_idb = c.id and cs.deleted = 0
                             inner join c_sitedeployment s on cs.c_sitedeployment_c_parentapplicense_1c_sitedeployment_ida = s.id and s.deleted = 0
                    where c.deleted = 0 and s.name='{$args['domain']}'";
        $used = (int)$GLOBALS['db']->getOne($sql);

        //get current active license, server
        $nowDate = date("Y-m-d");
        $sql = "select c.id,c.total,c.used,c .package
                    from c_parentapplicense as c
                             inner join c_sitedeployment_c_parentapplicense_1_c cs on cs.c_sitedeployment_c_parentapplicense_1c_parentapplicense_idb = c.id and cs.deleted = 0
                             inner join c_sitedeployment s on cs.c_sitedeployment_c_parentapplicense_1c_sitedeployment_ida = s.id and s.deleted = 0
                    where c.deleted = 0
                      and c.expired >= '{$nowDate}'
                        and s.name='{$args['domain']}'
                    order by expired";
        $result = $GLOBALS['db']->query($sql);
        $licenses = array();
        while ($row = $GLOBALS['db']->fetchByAssoc($result)) {
            $licenses[$row['id']] = $row;
        }

        if ($current > $used) {
            $add = $current - $used;
            //customer difference server
            //update server follow to customer
            foreach ($licenses as $license) {
                $free = (int)$license['total'] - (int)$license['used'];
                if ($free > 0) {
                    if ($free >= $add) {
                        $tmp = $license['used'] + $add;
                        $GLOBALS['db']->query("update c_parentapplicense set used={$tmp} where id='{$license['id']}'");
                        break;
                    } else {
                        $GLOBALS['db']->query("update c_parentapplicense set used=total where id='{$license['id']}'");
                        $add = $add - $free;
                    }
                }
            }
        } elseif ($current < $used) {
            //get current active license, server
            $nowDate = date("Y-m-d");
            $sql = "select c.id, c.total, c.used, c.package
                    from c_parentapplicense as c
                             inner join c_sitedeployment_c_parentapplicense_1_c cs on cs.c_sitedeployment_c_parentapplicense_1c_parentapplicense_idb = c.id and cs.deleted = 0
                             inner join c_sitedeployment s on cs.c_sitedeployment_c_parentapplicense_1c_sitedeployment_ida = s.id and s.deleted = 0
                    where c.deleted = 0
                      and c.expired >= '{$nowDate}'
                        and s.name='{$args['domain']}'
                    order by expired DESC";
            $result = $GLOBALS['db']->query($sql);
            $licenses = array();
            while ($row = $GLOBALS['db']->fetchByAssoc($result)) {
                $licenses[$row['id']] = $row;
            }

            $sub = $used - $current;
            //customer difference server
            //update server follow to customer
            foreach ($licenses as $license) {
                if ((int)$license['used'] >= $sub) {
                    $tmp = (int)$license['used'] - $sub;
                    $GLOBALS['db']->query("update c_parentapplicense set used={$tmp} where id='{$license['id']}'");
                    break;
                } else {
                    $GLOBALS['db']->query("update c_parentapplicense set used=0 where id='{$license['id']}'");
                    $sub = $sub - (int)$license['used'];
                }
            }
        }
        ////////////===============================================================================
        $sql = "select c.id,c.total,c.expired,c.used,c.package
                    from c_parentapplicense as c
                             inner join c_sitedeployment_c_parentapplicense_1_c cs on cs.c_sitedeployment_c_parentapplicense_1c_parentapplicense_idb = c.id and cs.deleted = 0
                             inner join c_sitedeployment s on cs.c_sitedeployment_c_parentapplicense_1c_sitedeployment_ida = s.id and s.deleted = 0
                    where c.deleted = 0 and s.name='{$args['domain']}'
                    order by expired";
        $result = $GLOBALS['db']->query($sql);
        $licenses = array();
        while ($row = $GLOBALS['db']->fetchByAssoc($result)) {
            if (strtotime($row['expired']) < time()) {
                $row['status'] = 'Expired';
            } else {
                $row['status'] = 'Active';
            }
            $licenses[$row['id']] = $row;
        }
        return $licenses;
    }

    function reCheckAppLicense(ServiceBase $api, array $args)
    {
        //get current real used, customer
        $current = $this->callApi('GET', $args['protocol'] . '://' . $args['domain'] . '/rest/v11_3/adminconfig/get_app_license');
        $current = json_decode($current, 1);
        $current = (int)$current['app_license'];

        //get current license used, server
        $sql = "select sum(c.used)
                    from c_parentapplicense as c
                             inner join c_sitedeployment_c_parentapplicense_1_c cs on cs.c_sitedeployment_c_parentapplicense_1c_parentapplicense_idb = c.id and cs.deleted = 0
                             inner join c_sitedeployment s on cs.c_sitedeployment_c_parentapplicense_1c_sitedeployment_ida = s.id and s.deleted = 0
                    where c.deleted = 0 and s.name='{$args['domain']}'";
        $used = (int)$GLOBALS['db']->getOne($sql);

        //get current active license, server
        $nowDate = date("Y-m-d");
        $sql = "select c.id,c.total,c.used
                    from c_parentapplicense as c
                             inner join c_sitedeployment_c_parentapplicense_1_c cs on cs.c_sitedeployment_c_parentapplicense_1c_parentapplicense_idb = c.id and cs.deleted = 0
                             inner join c_sitedeployment s on cs.c_sitedeployment_c_parentapplicense_1c_sitedeployment_ida = s.id and s.deleted = 0
                    where c.deleted = 0
                      and c.expired >= '{$nowDate}'
                        and s.name='{$args['domain']}'
                    order by expired";
        $result = $GLOBALS['db']->query($sql);
        $licenses = array();
        while ($row = $GLOBALS['db']->fetchByAssoc($result)) {
            $licenses[$row['id']] = $row;
        }

        if ($current > $used) {
            $add = $current - $used;
            //customer difference server
            //update server follow to customer
            foreach ($licenses as $license) {
                $free = (int)$license['total'] - (int)$license['used'];
                if ($free > 0) {
                    if ($free >= $add) {
                        $tmp = $license['used'] + $add;
                        $GLOBALS['db']->query("update c_parentapplicense set used={$tmp} where id='{$license['id']}'");
                        break;
                    } else {
                        $GLOBALS['db']->query("update c_parentapplicense set used=total where id='{$license['id']}'");
                        $add = $add - $free;
                    }
                }
            }
        }
        return array('success' => 1);
    }

    function capLeadAPI(ServiceBase $api, array $args)
    {
        $user = BeanFactory::getBean('Users', '1');
        $GLOBALS['current_user'] = $user;
        //get Team Id
        $teamId = $GLOBALS['db']->getOne("SELECT id FROM teams WHERE description LIKE '%{$args['center']}%' AND private = 0 AND deleted = 0 LIMIT 1");
        $args['team_id'] = $teamId;
        if (empty($args['team_id'])) $args['team_id'] = 1;


        //get Create By
        $mkt_user = $args['utm_agent'];
        if (empty($mkt_user)) {
            $exploded = explode('_', $args['utm_campaign']);
            $mkt_user = end($exploded);
        }

        $args['mkt_user'] = '1';
        $args['api_user_id'] = '1';
        if (!empty($mkt_user)) $args['mkt_user'] = $GLOBALS['db']->getOne("SELECT id FROM users WHERE user_name = '$mkt_user'");
        if (!empty($args['api_user'])) $args['api_user_id'] = $GLOBALS['db']->getOne("SELECT id FROM users WHERE user_name = '{$args['api_user']}'");

        //if(!empty($args['created_by'])) $args['campaign_name'] = str_replace('_'.$created_by, '',$args['campaign_name']);

        //Check campaign_name
        $args['utm_campaign'] = !empty($args['utm_campaign']) && $args['utm_campaign'] != 'null' ? $args['utm_campaign'] : 'Natural';
        if (!empty($args['utm_campaign'])) {
            $args['campaign_id'] = $GLOBALS['db']->getOne("SELECT DISTINCT IFNULL(campaigns.id, '') primaryid FROM campaigns WHERE (campaigns.name LIKE '%{$args['utm_campaign']}%') AND campaigns.deleted = 0");
            if (!$args['campaign_id']) {
                $cam = new Campaign();
                $cam->name = $args['utm_campaign'];
                $cam->team_id = $args['team_id'];
                $cam->team_set_id = $args['team_id'];
                $cam->save();
                $args['campaign_id'] = $cam->id;
            }
        }
        $lead = new Lead();
        $lead->first_name = $args['first_name'];
        $lead->last_name = $args['last_name'];
        $lead->email1 = $args['email'];
        $lead->phone_mobile = $args['phone_mobile'];
        $lead->utm_source = $args['web_source'];
        $lead->lead_source = !empty($args['utm_source']) && $args['utm_source'] != 'null' ? $args['utm_source'] : 'Web Site';
        $lead->campaign_id = $args['campaign_id'];
        $lead->description = $args['description'];
        $lead->website = $args['website'];
        $lead->account_name = $args['account_name'];
        $lead->save();
        return array('success' => 1);
    }
}
