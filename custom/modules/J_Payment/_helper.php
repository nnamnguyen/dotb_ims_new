<?php
    function generateContent($r, $generate = true){
        $today = date('Y-m-d');
        if(!empty($r['expired_date'])) $expiredDate = $r['expired_date'];

        if($generate) if($today < $r['expired_date']) $expiredDate =  $today;

        $monthT = ' - tháng '.date('m/Y',strtotime($expiredDate)).'.';
        if(empty($expiredDate)) $monthT = ' - lần '.$r['payment_no'].'.';

        switch ($r['payment_type']) {
            case "Enrollment":
            case "Cashholder":
                $content = "Thu tiền khóa học {$r['kind_of_course']}".$monthT;
                break;
            case "Deposit":
                $content = "Thu tiền đặt cọc khóa {$r['kind_of_course']}".$monthT;
                break;
            case "Placement Test":
                $content = "Thu tiền kiểm tra trình độ.";
                break;
            case "Delay Fee":
                $content = "Thu phí bảo lưu khóa học tiếng anh.";
                break;
            case "Transfer Fee":
                $content = "Thu phí chuyển nhượng khoá học.";
                break;
            case "Product":
                $q1 = "SELECT DISTINCT
                IFNULL(l3.id, '') book_id,
                IFNULL(l3.name, '') book_name,
                IFNULL(j_inventorydetail.id, '') primaryid,
                ABS(j_inventorydetail.quantity) quantity,
                l3.unit unit,
                j_inventorydetail.price price,
                j_inventorydetail.amount amount,
                IFNULL(l1.id, '') l1_id,
                l1.total_amount total_amount,
                ABS(l1.total_quantity) total_quantity
                FROM
                j_inventorydetail
                INNER JOIN
                j_inventory l1 ON j_inventorydetail.inventory_id = l1.id
                AND l1.deleted = 0
                INNER JOIN
                j_payment_j_inventory_1_c l2_1 ON l1.id = l2_1.j_payment_j_inventory_1j_inventory_idb
                AND l2_1.deleted = 0
                INNER JOIN
                j_payment l2 ON l2.id = l2_1.j_payment_j_inventory_1j_payment_ida
                AND l2.deleted = 0
                INNER JOIN
                product_templates l3 ON j_inventorydetail.book_id = l3.id
                AND l3.deleted = 0
                WHERE
                (((l2.id = '{$r['payment_id']}')))
                AND j_inventorydetail.deleted = 0";
                $rs1 = $GLOBALS['db']->query($q1);
                $content = "";
                while($row = $GLOBALS['db']->fetchByAssoc($rs1)){
                    $content .= $row['book_name']." ({$row['quantity']}). ";
                }
                break;
        }
        return $content;
    }

    //E-Invoice
    function get_EvatToken($evat){
        $account = explode("-", $evat->account);
        $y = curl_init();
        curl_setopt($y, CURLOPT_URL, "{$evat->host}/user/token?appid={$evat->accpass}&taxcode={$account[0]}&username={$evat->user_name}&password={$evat->password}");
        curl_setopt($y, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($y, CURLOPT_POST, true);
        curl_setopt($y, CURLOPT_SSL_VERIFYPEER, false);

        $headers = array();
        $headers[] = 'Content-Type: application-json';
        $headers[] = 'Content-Length: 0';
        curl_setopt($y, CURLOPT_HTTPHEADER, $headers);

        $err = '';
        $result = curl_exec($y);
        if (curl_errno($y))
            $err = 'Error: ' . curl_error($y);

        curl_close ($y);
        $result = json_decode($result,true);

        return array(
            'success'   => $result['Success'],
            'token'     => $result['Data'],
            'errorCode' => $result['ErrorCode'],
            'errorCodeDetail' => $result['ErrorCodeDetail'],
            'errorMes'  => $err,
        );
    }

    function get_IptemplatePublish($evat, $token){
        //Lấy danh sách các hóa đơn đã phát hành
        $y = curl_init();
        curl_setopt($y, CURLOPT_URL, "{$evat->host}/invoice-pub-mngt/iptemplatepublish");
        curl_setopt($y, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($y, CURLOPT_SSL_VERIFYPEER, false);

        $h = array();
        $h[] = 'Content-Type: application-json';
        $h[] = 'Content-Length: 0';
        $h[] = 'Authorization: Bearer ' . $token;
        curl_setopt($y, CURLOPT_HTTPHEADER, $h);
        $err = '';
        $result = curl_exec($y);
        if (curl_errno($y)) {
            $err = 'Error:' . curl_error($y);
        }
        curl_close ($y);
        $result = json_decode($result,true);

        if(!$result['Success'])
            return array(
                'success'   => $result['Success'],
                'errorCode' => $result['ErrorCode'],
                'errorMes'  => $err,
            );

        $templates = json_decode($result['Data'],true);
        foreach($templates as $tmp){
            if($tmp['TemplateCode'] == $evat->pattern && $tmp['InvoiceSeries'] == $evat->serial_no ) {
                return array(
                    'success'        => true,
                    'TemplateCode'   => $tmp['TemplateCode'],
                    'InvoiceSeries'  => $tmp['InvoiceSeries'],
                    'InvoiceType'    => $tmp['InvoiceType'],
                );
            }
        }
        //Xu ly loi khong tim thay
        return array(
            'success' => false,
            'errorCode' => 'InvoiceTemplateNotFound',
            'errorMes' => $err,
        );
    }

    function PublishInvoiceHSM($evat, $param, $token){
        //Phat hanh hoa don
        $ph = curl_init();

        curl_setopt($ph, CURLOPT_URL, "{$evat->host}/invoice/PublishInvoiceHSM");

        $h = array();
        $h[] = 'Content-Type: application/json';
        $h[] = 'Authorization: Bearer ' . $token;
        curl_setopt($ph, CURLOPT_HTTPHEADER, $h);

        curl_setopt($ph, CURLOPT_POST, true);
        curl_setopt($ph, CURLOPT_POSTFIELDS, $param);
        curl_setopt($ph, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ph, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ph);
        $content = $response;
        curl_close ($ph);

        $result = json_decode($response, true);

        if (!$result['Success'])
            return array(
                'success'   => $result['Success'],
                'errorCode' => $result['ErrorCode'],
            );

        $data = json_decode($result['Data'], true);
        foreach($data as $val){
            return array(
                'success'           => true,
                'RefID'             => $val['RefID'],
                'TransactionID'     => $val['TransactionID'],
                'InvoiceNumber'     => $val['InvoiceNumber'],
                'Content'           => $content,
            );
        }
    }

    function DeleteInvoice($evat, $param, $token) {
        $x = curl_init();
        curl_setopt($x, CURLOPT_URL, "{$evat->host}/invoice/deleted");

        $h = array();
        $h[] = 'Content-Type: application/json';
        $h[] = 'Authorization: Bearer ' . $token;
        curl_setopt($x, CURLOPT_HTTPHEADER, $h);

        curl_setopt($x, CURLOPT_POST, true);
        curl_setopt($x, CURLOPT_POSTFIELDS, $param);
        curl_setopt($x, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($x, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($x);
        curl_close ($x);

        $result = json_decode($response, true);

        if (!$result['Success'])
            return array(
                'success'   => $result['Success'],
                'errorCode' => $result['ErrorCode'],
            );

        return array(
            'success'   => $result['Success'],
            'data'     => $result['Data'],
        );
    }

    function DownloadInvoice($evat, $param, $token) {
        $del = curl_init();
        curl_setopt($del, CURLOPT_URL, "{$evat->host}/invoice/download?downloadDataType=pdf");

        $h = array();
        $h[] = 'Content-Type: application/json';
        $h[] = 'Authorization: Bearer ' . $token;
        curl_setopt($del, CURLOPT_HTTPHEADER, $h);

        curl_setopt($del, CURLOPT_POST, true);
        curl_setopt($del, CURLOPT_POSTFIELDS, $param);
        curl_setopt($del, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($del, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($del);
        curl_close ($del);

        $result = json_decode($response, true);

        if (!$result['Success'])
            return array(
                'success'   => $result['Success'],
                'errorCode' => $result['ErrorCode'],
            );

        $data = json_decode($result['Data'],true);
        foreach($data as $val) {
            return array(
                'success'           => true,
                'transactionID'     => $val['TransactionID'],
                'data'              => $val['Data'],
            );
        }
    }
    // E-invoice Bkav

    function CreateEinvoice($evat, $param){ // Tao hoa don
        $ph = curl_init();

        curl_setopt($ph, CURLOPT_URL, "{$evat->host}/ExecCommand");

        $h = array();
        $h[] = 'Content-Type: application/json';
        curl_setopt($ph, CURLOPT_HTTPHEADER, $h);

        curl_setopt($ph, CURLOPT_POST, true);
        curl_setopt($ph, CURLOPT_POSTFIELDS, $param);
        curl_setopt($ph, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ph, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ph);
        curl_close ($ph);

        $result = json_decode($response, true);
        $result_decode =json_decode(base64_decode( $result['d']), true);
        $content = $result_decode;
        if ($result_decode['Status']!=0)
            return array(
                'Status'    => $result_decode['Status'],
                'isError'   => $result_decode['isError'],
            );
        $data = json_decode($result_decode['Object'],true);
        foreach($data as $val){
            return array(
                'Status'                    => $val['Status'],
                'MessLog'                   => $val['MessLog'],
                'PartnerInvoiceID'          => $val['PartnerInvoiceID'],
                'PartnerInvoiceStringID'    => $val['PartnerInvoiceStringID'],
                'InvoiceGUID'               => $val['InvoiceGUID'],
                'InvoiceForm'               => $val['InvoiceForm'],
                'InvoiceSerial'             => $val['InvoiceSerial'],
                'InvoiceNo'                 => $val['InvoiceNo'],
                'MTC'                       => $val['MTC'],
                'Content'                   => $content,
            );
        }
    }
function GeneralEinvoice($evat, $param){ //cau truc gui api cho bkav thuong dung
    $ph = curl_init();

    curl_setopt($ph, CURLOPT_URL, "{$evat->host}/ExecCommand");

    $h = array();
    $h[] = 'Content-Type: application/json';
    curl_setopt($ph, CURLOPT_HTTPHEADER, $h);

    curl_setopt($ph, CURLOPT_POST, true);
    curl_setopt($ph, CURLOPT_POSTFIELDS, $param);
    curl_setopt($ph, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ph, CURLOPT_SSL_VERIFYPEER, false);

    $response = curl_exec($ph);
    curl_close ($ph);

    $result = json_decode($response, true);
    $result_decode =json_decode(base64_decode( $result['d']), true);
    if ($result_decode['Status']!=0)
        return array(
            'Status'    => $result_decode['Status'],
            'isError'   => $result_decode['isError'],
        );
    else return array(
            'Status'                    => $result_decode['Status'],
            'Content'                   => $result_decode['Object'],
        );
}
?>
