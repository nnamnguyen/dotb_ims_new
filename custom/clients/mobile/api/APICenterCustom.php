<?php

class APICenterCustom extends DotbApi
{
    function registerApiRest()
    {
        return array(
            'apicenter_createlead' => array(
                'reqType' => 'POST',
                'path' => array('apicenter_createlead'),
                'pathVars' => array(),
                'method' => 'createLead',
                'noLoginRequired' => true,
            ),

        );

    }

    function createLead(ServiceBase $api, array $args)
    {
        $GLOBALS['current_user'] = BeanFactory::getBean('Users','1');
        $bean = BeanFactory::newBean('Leads');
        $bean->disable_row_level_security = true;
        $bean->first_name = $args['first_name'];
        $bean->last_name = $args['last_name'];
        $bean->description = $args['description'];
        $bean->account_name = $args['account_name'];
        $bean->phone_mobile = $args['phone_mobile'];
        $bean->website = $args['website'];
        $bean->email1 = $args['email'];
        $bean->lead_source = $args['lead_source'];
        $bean->utm_source = $args['utm_source'];
        $bean->save();
        return array('success' => 1);
    }


}