<?php

class logicSiteDeployment
{
    function listViewColor(&$bean, $event, $arguments)
    {
        global $timedate;
        $date1 = new DateTime($timedate->nowDbDate());  //current date or any date
        $date2 = new DateTime($bean->date_expired);   //Future date
        $diff = $date2->diff($date1)->format("%a");  //find difference
        $days = intval($diff);   //rounding days
        if ($days <= 0) {
            $days = 0;
            $color = "#FF0000";
        } elseif ($days <= 10)
            $color = "#FF4500";
        else
            $color = "#228B22";

        $bean->lic_remain = "<span style='font-weight:bold; color:$color'>$days</span>";


    }

//    function randomPassword($len = 8)
//    {
//        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
//        $pass = array();
//        $alphaLength = strlen($alphabet) - 1;
//        for ($i = 0; $i < $len; $i++) {
//            $n = rand(0, $alphaLength);
//            $pass[] = $alphabet[$n];
//        }
//        return implode($pass);
//    }

    function handleAfterSave(&$bean, $event, $arguments)
    {

    }


    function handleBeforeSave(&$bean, $event, $arguments)
    {
//        if ($_SERVER["REMOTE_ADDR"] == '::1' && $_SERVER["REMOTE_ADDR"] == '127.0.0.1' && $_SERVER["REMOTE_ADDR"] == 'localhost') {
//
//        } else {
//            require_once 'custom/include/httpsocket.php';
//
//            //Tạo mới
//            if (empty($bean->fetched_row)) {
//
//                //create domains and database
//                $sock = new HTTPSocket;
//                $sock->connect('18.139.26.207', 2222);
//                $sock->set_login('cloud', '{/T#9;ni4$fW#.7mEZ%*tjC}Yta(S2');
//                $sock->set_method('POST');
//
//                //domain
//                $sock->query('/CMD_DOMAIN', array(
//                    'action' => 'create',
//                    'domain' => $bean->name,
//                    'ubandwidth' => 'unlimited',
//                    'uquota' => 'unlimited',
//                    'ssl' => 'ON',
//                    'cgi' => 'ON',
//                    'php' => 'ON',
//                    'create' => 'Create'
//                ));
//
//                //cronjob
//                $sock->query('/CMD_API_CRON_JOBS', array(
//                    'action' => 'create',
//                    'minute' => '*',
//                    'hour' => '*',
//                    'dayofmonth' => '*',
//                    'month' => '*',
//                    'dayofweek' => '*',
//                    'command' => 'cd /home/cloud/domains/' . $bean->name . '/public_html; php -f cron.php > /dev/null 2>&1'
//                ));
//                $sock->query('/CMD_API_CRON_JOBS', array(
//                    'action' => 'create',
//                    'minute' => ((int)$GLOBALS['db']->getOne("SELECT count(id) FROM c_sitedeployment where deleted=0")) % 60,
//                    'hour' => '2',
//                    'dayofmonth' => '*',
//                    'month' => '*',
//                    'dayofweek' => '*',
//                    'command' => 'cd /home/cloud/domains/' . $bean->name . '/public_html; git add .;git -c user.email="toan.tran@dotb.vn" -c user.name="TKT" commit -m "✌️★★AUTO COMMIT FROM SERVER★★";git push origin master;git pull;'
//                ));
//
//                //database
//                $bean->db_pass = $this->randomPassword(16);
//                $bean->db_name = explode('.', $bean->name);
//                $bean->db_name = substr($bean->db_name[0], 0, 5) . $this->randomPassword(2);
//                $sock->query('/CMD_API_DATABASES',
//                    array(
//                        'action' => 'create',
//                        'name' => $bean->db_name,
//                        'user' => $bean->db_name,
//                        'passwd' => $bean->db_pass,
//                        'passwd2' => $bean->db_pass
//                    ));
//                $sock->query('/CMD_API_DATABASES',
//                    array(
//                        'action' => 'accesshosts',
//                        'db' => $bean->db_name,
//                        'user' => $bean->db_name,
//                        'create' => 'yes',
//                        'host' => '%'
//                    ));
//                $bean->db_name = 'cloud_' . $bean->db_name;
//
//
//                $bean->git_url = preg_replace('/https:\/\/(.+)@bitbucket/', 'https://bitbucket', $bean->git_url);
//                $gitURL = preg_replace('/https:\/\//', 'https://trankhanhtoan:tktNTBU25041996@', $bean->git_url);
//                preg_match('/\/([^\/\.]+)\.git$/', $gitURL, $match);
//                $gitRepo = $match[1];
//                $unikey = md5(time());
//                shell_exec('sshpass -p "{/T#9;ni4$fW#.7mEZ%*tjC}Yta(S2" ssh -o StrictHostKeyChecking=no cloud@18.139.26.207 "cd /home/cloud/domains/' . $bean->name . ';git clone ' . $gitURL . ';rm -rf public_html;mv ' . $gitRepo . ' public_html;chmod -R 777 public_html;cd public_html;git config core.fileMode false;mysql -u ' . $bean->db_name . ' --password=' . $bean->db_pass . ' ' . $bean->db_name . ' < deployment_config/db_edu.sql;mv deployment_config/config.php config.php;' . "sed -i 's/dbdbdbusername/{$bean->db_name}/g' config.php;sed -i 's/dbdbdbdbname/{$bean->db_name}/g' config.php;sed -i 's/uniquekeydotbdotbdotb/{$unikey}/g' config.php;sed -i 's/dbdbdbpassword/{$bean->db_pass}/g' config.php;sed -i 's/dbdbdbsite/{$bean->name}/g' config.php;cd ../;chmod -R 777 pulblic_html" . '"');
//
//                //license
//                require_once 'custom/include/KTEncrypt.php';
//                $kt = new KTEncrypt();
//                $t = $kt->encode(serialize(array(
//                    'users' => $bean->lic_users,
//                    'teams' => $bean->lic_teams,
//                    'students' => $bean->lic_students,
//                    'storage' => $bean->lic_storages,
//                    'package' => $bean->lic_type,
//                    'date_expired' => $bean->date_expired,
//                    'date_update' => date("Y-m-d H:i:s")
//                )), 'r>((5\tg&z/2y5y#\;');
//                unlink('cache/license.key');
//                file_put_contents('cache/license.key', $t);
//                shell_exec('sshpass -p "28H8L6v6" ssh -o StrictHostKeyChecking=no cloud@crm.server.dotb.cloud "cd /home/cloud/domains/' . $bean->name . '/public_html;rm -f license.key;curl -o license.key https://ims.dotb.cloud/cache/license.key"');
//            } else {
//                if ($bean->name != $bean->fetched_row['name']) {
//                    //change domain
//                    $sock = new HTTPSocket;
//                    $sock->connect('crm.server.dotb.cloud', 2222);
//                    $sock->set_login("cloud", "28H8L6v6");
//                    $sock->set_method('POST');
//                    $sock->query('/CMD_CHANGE_DOMAIN', array(
//                        'old_domain' => $bean->fetched_row['name'],
//                        'new_domain' => $bean->name
//                    ));
//                }
//                if ($bean->date_expired != $bean->fetched_row['date_expired']
//                    || $bean->lic_users != $bean->fetched_row['lic_users']
//                    || $bean->lic_teams != $bean->fetched_row['lic_teams']
//                    || $bean->lic_students != $bean->fetched_row['lic_students']
//                    || $bean->lic_type != $bean->fetched_row['lic_type']
//                    || $bean->lic_storages != $bean->fetched_row['lic_storages']) {
//                    //license
//                    require_once 'custom/include/KTEncrypt.php';
//                    $kt = new KTEncrypt();
//                    $t = $kt->encode(serialize(array(
//                        'users' => $bean->lic_users,
//                        'teams' => $bean->lic_teams,
//                        'students' => $bean->lic_students,
//                        'storage' => $bean->lic_storages,
//                        'package' => $bean->lic_type,
//                        'date_expired' => $bean->date_expired,
//                        'date_update' => date("Y-m-d H:i:s")
//                    )), 'r>((5\tg&z/2y5y#\;');
//                    unlink('cache/license.key');
//                    file_put_contents('cache/license.key', $t);
//                    shell_exec('sshpass -p "28H8L6v6" ssh -o StrictHostKeyChecking=no cloud@crm.server.dotb.cloud "cd /home/cloud/domains/' . $bean->name . '/public_html;rm -f license.key;curl -o license.key https://ims.dotb.cloud/cache/license.key"');
//                }
//            }
//        }
        if (empty($bean->fetched_row) || ($bean->date_expired != $bean->fetched_row['date_expired']
                || $bean->lic_users != $bean->fetched_row['lic_users']
                || $bean->lic_teams != $bean->fetched_row['lic_teams']
                || $bean->lic_students != $bean->fetched_row['lic_students']
                || $bean->lic_type != $bean->fetched_row['lic_type']
                || $bean->lic_storages != $bean->fetched_row['lic_storages'])) {
            $this->setLicenseForDomain($bean->name, $bean->lic_users, $bean->lic_teams, $bean->lic_students, $bean->lic_storages, $bean->lic_type, $bean->date_expired);
        }
    }

    function setLicenseForDomain($domain, $lic_users, $lic_teams, $lic_students, $lic_storages, $lic_type, $date_expired)
    {
        require_once 'custom/include/KTEncrypt.php';
        $kt = new KTEncrypt();
        $t = $kt->encode(serialize(array(
            'users' => $lic_users,
            'teams' => $lic_teams,
            'students' => $lic_students,
            'storage' => $lic_storages,
            'package' => $lic_type,
            'date_expired' => $date_expired,
            'date_update' => date("Y-m-d H:i:s")
        )), 'r>((5\tg&z/2y5y#\;');
        file_put_contents("/home/cloud/domains/{$domain}/public_html/license.key", $t);
    }
}
