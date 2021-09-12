<?php
    //export file excel
    require_once("custom/include/PHPExcel/Classes/PHPExcel.php");
    require_once("custom/include/ConvertMoneyString/convert_number_to_string.php");
    require_once("custom/modules/J_Payment/_helper.php");
    global $timedate, $current_user;
    $path = 'custom/uploads/InvoiceExcel';
    if(!folder_exist($path))
        mkdir( $path );

    $fi = new FilesystemIterator($path, FilesystemIterator::SKIP_DOTS);
    if(iterator_count($fi) > 10)
        array_map('unlink', glob($path."/*"));

    $objPHPExcel = new PHPExcel();

    $payment = BeanFactory::getBean('J_PaymentDetail', $_REQUEST['record']);
    $qTeam = "SELECT code_prefix FROM teams WHERE id = '{$payment->team_id}'";
    $teamShortName = $GLOBALS['db']->getOne($qTeam);

    $templateUrl = "custom/include/TemplateExcel/ReceiptVoucher_".$teamShortName.".xlsx";
    if (!file_exists($templateUrl))
//        $templateUrl = "custom/include/TemplateExcel/ReceiptVoucher3ll.xlsx";
        $templateUrl = "custom/include/TemplateExcel/ReceiptVoucher1p.xlsx";

    //Import Template
    $objReader = PHPExcel_IOFactory::createReader('Excel2007');
    $objPHPExcel = $objReader->load($templateUrl);

    // Set properties
    $objPHPExcel->getProperties()->setCreator("DotB");
    $objPHPExcel->getProperties()->setLastModifiedBy("DotB");
    $objPHPExcel->getProperties()->setTitle("Office 2007 XLSX Test Document");
    $objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Test Document");

    //Add data
    $sql = "SELECT DISTINCT
    l1.id as quote_id,
    j_paymentdetail.name as name,
    j_paymentdetail.payment_amount as payment_amount,
    j_paymentdetail.description  as detail_description,
    j_paymentdetail.payment_date payment_date,
    j_paymentdetail.printed_date printed_date,
    IFNULL(j_paymentdetail.payment_method, '') payment_method,
    l3.contact_id as student_id,
    l3.full_student_name as student_name,
    l3.primary_address_street as student_address,
    l3.phone_mobile as student_phone,
    IFNULL(l7.name, '') team_name
    FROM j_paymentdetail
    INNER JOIN quotes l1 ON l1.id = j_paymentdetail.quote_id AND l1.deleted = 0
    INNER JOIN quotes_contacts l2 ON l2.quote_id = l1.id AND l2.deleted =0
    INNER JOIN contacts l3 ON l3.id = l2.contact_id AND l3.deleted =0
    LEFT JOIN users l4 ON j_paymentdetail.assigned_user_id = l4.id AND l4.deleted = 0
    LEFT JOIN users l5 ON j_paymentdetail.created_by = l5.id AND l5.deleted = 0
    INNER JOIN
    teams l7 ON l1.team_id = l7.id
    AND l7.deleted = 0
    LEFT JOIN
    j_invoice l6 ON j_paymentdetail.invoice_id = l6.id
    AND l6.deleted = 0 AND l6.status <> 'Cancelled'
    WHERE
    (((j_paymentdetail.id = '{$_REQUEST['record']}')))
    AND j_paymentdetail.deleted = 0";
    $res     = $GLOBALS['db']->query($sql);
    $r       = $GLOBALS['db']->fetchByAssoc($res);

    $name = $r['name'];

    //Set Printed - Generate code
    $print_date = strtotime($r['printed_date']);
    if((($print_date <= 0) || empty($print_date)) && !empty($r['primaryid'])){
        $todayDb = date('Y-m-d');
        $GLOBALS['db']->query("UPDATE j_paymentdetail SET printed_date = '$todayDb' WHERE id='{$r['primaryid']}' AND deleted = 0");
    }



    // Write file
    $objPHPExcel->getActiveSheet()->SetCellValue('H4', $name);
    $objPHPExcel->getActiveSheet()->SetCellValue('H3', '1');
    if(!empty($r['pos_code'])){
        $objPHPExcel->getActiveSheet()->SetCellValue('I3', $r['pos_code']);
    }


    //Prepare
    $date       = explode('-', $r['payment_date']);
    $day        = $date[2];
    $month      = $date[1];
    $year       = $date[0];
    $objPHPExcel->getActiveSheet()->SetCellValue('B3', 'Ngày '.$day.' tháng '.$month.' năm '.$year);

    //$objPHPExcel->getActiveSheet()->SetCellValue('C4', mb_strtoupper($r['team_name'], "UTF-8"));
    $objPHPExcel->getActiveSheet()->SetCellValue('A3',  mb_strtoupper(/*$GLOBALS['dotb_config']['brand_name'].' '.*/ $r['team_name'], "UTF-8"));




    $student_name     = $r['student_name'];
    $student_address  = $r['student_address'];
    $student_phone    = $r['student_phone'];
    $student_id       = $r['student_id'];
//    if($r['parent_type'] == 'Leads'){
//        $student_name     = $r['lead_name'];
//        $student_address  = $r['lead_address'];
//        $student_phone    = $r['lead_phone'];
//        $student_id       = '';
//    }
    $objPHPExcel->getActiveSheet()->SetCellValue('B8', $student_name);
    $objPHPExcel->getActiveSheet()->SetCellValue('G8', $student_phone);
    $objPHPExcel->getActiveSheet()->SetCellValue('B9', $student_id);
