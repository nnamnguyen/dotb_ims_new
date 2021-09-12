<?php

class SiteDeploymentApi extends DotbApi
{
    function registerApiRest()
    {
        return array(
            'add_balance_to_site' => array(
                'reqType' => 'POST',
                'path' => array('add', 'balanceToSite'),
                'pathVars' => array(),
                'method' => 'addBalanceToSite'
            ),
        );

    }
    /**
     * @param ServiceBase $api
     * @param array $args : dotb_ext, dotb_phone, dotb_call_status,dotb_direction
     * @return |null
     */

    public function addBalanceToSite(ServiceBase $api, array $args){
        global $timedate;
        foreach($args['balance'] as $payment){
            $payment_bean = BeanFactory::getBean('J_Payment',$payment['id']);
            $quantity = (int)$payment_bean->remain_quantity;
            $payment_bean->site_id = $args['site_id'];
            $payment_bean->date_active = $timedate->nowDate();
            $payment_bean->payment_expired = date('Y-m-d',strtotime("+{$quantity} months ".$payment_bean->date_active));
            $payment_bean->save();
        }

    }


}