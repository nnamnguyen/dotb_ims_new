<?php

class BalanceApi extends DotbApi
{
    function registerApiRest()
    {
        return array(
            'get_balance' => array(
                'reqType' => 'POST',
                'path' => array('balance', 'getBalance'),
                'pathVars' => array(),
                'method' => 'getListBalance'
            ),
            'void_balance_quote' => array(
                'reqType' => 'POST',
                'path' => array('void', 'balanceQuote'),
                'pathVars' => array(),
                'method' => 'voidBalanceQuote'
            ),
        );

    }
    /**
     * @param ServiceBase $api
     * @param array $args : dotb_ext, dotb_phone, dotb_call_status,dotb_direction
     * @return |null
     */

   public function getListBalance(ServiceBase $api, array $args){
       $sql ='';
       $sql .="SELECT DISTINCT 
            IFNULL(j_balance.id,'') balance_id ,
            IFNULL(j_balance.name,'') balance_name ,
            IFNULL(j_balance.type,'') balance_type,
            IFNULL(j_balance.use_type,'') balance_use_type,
            j_balance.total_amount total_amount , 
            j_balance.remain_amount remain_amount , 
            j_balance.total_quantity total_quantity,
            j_balance.remain_quantity remain_quantity,
            j_balance.limit_quantity limit_quantity,
            IFNULL(pt.name,'') product_name ,
            IFNULL(u.name,'') unit_name,
            p.total_amount product_total_amount, 
            j_balance.total_quantity - j_balance.remain_quantity - j_balance.limit_quantity as use_remain
            FROM j_balance 
            LEFT JOIN products p
            ON p.id = j_balance.product_id AND p.deleted =0
            LEFT JOIN product_templates pt
            ON pt.id = p.product_template_id AND pt.deleted =0
            LEFT JOIN j_groupunit gu 
            ON gu.id = pt.group_unit_id AND gu.deleted=0
            LEFT JOIN j_unit u 
            ON u.group_unit_id = gu.id AND u.deleted=0 AND is_primary =1 
            WHERE (((IFNULL(j_balance.type,'') IN ('Deposit','Transfer in','Cashholder','Moving in','Delay') )))";
            if(!empty($args['use_type']))
                $sql.="AND j_balance.use_type ='{$args['use_type']}'";

            $sql.="AND j_balance.deleted=0
            AND parent_id = '{$args['student_id']}'
            AND (j_balance.remain_amount > 0 OR(j_balance.remain_quantity >0 AND j_balance.limit_quantity >0))
            AND j_balance.team_id = '{$args['team_id']}'
            HAVING 
            CASE WHEN balance_use_type = 'Amount' THEN remain_amount > 0
            ELSE use_remain < 0 END";

       $data = '';
       $result = $GLOBALS['db']->query($sql);
       $count =0;
       while($row = $GLOBALS['db']->fetchByAssoc($result))
       {
           if($row['balance_use_type'] == 'Amount')
               $money = $row['remain_amount'];
           else {
               $use_remain = $row['limit_quantity'] - ($row['total_quantity'] - $row['remain_quantity']);
               $money = ($row['product_total_amount'] / $row['total_quantity']) * $use_remain;
           }
           $count++;
           $data .= "<tr>
             <td  style='text-align: center;'><input class='list_balance' name='list_balance[]' type='checkbox' data-money= '{$money}' data-value='{$row['balance_id']}'/></td>
             <td  style='text-align: center;'><a href='#J_Balance/{$row['balance_id']}'>{$row['balance_name']}</a></td>
             <td  style='text-align: center;'>{$row['product_name']}</td>
             <td  style='text-align: center;'>{$row['balance_type']}</td>
             <td  style='text-align: center;'>{$row['balance_use_type']}</td>
             <td  style='text-align: center;'>{$row['unit_name']}</td>
             <td  style='text-align: center;'>".number_format($row['total_amount'],2,'.',',')."</td>
             <td  style='text-align: center;'>".number_format($row['remain_amount'],2,'.',',')."</td>
             <td  style='text-align: center;'>{$row['total_quantity']}</td>
             <td  style='text-align: center;'>{$row['remain_quantity']}</td>
             <td  style='text-align: center;'>{$row['limit_quantity']}</td>
         </tr>";
       }
       if($count == 0)
           $data.='<tr><td colspan="11" style="text-align: center;">No Balance</td></tr>';

       return array(
           'success' => 1,
           'data' => $data,
       );
   }

   function voidBalanceQuote(ServiceBase $api, array $args){
       require_once ('custom/modules/J_Payment/balance_function_untils.php');
       voidBalanceFromQuote($args['quote_id'],$args['model']['id']);
//       $model = $args['model'];
//       $quote = BeanFactory::getBean('Quotes',$args['quote_id']);
//       $quote->use_free_balance = $quote->use_free_balance - $model['total_amount_relata_balance'];
//       $quote->unpaid_amount = $quote->unpaid_amount + $model['total_amount_relata_balance'];
//       $quote->save();
//
//       $balance = BeanFactory::getBean('J_Balance',$model['id']);
//       $balance->remain_amount = $balance->remain_amount + $model['total_amount_relata_balance'];
//       $balance->save();
//       $GLOBALS['db']->query("UPDATE j_balance_quotes_1_c SET deleted=1,date_modified ='{$GLOBALS['timedate']->nowDb()}' WHERE j_balance_quotes_1j_balance_ida ='{$model['id']}' AND j_balance_quotes_1quotes_idb ='{$quote->id}'");
       return array(
           'success' => 1,
       );
   }

}