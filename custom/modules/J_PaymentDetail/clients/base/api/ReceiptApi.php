<?php

class ReceiptApi extends DotbApi
{
    function registerApiRest()
    {
        return array(
            'void_receipt' => array(
                'reqType' => 'PUT',
                'path' => array('receipt', 'void'),
                'pathVars' => array(),
                'method' => 'voidReceipt'
            ),
        );
    }
    /**
     * @param ServiceBase $api
     * @param array $args : dotb_ext, dotb_phone, dotb_call_status,dotb_direction
     * @return |null
     */

   function voidReceipt(ServiceBase $api, array $args){
       $mod_strings = return_module_language('vi_vi','J_PaymentDetail');
       $bean = BeanFactory::getBean('J_PaymentDetail',$args['id']);
       $list_balance = $GLOBALS['db']->query("SELECT id,total_hours,remain_hours FROM j_payment where deleted=0 and order_id='{$bean->quote_id}'");
       foreach($list_balance as $balance){
           if($balance['remain_hours'] < $balance['total_hours']){
               return array(
                   "success" => 3,
                   "notification" => $mod_strings['LBL_CAN_NOT_VOID_RECEIPT']
               );
           }
       }
       if( $bean->status == 'Cancelled')
       {
           return array(
               "success" => 2,
           );
       }
       else {
           $bean->status = 'Cancelled';
           $bean->save();
           return array(
               "success" => 1
           );
       }
   }
}