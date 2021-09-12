<?php

class QuoteApi extends DotbApi
{
    function registerApiRest()
    {
        return array(
            'use_free_balance' => array(
                'reqType' => 'POST',
                'path' => array('use', 'freeBalance'),
                'pathVars' => array(),
                'method' => 'useFreeBalance'
            ),
            'get_loyalty' => array(
                'reqType' => 'POST',
                'path' => array('get', 'loyalty'),
                'pathVars' => array(),
                'method' => 'getLoyalty'
            ),
            'check_sponsor' => array(
                'reqType' => 'POST',
                'path' => array('check', 'sponsor'),
                'pathVars' => array(),
                'method' => 'checkSponsor',
            ),
        );
    }
    /**
     * @param ServiceBase $api
     * @param array $args : dotb_ext, dotb_phone, dotb_call_status,dotb_direction
     * @return |null
     */

    public function useFreeBalance(ServiceBase $api, array $args){
        // get List balance of student
        $model = $args['model'];
        $sql ="Select j_payment.id id, remain_amount from j_payment 
                where j_payment.deleted =0 
                and use_type = 'Amount' 
                and remain_amount > 0 
                and parent_id ='{$model['parent_id']}' 
                and j_payment.team_id = '{$model['team_name'][0]['id']}' 
                ORDER BY remain_amount";
        $list_balance_id = $GLOBALS['db']->fetchArray($sql);
        $unpaid = $args['model']['unpaid_amount'];
        foreach($list_balance_id as $balance_id){
            $balance = BeanFactory::getBean('J_Payment',$balance_id['id']);
            $sum_amount = $GLOBALS['db']->getOne("SELECT IFNULL(use_amount,0) FROM quotes_j_payment_1_c where deleted =0 AND quotes_j_payment_1j_payment_idb ='{$balance_id['id']}' AND quotes_j_payment_1quotes_ida='{$model['id']}'");
            if($unpaid > 0) {
                if ($balance->remain_amount < $unpaid) {
                    $unpaid = $unpaid -$balance->remain_amount;
                    if ($balance->load_relationship('quotes_j_payment_1'))
                        $balance->quotes_j_payment_1->add($model['id'], array(
                            'use_amount' => $balance->remain_amount + $sum_amount,
                        ));
                    $balance->remain_amount = 0;

                }
                else{
                    $balance->remain_amount = $balance->remain_amount - $unpaid;
                    if ($balance->load_relationship('quotes_j_payment_1'))
                        $balance->quotes_j_payment_1->add($model['id'], array(
                            'use_amount' => $unpaid + $sum_amount,
                        ));
                    $unpaid =0;
                }
                $balance->save();
            }
            else{
                break;
            }
        }
        $quote = BeanFactory::getBean('Quotes',$model['id']);
        $quote->unpaid_amount = $unpaid;
        if($model['unpaid_amount'] > $model['total_balance_parent'])
            $quote->use_free_balance = $quote->use_free_balance + $model['total_balance_parent'];
        else
            $quote->use_free_balance = $quote->use_free_balance + $model['unpaid_amount'];
        $quote->save();
        return array(
            'success' => 1,
            'data' => [],
        );
    }

    function getLoyalty(ServiceBase $api, array $args){
        global  $timedate, $current_team_id;
        require_once('custom/include/_helper/junior_revenue_utils.php');
        //Get loyalty Point
        $loyalty    = getLoyaltyPoint($args['id'],$args['quote_id']);
        $year       = '';
        if(!empty($payment_date))
            $year   = date('Y',strtotime($timedate->convertToDBDate($payment_date, false)));
        $loyalty_rate = getLoyaltyRateOut($loyalty['level'], $current_team_id, $year);
        $accrual_rate = $GLOBALS['app_list_strings']['default_loyalty_rate']['Accrual Rate ('.$loyalty['level'].')'];
        //END: Get loyalty Point
        return array(
            'success' => 1,
            'data' => [
                'loyalty' => $loyalty,
                'loyalty_rate' => $loyalty_rate,
                'accrual_rate' => $accrual_rate,
            ],
        );
    }

    function checkSponsor(ServiceBase $api, array $args){
        global $timedate,$app_list_strings;
        $today = $timedate->nowDbDate();
        $code = $args['code'];
        $team_id = $args['team_id'];
        $row = $GLOBALS['db']->fetchOne("SELECT * FROM j_voucher WHERE deleted=0 AND name='{$code}' AND (team_id='{$team_id}' OR team_id='1')");
        if(empty($row))
            return array(
                'success' => 0,
            );
        else{

            $status = $row['status'];
            if($row['use_time'] != 'N' && $row['used_time'] >= $row['use_time'])
                $status = 'Expired';

            if( ($row['end_date'] != 'N/A') && !empty($row['end_date']) && ($today > $row['end_date']) )
                $status = 'Expired';

            if($status != $row['status'] && $row['type'] == 'Sponsor'){
                $row['status'] = $status;
                $GLOBALS['db']->query("UPDATE j_voucher SET status='$status' WHERE id = '{$row['voucher_id']}'");
            }

            if($status == 'Expired' || $status == 'Inactive' ) $color = 'red';
            else $color = 'green';


            //Update Used !
            if ($row['voucher_used_time'] != $row['used_time'] && $row['type'] == 'Sponsor')
                $GLOBALS['db']->query("UPDATE j_voucher SET used_time={$row['used_time']} WHERE id = '{$row['voucher_id']}'");

            return array(
                "success" => "1",
                "id"        => $row['id'],
                "voucher_code"      => $row['voucher_code'],
                "sponsor_number"    => $row['name'],
                "loyalty_points"    => $row['loyalty_points'],
                "foc_type"          => $row['foc_type'],
                "status_color"      => '<br>Status: <b style="color:'.$color.';"> '. $app_list_strings['voucher_status_dom'][$status].'</b>',
                "status"            => $status,
                "type"              => $row['type'],
                "used_time"         => $row['used_time'].' / '.$row['use_time'],
                "discount_amount"   => $row['discount_amount'],
                "discount_percent"  => $row['discount_percent'],
                "description"       => $row['description'],
                "start_date"        => $row['start_date'],
                "end_date"          => $row['end_date'],
            );
        }
    }

}