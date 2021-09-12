<?php
//export file excel
require_once("custom/include/PHPExcel/Classes/PHPExcel.php");
require_once("custom/include/ConvertMoneyString/convert_number_to_string.php");

global $timedate, $current_user;
$fi = new FilesystemIterator("custom/uploads/InvoiceExcel", FilesystemIterator::SKIP_DOTS);
if(iterator_count($fi) > 10)
    array_map('unlink', glob("custom/uploads/InvoiceExcel/*"));

$objPHPExcel = new PHPExcel();

$templateUrl = "custom/include/TemplateExcel/center_expenses.xlsx";

//Import Template
$objReader = PHPExcel_IOFactory::createReader('Excel2007');
$objPHPExcel = $objReader->load($templateUrl);

// Set properties
$objPHPExcel->getProperties()->setCreator("DotB");
$objPHPExcel->getProperties()->setLastModifiedBy("DotB");
$objPHPExcel->getProperties()->setTitle("Office 2007 XLSX Test Document");
$objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Test Document");
$objPHPExcel->getProperties()->setDescription("Test document for Office 2007 XLSX");

//Add data
if($_REQUEST['module_type'] == 'J_Budget'){
    $sql = "SELECT DISTINCT
    IFNULL(j_budget.id, '') primaryid,
    j_budget.amount amount,
    j_budget.date_entered date_entered,
    j_budget.date_modified date_modified,
    IFNULL(j_budget.description, '') description,
    IFNULL(j_budget.expense_for, '') expense_for,
    IFNULL(j_budget.expense_options, '') expense_options,
    IFNULL(j_budget.description, '') address,
    j_budget.expense_date expense_date,
    IFNULL(j_budget.name, '') name,
    IFNULL(l2.full_user_name, '') assigned_to,
    IFNULL(l7.full_user_name, '') created_by,
    IFNULL(l1.name,'') team_name,
    IFNULL(l1.description,'') team_address
    FROM j_budget INNER JOIN  teams l1 ON j_budget.team_id=l1.id AND l1.deleted=0
    LEFT JOIN users l2 ON j_budget.assigned_user_id = l2.id AND l2.deleted = 0
    INNER JOIN users l7 ON l7.id = j_budget.created_by AND l7.deleted = 0
    WHERE (((j_budget.id = '{$_REQUEST['record']}')))
    AND j_budget.deleted = 0";
}else{
    $sql = "SELECT
    IFNULL(j_payment.name, '') payment_code,
    IFNULL(j_payment.payment_amount, '') payment_amount,
    IFNULL(j_payment.refund_revenue, '') refund_revenue,
    IFNULL(j_payment.payment_date, '') payment_date,
    IFNULL(j_payment.description, '') description,
    IFNULL(l2.id, '') team_id,
    IFNULL(l2.name, '') team_name,
    IFNULL(l2.description, '') team_address,
    IFNULL(l1.id, '') related_pay_id,
    IFNULL(l1.name, '') related_pay_code,
    SUM(IFNULL(l1.payment_amount + l1.paid_amount + l1.deposit_amount, 0)) related_pay_amount,
    MIN(l1.payment_date) related_pay_date,
    IFNULL(l1.payment_type, '') related_pay_type,
    IFNULL(l3.id, '') student_id,
    IFNULL(l3.contact_id, '') student_code,
    IFNULL(l3.full_student_name, '') student_name,
    IFNULL(l3.phone_mobile, '') student_mobile,
    IFNULL(l7.full_user_name, '') created_by,
    IFNULL(l3.primary_address_street, '') student_address
    FROM j_payment
    LEFT JOIN j_payment_j_payment_1_c l1_1 ON j_payment.id = l1_1.j_payment_j_payment_1j_payment_ida AND l1_1.deleted = 0
    LEFT JOIN j_payment l1 ON l1.id = l1_1.j_payment_j_payment_1j_payment_idb  AND l1.deleted = 0
    LEFT JOIN teams l2 ON j_payment.team_id = l2.id AND l2.deleted = 0
    LEFT JOIN contacts_j_payment_1_c l3_1 ON j_payment.id = l3_1.contacts_j_payment_1j_payment_idb AND l3_1.deleted = 0
    LEFT JOIN contacts l3 ON l3.id = l3_1.contacts_j_payment_1contacts_ida AND l3.deleted = 0
    LEFT JOIN j_paymentdetail l6 ON l6.payment_id = l1.id AND l6.deleted = 0
    INNER JOIN users l7 ON l7.id = j_payment.created_by AND l7.deleted = 0
    WHERE
    j_payment.id = '{$_REQUEST['record']}'
    AND j_payment.deleted = 0
    LIMIT 1";
}
$res     = $GLOBALS['db']->query($sql);
$r       = $GLOBALS['db']->fetchByAssoc($res);

