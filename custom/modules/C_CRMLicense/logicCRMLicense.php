<?php

class logicCRMLicense
{
    function handleBeforeSave(&$bean, $event, $arguments)
    {
        //set name
        if (empty($bean->name)) {
            $site = BeanFactory::getBean('C_SiteDeployment', $bean->c_sitedeployment_c_crmlicense_1c_sitedeployment_ida);
            $siteName = explode('.', $site->name);
            $count = $GLOBALS['db']->getOne("select count(c.id) 
                                                                        from c_crmlicense as c
                                                                            inner join c_sitedeployment_c_crmlicense_1_c as cs 
                                                                                on c.id=cs.c_sitedeployment_c_crmlicense_1c_crmlicense_idb
                                                                        where cs.c_sitedeployment_c_crmlicense_1c_sitedeployment_ida='{$site->id}'
                                                                                ");
            $count = ((int)$count + 1);
            if ($count < 10) $count = '00' . $count;
            elseif ($count < 100) $count = '0' . $count;
            $bean->name = strtoupper($siteName[0]) . $count;
        }
    }

    function handleAfterSave($bean, $event, $arguments)
    {
        $this->updateSumaryLicense($bean->c_sitedeployment_c_crmlicense_1c_sitedeployment_ida);
    }

    function updateSumaryLicense($siteId)
    {
        $data = array(
            'user' => 0,
            'team' => 0,
            'storage' => 0,
            'type' => '',
            'date_start'=>date("Y-m-d"),
            'date_expired'=>date("Y-m-d")
        );

        $result = $GLOBALS['db']->query("select number_of_user,number_of_team,number_storage,license_type
                                                                    from c_crmlicense 
                                                                    where id in (select c_sitedeployment_c_crmlicense_1c_crmlicense_idb
                                                                                        from c_sitedeployment_c_crmlicense_1_c 
                                                                                        where c_sitedeployment_c_crmlicense_1c_sitedeployment_ida='{$siteId}' and deleted=0)
                                                                            and date_expired>=CURDATE() and deleted=0
                                                                    order by date_modified DESC");

        while ($row = $GLOBALS['db']->fetchByAssoc($result)) {
            if (empty($data['type'])) $data['type'] = $row['license_type'];
            $data['user'] += (int)$row['number_of_user'];
            $data['team'] += (int)$row['number_of_team'];
            $data['storage'] += (int)$row['number_storage'];
        }

        $data['date_start'] = $GLOBALS['db']->getOne("select min(date_start)
                                                                            from c_crmlicense 
                                                                            where id in (select c_sitedeployment_c_crmlicense_1c_crmlicense_idb
                                                                                                from c_sitedeployment_c_crmlicense_1_c 
                                                                                                where c_sitedeployment_c_crmlicense_1c_sitedeployment_ida='{$siteId}' and deleted=0)
                                                                                and deleted=0");
        $data['date_expired'] = $GLOBALS['db']->getOne("select max(date_expired)
                                                                            from c_crmlicense 
                                                                            where id in (select c_sitedeployment_c_crmlicense_1c_crmlicense_idb
                                                                                                from c_sitedeployment_c_crmlicense_1_c 
                                                                                                where c_sitedeployment_c_crmlicense_1c_sitedeployment_ida='{$siteId}' and deleted=0)
                                                                                and deleted=0");

        $GLOBALS['db']->query("update c_sitedeployment 
                                                    set lic_type='{$data['type']}', 
                                                            lic_users={$data['user']},
                                                            lic_teams={$data['team']},
                                                            lic_storages={$data['storage']},
                                                            date_start='{$data['date_start']}',
                                                            date_expired='{$data['date_expired']}'
                                                    where id='{$siteId}'");
    }

    function handleProcessRecord(&$bean, $event, $arguments)
    {
        if (empty($bean->date_expired)) $bean->status = 'Expired';
        elseif (strtotime($bean->date_expired . ' 23:59:59') < time()) $bean->status = 'Expired';
        else $bean->status = 'Active';
    }

    function handleAfterDelete(&$bean, $event, $arguments)
    {
        $this->updateSumaryLicense($bean->c_sitedeployment_c_crmlicense_1c_sitedeployment_ida);
    }
}
