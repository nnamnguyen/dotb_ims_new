<?php

class C_SiteDeploymentApiHelper extends DotbBeanApiHelper
{
    public function populateFromApi(DotbBean $bean, array $submittedData, array $options = array())
    {
        require_once 'custom/include/httpsocket.php';
        $data = parent::populateFromApi($bean, $submittedData, $options);
//        if (empty($bean->fetched_row) || $bean->name != $bean->fetched_row['name']) {
//            $sock = new HTTPSocket;
//            $sock->connect('crm.server.dotb.cloud', 2222);
//            $sock->set_login("cloud", "28H8L6v6");
//            $sock->set_method('POST');
//            $sock->query('/CMD_API_SHOW_DOMAINS');
//            $domains = array();
//            $res = $sock->fetch_body();
//            $res = explode('&', $res);
//            foreach ($res as $r)
//                if (preg_match('/list\[\]\=(.+)/', $r, $m))
//                    $domains[] = $m[1];
//            if (in_array($bean->name, $domains)) throw new DotbApiExceptionMissingParameter('Domains already exist!');
//        }
        return $data;
    }
}
