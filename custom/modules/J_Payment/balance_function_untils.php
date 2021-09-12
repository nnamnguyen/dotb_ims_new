<?php

function createBalances($action = '', $type='', &$receipt='',$product_id ='',$quote =''){
    $_POST['module'] = 'Quotes';
    Switch($type){
        case 'Deposit':
            depositBalances($receipt,$action);
            break;
        case 'Cashholder':
            orderBalances($product_id,$quote,$action);
            break;
    }
}

function depositBalances(&$receipt = '',$action = ''){
    if($action == 'create'){
        $balance_bean = BeanFactory::newBean('J_Payment');
        $balance_bean->receipt_id = $receipt->id;
        $balance_bean->payment_type = 'Deposit';
        $balance_bean->payment_amount = $receipt->payment_amount;
        $balance_bean->remain_amount = $receipt->payment_amount;
        $balance_bean->amount_bef_discount = $receipt->payment_amount;
        $balance_bean->use_type = 'Amount';
        $balance_bean->assigned_user_id = $GLOBALS['current_user']->id;
        $balance_bean->parent_type = $receipt->parent_type;
        $balance_bean->parent_id= $receipt->parent_id;
        $balance_bean->contacts_j_payment_1contacts_ida = $receipt->parent_id;
        $balance_bean->payment_date = $receipt->payment_date;
        $balance_bean->status = 'Available';
        $balance_bean->save();
        $receipt->payment_id = $balance_bean->id;
    }

    else{
        if($receipt->payment_type == 'Deposit') {
            $balance_id = $GLOBALS['db']->getOne("SELECT id FROM j_payment WHERE deleted =0  AND receipt_id='{$receipt->id}'");
            $list_quote = $GLOBALS['db']->fetchArray("SELECT quotes_j_payment_1quotes_ida quote_id FROM quotes_j_payment_1_c WHERE quotes_j_payment_1j_payment_idb = '{$balance_id}'");
            foreach ($list_quote as $quote){
                voidBalanceFromQuote($quote['quote_id'], $balance_id);
            }
            $GLOBALS['db']->query("UPDATE j_payment SET deleted=1, date_modified='{$GLOBALS['timedate']->nowDb()}', modified_user_id='{$GLOBALS['current_user']->id}' WHERE receipt_id = '{$receipt->id}'");
            $receipt->payment_id ='';
        }
    }
}

function orderBalances($product_id ='',$quote ='',$action =''){
    $sql = "SELECT products.quantity,products.id product_id,
            u.id unit_id, 
            u.base_unit_id base_unit_id, 
            u.quantity_base_unit quantity_base_unit,
            pt.is_allocation is_allocation,
            pt.group_unit_id group_unit_id,
            products.subtotal subtotal,
            products.total_amount total_amount
            FROM products 
            INNER JOIN product_templates pt ON products.product_template_id = pt.id AND pt.deleted =0
            INNER  JOIN j_unit u ON products.unit_id = u.id AND u.deleted = 0
            WHERE products.deleted = 0 AND products.id = '{$product_id}'";
    $result = $GLOBALS['db']->fetchArray($sql)[0];
    $result['total_discount'] = $quote->order_discount_amount + $quote->order_sponsor_amount + $quote->order_loyalty_amount;
    $result['quote_total']    = $quote->new_sub;
    if($result['is_allocation']) {
        if($action != 'delete'){
            $_REQUEST['module'] = 'Quotes';
            $sql1 = "SELECT id FROM j_unit WHERE deleted =0 AND is_primary = 1 AND group_unit_id = '{$result['group_unit_id']}'";
            $unit_id = $GLOBALS['db']->getOne($sql1);
            if ($action == 'create')
                $balance_bean = BeanFactory::newBean('J_Payment');
            else {
                $balance_id = $GLOBALS['db']->getOne("SELECT id FROM j_payment WHERE deleted=0 AND order_id = '{$quote->id}' AND product_id ='{$product_id}'");
                $balance_bean = BeanFactory::getBean('J_Payment', $balance_id);
            }
            $balance_bean->payment_type = 'Cashholder';
            $balance_bean->use_type = 'Unit';
//            if ($action == 'create')
                $balance_bean->parent_type = $quote->parent_type;
            $balance_bean->parent_id = $quote->parent_id;
            $balance_bean->contacts_j_payment_1contacts_ida = $quote->parent_id;
            $balance_bean->total_quantity = $result['quantity'] * $result['quantity_base_unit'];
            $balance_bean->remain_quantity = $balance_bean->total_quantity;
            $balance_bean->unit_id = $unit_id;
            $balance_bean->order_id = $quote->id;
            $balance_bean->assigned_user_id = $GLOBALS['current_user']->id;
            $balance_bean->product_id = $result['product_id'];
            $balance_bean->amount_bef_discount = $result['subtotal'];
            $discount_product = ($result['total_amount']*$result['total_discount'])/$result['quote_total'];
            $balance_bean->payment_amount = $result['total_amount']-$discount_product;
            $balance_bean->remain_amount = $balance_bean->payment_amount;
            $balance_bean->discount_amount = $balance_bean->amount_bef_discount - $balance_bean->payment_amount;
            if($quote->quote_stage == 'Closed won')
                $balance_bean->status = 'Available';
            else
                $balance_bean->status = 'Draft';
            $balance_bean->save();
        }
        else{
            $GLOBALS['db']->query("UPDATE j_payment SET deleted=1,date_modified='{$GLOBALS['timedate']->nowDb()}', modified_user_id='{$GLOBALS['current_user']->id}' WHERE deleted=0 AND order_id = '{$quote->id}' AND product_id ='{$product_id}'");
        }
    }
}

