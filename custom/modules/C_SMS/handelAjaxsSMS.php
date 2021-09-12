<?php
switch ($_REQUEST['type']) {
    case 'ajaxGetReceiversFromExcel':
        $result = ajaxGetReceiversFromExcel();
        break;
    case 'ajaxStopStudent':
        $result = ajaxStopStudent();
        break;
    case 'ajaxGetClassList':
        $result = ajaxGetClassList($_POST['student_id']);
        break;
}
echo $result;
die;

function ajaxGetReceiversFromExcel() {
    require_once("custom/include/PHPExcel/vendor/phpoffice/phpexcel/Classes/PHPExcel.php");
    $info = pathinfo($_FILES['fileToUpload']['name']);
    $ext = $info['extension']; // get the extension of the file

    if ($ext != "xlsx" && $ext != "xls") {
        return json_encode(
            array(
                "success" => "0",
                "errorLabel" => "LBL_PLEASE_UPLOAD_EXCEL_FILE",
            )
        );
    }

    $newname = "phone_number_list." . $ext;
    $filename = 'custom/uploads/' . $newname;
    unlink($filename);
    move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $filename);

    $inputFileType = PHPExcel_IOFactory::identify($filename);
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    $objReader->setReadDataOnly(true);
    $objPHPExcel = $objReader->load("$filename");
    $objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
    $highestRow = $objWorksheet->getHighestRow();
    $highestColumn = $objWorksheet->getHighestColumn();
    $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);

    $phoneNumArr = array();
    $countDulicated = 0;
    $countErr = 0;
    $count = 0;
    for ($row = 1; $row <= $highestRow; ++$row) {
        $name = $objWorksheet->getCellByColumnAndRow(0, $row)->getValue(); //Read first column
        $mobile = $objWorksheet->getCellByColumnAndRow(1, $row)->getValue();
        if (empty($mobile)) {
            $mobile = $name;
            $name = '';
        }

        $mobile = preg_replace("/&#?[a-z0-9]+;/i", '', $mobile);
        $mobile = preg_replace('/[^0-9]/', '', $mobile);
        $mobile = preg_replace('/\s+/', '', $mobile);
        if (substr($mobile, 0, 1) != '0' && substr($mobile, 0, 2) != '84') $mobile = '0' . $mobile;

        if (!empty($mobile)) {
            if (array_key_exists($mobile, $phoneNumArr)) {
                $countDulicated++;
                if (!empty($name))
                    $phoneNumArr[$mobile] = str_replace('>', '', $phoneNumArr[$mobile]) . ", $name>";
            } else {
                if (empty($name))
                    $name = '';
                else $name = "<$name>";
                $phoneNumArr[$mobile] = "$name";
                $count++;
            }
        } else $countErr++;
    }
    unlink($filename);

    $receivers = "";
    foreach ($phoneNumArr as $mobile => $name) {
        if (!empty($receivers))
            $receivers .= ", ";
        $receivers .= "$name $mobile";
    }
    $textErr = '';
    if ($countErr > 1)
        $textErr = "<b>{$countErr} Invalid Phone number </b>have been removed<br>";

    $textDuplicate = '';
    if ($countDulicated > 1)
        $textDuplicate = "<b>{$countDulicated} Duplicate Phone number</b> have been auto-merged. <br>";

    return json_encode(
        array(
            "success" => "1",
            "countDulicated" => $countDulicated,
            "receiversText" => $receivers,
            "countRecipients" => $count,
            "receiversJson" => json_encode($phoneNumArr),
            "errorLabel" => "<b>Total Recipients: $count </b><br>$textDuplicate $textErr Before you hit the Send button, check the list of Receivers again.",
        )
    );
}

?>