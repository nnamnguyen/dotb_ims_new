<?php
if (!defined('dotbEntry') || !dotbEntry) die('Not A Valid Entry Point');

//Bug 30094, If zlib is enabled, it can break the calls to header() due to output buffering. This will only work php5.2+
ini_set('zlib.output_compression', 'Off');

ob_start();
require_once('include/export_utils.php');
global $dotb_config;
global $locale;
global $current_user;
global $app_list_strings;

$the_module = clean_string($_REQUEST['module']);

if ($dotb_config['disable_export'] || (!empty($dotb_config['admin_export_only']) && !(is_admin($current_user) || (ACLController::moduleSupportsACL($the_module) && ACLAction::getUserAccessLevel($current_user->id, $the_module, 'access') == ACL_ALLOW_ENABLED &&
                (ACLAction::getUserAccessLevel($current_user->id, $the_module, 'admin') == ACL_ALLOW_ADMIN ||
                    ACLAction::getUserAccessLevel($current_user->id, $the_module, 'admin') == ACL_ALLOW_ADMIN_DEV))) ||
        !DotbACL::checkAccess($the_module, 'export'))) {
    die($GLOBALS['app_strings']['ERR_EXPORT_DISABLED']);
}

//check to see if this is a request for a sample or for a regular export
if (!empty($_REQUEST['sample'])) {
    //call special method that will create dummy data for bean as well as insert standard help message.
    $content = exportSample(clean_string($_REQUEST['module']));

} else if (!empty($_REQUEST['uid'])) {
    $content = export(clean_string($_REQUEST['module']), $_REQUEST['uid'], isset($_REQUEST['members']) ? $_REQUEST['members'] : false);
} else {
    $content = export(clean_string($_REQUEST['module']));
}
$filename = $_REQUEST['module'];
//use label if one is defined
if (!empty($app_list_strings['moduleList'][$_REQUEST['module']])) {
    $filename = $app_list_strings['moduleList'][$_REQUEST['module']];
}

//strip away any blank spaces
$filename = str_replace(' ', '', $filename);

$transContent = $GLOBALS['locale']->translateCharset($content, 'UTF-8', $GLOBALS['locale']->getExportCharset());

if (isset($_REQUEST['members']) && $_REQUEST['members'] == true) {
    $filename .= '_' . 'members';
}

//add by TKT
//26-2-2019
$content = explode("\"\r\n\"", $content);

foreach ($content as $val) {
    $temp = explode("\"" . getDelimiter() . "\"", $val);
    $data[] = $temp;
}

include_once 'custom/include/PHPExcel/vendor/autoload.php';
$objPHPExcel = new PHPExcel();

//Set document properties
$objPHPExcel->getProperties()->setCreator("DotB")
    ->setLastModifiedBy("DotB")
    ->setTitle($filename)
    ->setSubject("Office 2007 XLSX Test Document")
    ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
    ->setKeywords("office 2007 openxml php")
    ->setCategory("Test result file");


//Add export data
$activeSheet = $objPHPExcel->setActiveSheetIndex(0);

$row_num = 1;
foreach ($data as $row) {
    $col_num = 0;
    foreach ($row as $key => $value) {
        $value = preg_replace('/\\"/', '', $value);
        $activeSheet->setCellValueExplicitByColumnAndRow($col_num, $row_num, $value);
        //Bold for header row
        if ($row_num == 1) {
            $activeSheet->getStyleByColumnAndRow($col_num, $row_num)->getFont()->setBold(true);
            $activeSheet->getStyleByColumnAndRow($col_num, $row_num)->applyFromArray(
                array(
                    'font' => array(
                        'color' => array('rgb' => 'FFFFFF')
                    ),
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => '47BB7F')
                    )
                )
            );
            $activeSheet->getColumnDimensionByColumn($col_num)->setAutoSize(true);
        }
        $col_num++;
    }
    $row_num++;
}

//Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle($filename);

//Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

//Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
header('Cache-Control: max-age=0');


$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save("php://output");

dotb_cleanup(true);