function amountAllocation($quote_id =''){
    $paid_1 = $GLOBALS['db']->getOne("SELECT IFNULL(sum(payment_amount),0) FROM j_paymentdetail WHERE deleted = 0 AND status = 'Paid' AND quote_id ='{$quote_id}'");
    $paid_2 = $GLOBALS['db']->getOne("SELECT IFNULL(sum(use_amount),0) FROM quotes_j_payment_1_c WHERE deleted = 0 AND quotes_j_payment_1quotes_ida	 ='{$quote_id}'");
    $paid = $paid_1+$paid_2;
    $quote_total = $GLOBALS['db']->getOne("SELECT total FROM quotes WHERE deleted = 0 AND id ='{$quote_id}'");
    $sql_sum = "SELECT IFNULL(sum(p.total_amount),0),p.quote_id
                    FROM products p
                    INNER JOIN product_templates pt
                    ON pt.id = p.product_template_id AND pt.deleted =0 AND pt.is_allocation = 0
                    WHERE p.deleted =0 and p.quote_id ='{$quote_id}'
                    GROUP BY p.quote_id";
    $sum_amount = $GLOBALS['db']->getOne($sql_sum);
    $allocation_amount = $paid - $sum_amount;

    if($allocation_amount > 0){
        $sql = "SELECT p.id id,p.total_amount total_amount,p.quantity quantity
                    FROM products p
                    INNER JOIN product_templates pt
                    ON pt.id = p.product_template_id AND pt.deleted =0 AND pt.is_allocation = 1
                    WHERE p.deleted =0 and p.quote_id ='{$quote_id}'";
        $result = $GLOBALS['db']->query($sql);
        while($row = $GLOBALS['db']->fetchByAssoc($result)){
            $sql1 = "SELECT products.quantity,products.id product_id,
                            u.id unit_id,
                            u.base_unit_id base_unit_id,
                            u.quantity_base_unit quantity_base_unit,
                            pt.is_allocation is_allocation,
                            pt.group_unit_id group_unit_id
                            FROM products
                            INNER JOIN product_templates pt ON products.product_template_id = pt.id AND pt.deleted =0
                            INNER  JOIN j_unit u ON products.unit_id = u.id AND u.deleted = 0
                            WHERE products.deleted = 0 AND products.id = '{$row['id']}'";

            $result1 = $GLOBALS['db']->fetchArray($sql1)[0];
            $limit_use = (($allocation_amount * ($row['total_amount']/($quote_total +$paid_2 - $sum_amount)))*($result1['quantity'] * $result1['quantity_base_unit']))/$row['total_amount'];
            $GLOBALS['db']->query("UPDATE j_payment SET limit_quantity='{$limit_use}',date_modified='{$GLOBALS['timedate']->nowDb()}', modified_user_id='{$GLOBALS['current_user']->id}' WHERE deleted=0 AND order_id = '{$quote_id}' AND product_id ='{$row['id']}'");
        }
    }
    else{
        $GLOBALS['db']->query("UPDATE j_payment SET limit_quantity = 0 ,date_modified='{$GLOBALS['timedate']->nowDb()}' WHERE deleted =0 AND order_id ='{$quote_id}'");
    }
}
function voidBalanceFromQuote($quote_id='',$balance_id=''){
    $relate = $GLOBALS['db']->fetchArray("SELECT * FROM quotes_j_payment_1_c  WHERE quotes_j_payment_1j_payment_idb ='{$balance_id}' AND quotes_j_payment_1quotes_ida ='{$quote_id}' AND deleted=0");
    $quote = BeanFactory::getBean('Quotes',$quote_id);
    $quote->use_free_balance = $quote->use_free_balance - $relate[0]['use_amount'];
    $quote->unpaid_amount = $quote->unpaid_amount + $relate[0]['use_amount'];

    $balance = BeanFactory::getBean('J_Payment',$balance_id);
    $balance->remain_amount = $balance->remain_amount + $relate[0]['use_amount'];
    $balance->save();
    $GLOBALS['db']->query("UPDATE quotes_j_payment_1_c SET deleted=1,date_modified ='{$GLOBALS['timedate']->nowDb()}' WHERE quotes_j_payment_1j_payment_idb ='{$balance_id}' AND quotes_j_payment_1quotes_ida ='{$quote_id}'");
    $quote->save();
}
