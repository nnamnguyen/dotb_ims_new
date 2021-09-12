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
        $templateUrl = "custom/include/TemplateExcel/ReceiptVoucher3ll.xlsx";
    //    $templateUrl = "custom/include/TemplateExcel/ReceiptVoucher1p.xlsx";

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
    IFNULL(l1.id, '') payment_id,
    IFNULL(l1.name, '') l1_name,
    IFNULL(l1.kind_of_course_string, '') kind_of_course,
    IFNULL(l9.id, '') company_id,
    IFNULL(l9.name, '') company_name,
    IFNULL(l9.billing_address_street, '') company_address,
    IFNULL(l9.tax_code, '') tax_code,
    IFNULL(l4.name, '') course_fee_name,
    IFNULL(l4.extend_vat, '') extend_vat,
    l1.final_sponsor_percent final_sponsor_percent,
    l4.type_of_course_fee type_of_course_fee,
    l1.tuition_fee payment_tuition_fee,
    l1.tuition_hours payment_tuition_hours,
    IFNULL(j_paymentdetail.id, '') primaryid,
    IFNULL(j_paymentdetail.name, '') name,
    j_paymentdetail.payment_date payment_date,
    j_paymentdetail.printed_date printed_date,
    IFNULL(j_paymentdetail.payment_method, '') payment_method,
    j_paymentdetail.before_discount before_discount,
    j_paymentdetail.discount_amount discount_amount,
    j_paymentdetail.sponsor_amount sponsor_amount,
    j_paymentdetail.payment_no payment_no,
    j_paymentdetail.payment_amount payment_amount,
    IFNULL(j_paymentdetail.pos_code, '') pos_code,
    IFNULL(j_paymentdetail.inv_code, '') inv_code,
    l1.tuition_hours tuition_hours,
    l1.deposit_amount deposit_amount,
    l1.paid_amount paid_amount,
    l1.payment_type payment_type,
    l1.total_after_discount total_after_discount,
    l1.parent_type parent_type,
    l1.description description,
    j_paymentdetail.reference_document reference_document,
    j_paymentdetail.reference_number reference_number,
    j_paymentdetail.description detail_description,
    j_paymentdetail.is_discount is_discount,
    IFNULL(l2.id, '') l2_id,
    IFNULL(l5.name, '') team_name,
    IFNULL(l5.description, '') team_address,
    IFNULL(l3.contact_id, '') student_id,
    IFNULL(l6.name, '') invoice_no,
    IFNULL(l6.invoice_date, '') invoice_date,
    IFNULL(l2.full_user_name, '') assigned_user_name,
    IFNULL(l7.full_user_name, '') created_by_name,
    IFNULL(l3.id, '') l3_id,
    IFNULL(l3.full_student_name, '') student_name,
    l3.primary_address_street student_address,
    IFNULL(l3.phone_mobile, '') student_phone,
    IFNULL(la.full_lead_name, '') lead_name,
    la.primary_address_street lead_address,
    IFNULL(la.phone_mobile, '') lead_phone,
    IFNULL(group_concat(l11.name separator ','), '') class_name
    FROM
    j_paymentdetail
    LEFT JOIN
    j_payment l1 ON j_paymentdetail.payment_id = l1.id
    AND l1.deleted = 0
    LEFT JOIN j_studentsituations l10 ON l1.id=l10.payment_id AND l10.deleted=0
    LEFT JOIN j_class l11 ON l10.ju_class_id=l11.id AND l11.deleted=0
    LEFT JOIN
    users l2 ON j_paymentdetail.assigned_user_id = l2.id
    AND l2.deleted = 0
    LEFT JOIN
    users l7 ON j_paymentdetail.created_by = l7.id
    AND l7.deleted = 0
    LEFT JOIN
    contacts_j_payment_1_c l3_1 ON l1.id = l3_1.contacts_j_payment_1j_payment_idb
    AND l3_1.deleted = 0
    LEFT JOIN
    contacts l3 ON l3.id = l3_1.contacts_j_payment_1contacts_ida
    AND l3.deleted = 0
    LEFT JOIN
    leads la ON l1.lead_id = la.id
    AND la.deleted = 0
    LEFT JOIN
    j_coursefee_j_payment_1_c l4_1 ON l1.id = l4_1.j_coursefee_j_payment_1j_payment_idb
    AND l4_1.deleted = 0
    LEFT JOIN
    j_coursefee l4 ON l4.id = l4_1.j_coursefee_j_payment_1j_coursefee_ida
    AND l4.deleted = 0
    INNER JOIN
    teams l5 ON l1.team_id = l5.id
    AND l5.deleted = 0
    LEFT JOIN
    j_invoice l6 ON j_paymentdetail.invoice_id = l6.id
    AND l6.deleted = 0 AND l6.status <> 'Cancelled'
    LEFT JOIN accounts l9 ON l1.account_id = l9.id AND l9.deleted = 0
    WHERE
    (((j_paymentdetail.id = '{$_REQUEST['record']}')))
    AND j_paymentdetail.deleted = 0
    GROUP BY primaryid";
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
    $objPHPExcel->getActiveSheet()->SetCellValue('I2', $name);
    $objPHPExcel->getActiveSheet()->SetCellValue('I3', '1');
    if(!empty($r['pos_code'])){
        $objPHPExcel->getActiveSheet()->SetCellValue('I3', $r['pos_code']);
    }


    //Prepare
    $date       = explode('-', $r['payment_date']);
    $day        = $date[2];
    $month      = $date[1];
    $year       = $date[0];
    $objPHPExcel->getActiveSheet()->SetCellValue('C3', 'Ngày '.$day.' tháng '.$month.' năm '.$year);

    //$objPHPExcel->getActiveSheet()->SetCellValue('C4', mb_strtoupper($r['team_name'], "UTF-8"));
    $objPHPExcel->getActiveSheet()->SetCellValue('C4',  mb_strtoupper(/*$GLOBALS['dotb_config']['brand_name'].' '.*/ $r['team_name'], "UTF-8"));




    $student_name     = $r['student_name'];
    $student_address  = $r['student_address'];
    $student_phone    = $r['student_phone'];
    $student_id       = $r['student_id'];
    if($r['parent_type'] == 'Leads'){
        $student_name     = $r['lead_name'];
        $student_address  = $r['lead_address'];
        $student_phone    = $r['lead_phone'];
        $student_id       = '';
    }
    $objPHPExcel->getActiveSheet()->SetCellValue('B8', $student_name);
    $objPHPExcel->getActiveSheet()->SetCellValue('G8', $student_phone);
    $objPHPExcel->getActiveSheet()->SetCellValue('B9', $student_id);
    if(!empty($r['class_name'])){
        $objPHPExcel->getActiveSheet()->SetCellValue('F9', 'Lớp:');
        $objPHPExcel->getActiveSheet()->SetCellValue('G9', $r['class_name']);
    }
    $objPHPExcel->getActiveSheet()->SetCellValue('B10',html_entity_decode_utf8($student_address));

    if($_REQUEST['type'] == "corporate" || $_REQUEST['type'] == "both"){
        $q2         = "SELECT tax_code, billing_address_street, name FROM accounts WHERE id = '{$r['company_id']}'";
        $rs2        = $GLOBALS['db']->query($q2);
        $r_company  = $GLOBALS['db']->fetchByAssoc($rs2);

        $objPHPExcel->getActiveSheet()->SetCellValue('B8', $r_company['name']);
        $objPHPExcel->getActiveSheet()->SetCellValue('G8', '');
        $objPHPExcel->getActiveSheet()->SetCellValue('B9', '');
        $objPHPExcel->getActiveSheet()->SetCellValue('B10',html_entity_decode_utf8($r_company['billing_address_street']));
    }



    //$content = generateContent($r);
    $objPHPExcel->getActiveSheet()->SetCellValue('B11', $r['detail_description']);

    // - Money to String
    $int = new Integer();
    $text = $int->toText($r['payment_amount']);
//    $objPHPExcel->getActiveSheet()->SetCellValue('B12', number_format($r['total_after_discount'],0));
    $objPHPExcel->getActiveSheet()->SetCellValue('B12', number_format($r['payment_amount'],0));
	$objPHPExcel->getActiveSheet()->SetCellValue('G12', $timedate->now());
//    $objPHPExcel->getActiveSheet()->SetCellValue('B14', $text);

    // - Method
    if ($r['payment_method'] == "Cash") $pmmt="TM";
    elseif ($r['payment_method'] == "Card") $pmmt="CK";
    else $pmmt      ="CK";
    $objPHPExcel->getActiveSheet()->SetCellValue('B13', $text);
	
    $objPHPExcel->getActiveSheet()->SetCellValue('B14', $pmmt);
    $objPHPExcel->getActiveSheet()->SetCellValue('D27', $current_user->name);

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
    $objPHPExcel->getActiveSheet()->SetCellValue('I'.(3+$max_re), '2');

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