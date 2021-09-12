<?php
if (function_exists('opcache_reset')) opcache_reset();
include_once('include/MVC/preDispatch.php');
require_once('include/entryPoint.php');
switch ($_GET['type']) {
    case 'drop_expired':
        $result = drop_expired($_GET);
        break;
    default;
        echo 'What\'s do you want ?? ';
        die();
        break;
}


//############## CRON EXPIRED DATE - DROP TO REVENUE AUTOMATIC
function drop_expired($get){
    //die();
    $drop_to_date = $get['drop_date'];
    if(empty($drop_to_date))
        $drop_to_date = date('2019-02-28');

    //$drop_list = $get['drop_list'];
    //if(empty($drop_list)) die();

    $date = new DateTime('first day of last month');
    $filter_date = $date->format('Y-m-d');
    global $timedate;
    $q1 = "SELECT DISTINCT
    IFNULL(j_payment.id, '') primaryid,
    IFNULL(j_payment.name, '') payment_name,
    IFNULL(j_payment.payment_type, '') payment_type,
    j_payment.payment_expired payment_expired,
    j_payment.remain_amount remain_amount,
    j_payment.remain_hours remain_hours,
    IFNULL(l1.id, '') center_id,
    IFNULL(l1.name, '') center_name,
    IFNULL(l2.id, '') student_id,
    CONCAT(IFNULL(l2.last_name, ''),' ',IFNULL(l2.first_name, '')) student_name,
    IFNULL(l3.id, '') user_id
    FROM j_payment
    INNER JOIN
    teams l1 ON j_payment.team_id = l1.id
    AND l1.deleted = 0
    INNER JOIN
    contacts_j_payment_1_c l2_1 ON j_payment.id = l2_1.contacts_j_payment_1j_payment_idb
    AND l2_1.deleted = 0
    INNER JOIN
    contacts l2 ON l2.id = l2_1.contacts_j_payment_1contacts_ida
    AND l2.deleted = 0
    INNER JOIN
    users l3 ON j_payment.assigned_user_id = l3.id
    AND l3.deleted = 0
    WHERE
    (((((j_payment.payment_type IN ('Deposit' , 'Delay',
    'Transfer In',
    'Moving In',
    'Placement Test',
    'Cashholder',
    'Schedule Change'))
    AND (j_payment.status = 'Success')
    AND (((j_payment.remain_amount > 0)
    OR (j_payment.remain_hours > 0)))))))
    AND j_payment.deleted = 0
    AND j_payment.id IN ('c584498e-947b-11ea-997c-a9b269d08632')";
    //    "";
    $count = 0;
    $drs = $GLOBALS['db']->fetchArray($q1);
    for($i = 0; $i < count($drs); $i++){
        $q2 = "UPDATE c_deliveryrevenue SET deleted=1, date_modified='{$GLOBALS['timedate']->nowDb()}', modified_user_id='{$GLOBALS['current_user']->id}' WHERE ju_payment_id = '{$drs[$i]['primaryid']}' AND passed = 0";
        $GLOBALS['db']->query($q2);

        $delivery = new C_DeliveryRevenue();
        $delivery->name = 'Drop revenue from payment '.$drs[$i]['payment_name'];
        $delivery->student_id = $drs[$i]['student_id'];
        //Get Payment ID
        $delivery->ju_payment_id = $drs[$i]['primaryid'];

        $delivery->amount = format_number($drs[$i]['remain_amount']);
        $delivery->duration = format_number($drs[$i]['remain_hours'],2,2);
        $delivery->date_input = $drop_to_date;
        $delivery->session_id = '1';
        $delivery->passed = 0;
        $delivery->description = ' Dropped Revenue. Payment '.$drs[$i]['payment_name'].' expired at '.$timedate->to_display_date($drs[$i]['payment_expired'],false);
        $delivery->team_id = $drs[$i]['center_id'];
        $delivery->team_set_id =  $delivery->team_id;
        $delivery->cost_per_hour = format_number($drs[$i]['remain_amount'] / $drs[$i]['remain_hours'],2,2);
        $delivery->assigned_user_id = $drs[$i]['user_id'];
        $delivery->revenue_type = 'Enrolled';
        $delivery->save();  ///#####

        $q3 = "UPDATE j_payment SET remain_amount=0, remain_hours=0, status='Closed'  WHERE id = '{$delivery->ju_payment_id}' AND deleted=0";
        $GLOBALS['db']->query($q3);
        $count++;
    }
    echo "Droped $count";
}

?>
