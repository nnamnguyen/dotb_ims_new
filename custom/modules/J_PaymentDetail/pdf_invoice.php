<?php
require_once("custom/modules/J_Payment/_helper.php");
$bean = new ViewDotbpdf();
$bean->module = 'J_PaymentDetail';
$bean->action = 'dotbpdf';
$pdf = new DotbpdfPdfmanager();
$payment = BeanFactory::getBean('J_PaymentDetail', $_REQUEST['record'], array('disable_row_level_security' => true));
$pdf->module ='J_PaymentDetail';
$pdf->action = 'pdfmanager';
$pdf->fileName = $payment->name.'.pdf';
$bean->bean = $payment;
$bean->dotbpdfBean = $pdf;
$bean->dotbpdfBean->bean = $payment;
$bean->dotbpdfBean->process();
$bean->dotbpdfBean->Output($bean->fileName,'D');
dotb_cleanup(true);