//Prepare
if($_REQUEST['module_type'] == 'J_Budget'){
    $date       = explode('-', $r['expense_date']);
    $day        = $date[2];
    $month      = $date[1];
    $year       = $date[0];
    $objPHPExcel->getActiveSheet()->SetCellValue('B7', 'Ngày '.$day.' tháng '.$month.' năm '.$year);
    $objPHPExcel->getActiveSheet()->SetCellValue('B8', mb_strtoupper($GLOBALS['dotb_config']['brand_name']." ".$r['team_name'], "UTF-8"));
    $objPHPExcel->getActiveSheet()->SetCellValue('B12', '');
    $objPHPExcel->getActiveSheet()->SetCellValue('B13', $r['team_address']);
    $objPHPExcel->getActiveSheet()->SetCellValue('B14', $r['name']);
    $objPHPExcel->getActiveSheet()->SetCellValue('B15', number_format($r['amount']));
    $int = new Integer();
    $text = $int->toText($r['amount']);
    $objPHPExcel->getActiveSheet()->SetCellValue('B16', $text);
    $objPHPExcel->getActiveSheet()->SetCellValue('A3', 'Đơn vị: '.mb_strtoupper($GLOBALS['dotb_config']['brand_name']." ".$r['team_name'], "UTF-8"));
    $objPHPExcel->getActiveSheet()->SetCellValue('A4', 'Địa chỉ: '.$r['team_address']);
    $objPHPExcel->getActiveSheet()->SetCellValue('C28', $r['created_by']);
    $objPHPExcel->getActiveSheet()->SetCellValue('G7', 'Số: 1');
}elseif($_REQUEST['module_type'] == 'J_Payment'){
    $date       = explode('-', $r['payment_date']);
    $day        = $date[2];
    $month      = $date[1];
    $year       = $date[0];
    $objPHPExcel->getActiveSheet()->SetCellValue('B7', 'Ngày '.$day.' tháng '.$month.' năm '.$year);
    $objPHPExcel->getActiveSheet()->SetCellValue('B8', mb_strtoupper($GLOBALS['dotb_config']['brand_name']." ".$r['team_name'], "UTF-8"));
    $objPHPExcel->getActiveSheet()->SetCellValue('B12', $r['student_name']);
    $objPHPExcel->getActiveSheet()->SetCellValue('F12', $r['student_mobile']);
    $objPHPExcel->getActiveSheet()->SetCellValue('B13', $r['student_address']);
    $objPHPExcel->getActiveSheet()->SetCellValue('B14', $r['description']);
    $objPHPExcel->getActiveSheet()->SetCellValue('B15', number_format($r['payment_amount']));
    $int = new Integer();
    $text = $int->toText($r['payment_amount']);
    $objPHPExcel->getActiveSheet()->SetCellValue('B16', $text);
    $objPHPExcel->getActiveSheet()->SetCellValue('A3', 'Đơn vị: '.mb_strtoupper($GLOBALS['dotb_config']['brand_name']." ".$r['team_name'], "UTF-8"));
    $objPHPExcel->getActiveSheet()->SetCellValue('A4', 'Địa chỉ: '.$r['team_address']);
    $objPHPExcel->getActiveSheet()->SetCellValue('C28', $r['created_by']);
    $objPHPExcel->getActiveSheet()->SetCellValue('G7', 'Số: 1');
}

$objSheetBase   = $objPHPExcel->getActiveSheet();
$objSheetBase   = clone $objSheetBase;
$objSheetBase->setTitle('P2');
$objPHPExcel->addSheet($objSheetBase);
$objPHPExcel->setActiveSheetIndexByName('P2')->SetCellValue('G7', 'Số: 2');

////Clone sheet - Liên 3
//$objSheetBase   = $objPHPExcel->getActiveSheet();
//$objSheetBase   = clone $objSheetBase;
//$objSheetBase->setTitle('P3');
//$objPHPExcel->addSheet($objSheetBase);
//$objPHPExcel->setActiveSheetIndexByName('P3')->SetCellValue('G3', "Liên số: 3");


$objPHPExcel->setActiveSheetIndexByName('P1');





// Save Excel 2007 file
$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
$section = create_guid_section(6);
$file = 'custom/uploads/InvoiceExcel/'.preg_replace("/[^a-z0-9\_\-\.]/i", '', 'center_expenses-'.$section.'.xlsx');

$objWriter->save($file);

$src = 'https://view.officeapps.live.com/op/view.aspx?src='.$GLOBALS['dotb_config']['site_url'].'/'.$file;
if($_SERVER["REMOTE_ADDR"] == '::1')
header('Location: '.$file);
else header('Location: '.$src);