//    if(!empty($r['class_name'])){
//        $objPHPExcel->getActiveSheet()->SetCellValue('F9', 'Lớp:');
//        $objPHPExcel->getActiveSheet()->SetCellValue('G9', $r['class_name']);
//    }
    $objPHPExcel->getActiveSheet()->SetCellValue('B10',html_entity_decode_utf8($student_address));

//    if($_REQUEST['type'] == "corporate" || $_REQUEST['type'] == "both"){
//        $q2         = "SELECT tax_code, billing_address_street, name FROM accounts WHERE id = '{$r['company_id']}'";
//        $rs2        = $GLOBALS['db']->query($q2);
//        $r_company  = $GLOBALS['db']->fetchByAssoc($rs2);
//
//        $objPHPExcel->getActiveSheet()->SetCellValue('B8', $r_company['name']);
//        $objPHPExcel->getActiveSheet()->SetCellValue('G8', '');
//        $objPHPExcel->getActiveSheet()->SetCellValue('B9', '');
//        $objPHPExcel->getActiveSheet()->SetCellValue('B10',html_entity_decode_utf8($r_company['billing_address_street']));
//    }



    //$content = generateContent($r);
    $objPHPExcel->getActiveSheet()->SetCellValue('B11', $r['detail_description']);

    // - Money to String
    $int = new Integer();
    $text = $int->toText($r['payment_amount']);
//    $objPHPExcel->getActiveSheet()->SetCellValue('B12', number_format($r['total_after_discount'],0));
    $objPHPExcel->getActiveSheet()->SetCellValue('B12', number_format($r['payment_amount'],0));
//	$objPHPExcel->getActiveSheet()->SetCellValue('G12', $timedate->now());
//    $objPHPExcel->getActiveSheet()->SetCellValue('B14', $text);

    // - Method
    if ($r['payment_method'] == "Cash") $pmmt="TM";
    elseif ($r['payment_method'] == "Card") $pmmt="CK";
    else $pmmt      ="CK";
    $objPHPExcel->getActiveSheet()->SetCellValue('B13', $text);
    $objPHPExcel->getActiveSheet()->SetCellValue('B15', $text);
    $objPHPExcel->getActiveSheet()->SetCellValue('B16', $pmmt);
//    $objPHPExcel->getActiveSheet()->SetCellValue('D27', $current_user->name);

    //Lock file
    //$objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);
    //$objPHPExcel->getActiveSheet()->getProtection()->setSort(true);
    //$objPHPExcel->getActiveSheet()->getProtection()->setInsertRows(true);
    //$objPHPExcel->getActiveSheet()->getProtection()->setFormatCells(true);
    //$objPHPExcel->getActiveSheet()->getProtection()->setPassword('7779');

    //Clone sheet - Liên 2

    $objPHPExcel->getActiveSheet()->setTitle('Receipt');
    $max_re = 29;
    for ($re = 1; $re <= $max_re; $re++)
        copyRowFull($objPHPExcel->getActiveSheet(),$objPHPExcel->getActiveSheet(), $re, $max_re + $re);
    $objPHPExcel->getActiveSheet()->SetCellValue('H'.(3+$max_re), '2');

    // Save Excel 2007 file
    $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
    $section = create_guid_section(6);
    $file = $path.'/'.preg_replace("/[^a-z0-9\_\-\.]/i", '', 'Receipt_'.$name.'-'.$section.'.xlsx');

	$objWriter->save($file);
	//download to browser         /custom/uploads/default.xlsx
	$src = 'https://view.officeapps.live.com/op/view.aspx?src='.$GLOBALS['dotb_config']['site_url'].'/'.$file;
	if($_SERVER["REMOTE_ADDR"] == '::1')
	header('Location: '.$file);
	else header('Location: '.$src);

    function copyRowFull(&$ws_from, &$ws_to, $row_from, $row_to) {
        $ws_to->getRowDimension($row_to)->setRowHeight($ws_from->getRowDimension($row_from)->getRowHeight());
        $lastColumn = $ws_from->getHighestColumn();
        ++$lastColumn;
        for ($c = 'A'; $c != $lastColumn; ++$c) {
            $cell_from = $ws_from->getCell($c.$row_from);
            $cell_to = $ws_to->getCell($c.$row_to);
            $cell_to->setXfIndex($cell_from->getXfIndex()); // black magic here
            $cell_to->setValue($cell_from->getValue());
        }
        //Xu ly merge cell
        $merged_list = $ws_from->getMergeCells();
        $max_re = $row_to - $row_from;
        foreach($merged_list as $merged => $strMedged){
            $part = explode(":",$strMedged);
            $r1 = $ws_from->getCell($part[0])->getRow();
            $c1 = $ws_from->getCell($part[0])->getColumn();

            $r2 = $ws_from->getCell($part[1])->getRow();
            $c2 = $ws_from->getCell($part[1])->getColumn();

            $ws_to->mergeCells($c1.strval($r1+$max_re).':'.$c2.strval($r2+$max_re));
        }
    }

    function folder_exist($folder)
    {
        // Get canonicalized absolute pathname
        $path = realpath($folder);

        // If it exist, check if it's a directory
        return ($path !== false AND is_dir($path)) ? $path : false;
}