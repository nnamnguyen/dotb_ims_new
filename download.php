<?php
if (!defined('dotbEntry') || !dotbEntry) die('Not A Valid Entry Point');


use Dotbcrm\Dotbcrm\Security\InputValidation\InputValidation;

global $db;

if ((!isset($_REQUEST['isProfile']) && empty($_REQUEST['id'])) || empty($_REQUEST['type']) || !isset($_SESSION['authenticated_user_id'])) {
    die("Not a Valid Entry Point");
} else {

    $file_type = ''; // bug 45896
    ini_set('zlib.output_compression', 'Off');//bug 27089, if use gzip here, the Content-Length in header may be incorrect.
    // cn: bug 8753: current_user's preferred export charset not being honored
    if (isset($_SESSION['authenticated_user_id'])) {
        $GLOBALS['current_user']->retrieve($_SESSION['authenticated_user_id']);
    }
    if (isset($_SESSION['authenticated_user_language'])) {
        $GLOBALS['current_language'] = $_SESSION['authenticated_user_language'];
    }
    $app_strings = return_application_language($GLOBALS['current_language']);
    $mod_strings = return_module_language($GLOBALS['current_language'], 'ACL');
    $file_type = strtolower($_REQUEST['type']);
    $check_image = false;
    if (!isset($_REQUEST['isTempFile'])) {
        //Custom modules may have capitalizations anywhere in their names. We should check the passed in format first.
        require('include/modules.php');
        $module = $db->quote($_REQUEST['type']);
        if (empty($beanList[$module])) {
            //start guessing at a module name
            $module = ucfirst($file_type);
            if (empty($beanList[$module])) {
                die($app_strings['ERROR_TYPE_NOT_VALID']);
            }
        }
        $bean_name = $beanList[$module];
        if (!DotbAutoLoader::existing('modules/' . $module . '/' . $bean_name . '.php')) {
            die($app_strings['ERROR_TYPE_NOT_VALID']);
        }

        $focus = BeanFactory::newBean($module);
        if (!$focus->ACLAccess('view')) {
            die($mod_strings['LBL_NO_ACCESS']);
        } // if
        $focus->retrieve($_REQUEST['id']);
        // Pull up the document revision, if it's of type Document
        if (isset($focus->object_name) && $focus->object_name == 'Document') {
            // It's a document, get the revision that really stores this file
            $focusRevision = BeanFactory::getBean('DocumentRevisions', $_REQUEST['id']);

            if (empty($focusRevision->id)) {
                // This wasn't a document revision id, it's probably actually a document id,
                // we need to grab the latest revision and use that
                $focusRevision->retrieve($focus->document_revision_id);

                if (!empty($focusRevision->id)) {
                    $_REQUEST['id'] = $focusRevision->id;
                }
            }
        }

        // See if it is a remote file, if so, send them that direction
        if (isset($focus->doc_url) && !empty($focus->doc_url)) {
            header('Location: ' . $focus->doc_url);
            echo "Remote file detected, location header sent.";
            dotb_cleanup(true);
        }

        if (isset($focusRevision) && isset($focusRevision->doc_url) && !empty($focusRevision->doc_url)) {
            header('Location: ' . $focusRevision->doc_url);
            echo "Remote file detected, location header sent.";
            dotb_cleanup(true);
        }

    } // if

    // Add the input validation for paths
    $request = InputValidation::getService();
    if (isset($_REQUEST['ieId']) && isset($_REQUEST['isTempFile'])) {
        $ieId = $request->getValidInputRequest('ieId', 'Assert\Guid');
        $id = $request->getValidInputRequest('id', 'Assert\Guid');
        $local_location = dotb_cached("modules/Emails/{$ieId}/attachments/{$id}");
    } elseif (isset($_REQUEST['isTempFile']) && $file_type == "import") {
        $tempName = $request->getValidInputRequest('tempName');
        $local_location = "upload://import/{$tempName}";
    } else if ($file_type == 'notes') {
        $note = BeanFactory::newBean('Notes');
        if (!$note->ACLAccess('view')) {
            die($mod_strings['LBL_NO_ACCESS']);
        } // if
        $id = $request->getValidInputRequest('id', 'Assert\Guid');
        $note->retrieve($id);
        $local_location = "upload://" . $note->getUploadId();
    } else {
        $id = $request->getValidInputRequest('id', 'Assert\Guid');
        $local_location = "upload://{$id}";
    }

    if (isset($_REQUEST['isTempFile']) && ($_REQUEST['type'] == "DotbFieldImage")) {
        $id = $request->getValidInputRequest('id', 'Assert\Guid');
        $local_location = "upload://{$id}";
    }

    if (isset($_REQUEST['isTempFile']) && ($_REQUEST['type'] == "DotbFieldImage") && (isset($_REQUEST['isProfile'])) && empty($_REQUEST['id'])) {
        $local_location = "include/images/default-profile.png";
    }

    if (!file_exists($local_location) || strpos($local_location, "..")) {
        die($app_strings['ERR_INVALID_FILE_REFERENCE']);
    } else {
        $doQuery = true;

        if ($file_type == 'documents') {
            // cn: bug 9674 document_revisions table has no 'name' column.
            $query = "SELECT filename name FROM document_revisions INNER JOIN documents ON documents.id = document_revisions.document_id ";
            if (!$focus->disable_row_level_security) {
                // We need to confirm that the user is a member of the team of the item.
                $focus->add_team_security_where_clause($query);
            }
            $query .= "WHERE document_revisions.id = '" . $db->quote($_REQUEST['id']) . "' ";
        } elseif ($file_type == 'notes') {
            $query = "SELECT filename name FROM notes ";
            if (!$focus->disable_row_level_security) {
                $focus->add_team_security_where_clause($query);
            }
            $query .= "WHERE notes.id = '" . $db->quote($_REQUEST['id']) . "'";
            $check_image = true;
        } elseif ($file_type === 'pdfmanager') {
            $query = "SELECT header_logo name FROM pdfmanager ";
            if (!$focus->disable_row_level_security) {
                $focus->add_team_security_where_clause($query);
            }
            $query .= "WHERE pdfmanager.id = '" . $db->quote($_REQUEST['id']) . "'";
        } elseif (!isset($_REQUEST['isTempFile']) && !isset($_REQUEST['tempName']) && isset($_REQUEST['type']) && $file_type != 'temp') { //make sure not email temp file.
            $query = "SELECT filename name FROM " . $file_type . " ";
            if (!$focus->disable_row_level_security) {
                $focus->add_team_security_where_clause($query);
            }
            $query .= "WHERE " . $file_type . ".id= '" . $db->quote($_REQUEST['id']) . "'";
        } elseif ($file_type == 'temp') {
            $doQuery = false;
        }

        if ($doQuery && isset($query)) {
            $row = $GLOBALS['db']->fetchOne($query);

            if (empty($row)) {
                die($app_strings['ERROR_NO_RECORD']);
            }
            $name = $row['name'];
            if ($file_type == 'notes') {
                $download_location = $local_location;
            } else {
                $id = $request->getValidInputRequest('id', 'Assert\Guid');
                $download_location = "upload://{$id}";
            }
        } else if (isset($_REQUEST['tempName']) && isset($_REQUEST['isTempFile'])) {
            // downloading a temp file (email 2.0)
            $download_location = $local_location;
            $name = isset($_REQUEST['tempName']) ? $_REQUEST['tempName'] : '';
        } else if (isset($_REQUEST['isTempFile']) && ($_REQUEST['type'] == "DotbFieldImage")) {
            $download_location = $local_location;
            $name = isset($_REQUEST['tempName']) ? $_REQUEST['tempName'] : '';
        }

        if (isset($_SERVER['HTTP_USER_AGENT']) && preg_match("/MSIE/", $_SERVER['HTTP_USER_AGENT'])) {
            $name = urlencode($name);
            $name = str_replace("+", "_", $name);
        }

        header("Pragma: public");
        header("Cache-Control: max-age=1, post-check=0, pre-check=0");
        if (isset($_REQUEST['isTempFile']) && ($_REQUEST['type'] == "DotbFieldImage")) {
            $mime = getimagesize($download_location);
            if (!empty($mime)) {
                header("Content-Type: {$mime['mime']}");
            } else {
                header("Content-Type: image/png");
            }
        } else {

            if ($check_image && ($mime = getimagesize($download_location)) !== false) {
                header("Content-Type: " . $mime['mime']);
            } else {
                header("Content-type: application/octet-stream");
            }

            //edit by TKT
            if (preg_match('/\.csv$/', $name)) {
                $namet = str_replace('.csv', '.xlsx', $name);
                header("Content-Disposition: attachment; filename=\"" . $namet . "\"");
            } else {
                header("Content-Disposition: attachment; filename=\"" . $name . "\"");
            }

        }
        // disable content type sniffing in MSIE
        header("X-Content-Type-Options: nosniff");
        header("Content-Length: " . filesize($local_location));
        header('Expires: ' . gmdate('D, d M Y H:i:s \G\M\T', time() + 2592000));
        set_time_limit(0);

        @ob_end_clean();
        ob_start();

        //edit by TKT
        //////////////////////////////////////////////////////////////////////
        if (preg_match('/\.csv$/', $name)) {
            include_once 'include/export_utils.php';
            $filename = str_replace('.csv', '', $name);
            $content = file_get_contents($download_location);
            $content = explode("\n", $content);

            foreach ($content as $val) {
                $temp = explode(",", $val);
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

            //Redirect output to a client???s web browser (Excel5)
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
            header('Cache-Control: max-age=0');


            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            $objWriter->save("custom/uploads/file_export.xlsx");

            //output file
            @ob_clean();
            ob_start();
            header('Location: custom/uploads/file_export.xlsx');
            @ob_flush();
            exit;


            /////////////////////////////////////////////////////////////////////////////////
        } else {
            readfile($download_location);
        }

        @ob_flush();
    }
}
?>
