<?php
if (!defined('dotbEntry') || !dotbEntry) die('Not A Valid Entry Point');

class logicC_ParentAppLicense
{
    public function handleProcessRecords(&$bean, $event, $arguments)
    {
        $expired = strtotime($bean->expired . ' 23:59:59');
        if ($expired > time()) {
            $bean->status = 'Active';
        } else {
            $bean->status = 'Expired';
        }
    }

    public function handleBeforeSave(&$bean, $event, $arguments)
    {
        //set name
        if (empty($bean->name)) {
            $site = BeanFactory::getBean('C_SiteDeployment', $bean->c_sitedeployment_c_parentapplicense_1c_sitedeployment_ida);
            $siteName = explode('.', $site->name);
            $count = $GLOBALS['db']->getOne("select count(c.id) 
                                                                        from c_parentapplicense as c
                                                                            inner join c_sitedeployment_c_parentapplicense_1_c as cs 
                                                                                on c.id=cs.c_sitedeployment_c_parentapplicense_1c_parentapplicense_idb
                                                                        where cs.c_sitedeployment_c_parentapplicense_1c_sitedeployment_ida='{$site->id}'
                                                                                ");
            $count = ((int)$count + 1);
            if ($count < 10) $count = '00' . $count;
            elseif ($count < 100) $count = '0' . $count;
            $bean->name = strtoupper($siteName[0]) . $count;
        }
    }
}
