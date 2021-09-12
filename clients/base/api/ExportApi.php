<?php


require_once('include/export_utils.php');

/*
 * Export API implementation
 */
class ExportApi extends DotbApi
{

    /**
     * This function registers the Rest api
     */
    public function registerApiRest()
    {
        return array(
            'exportGet' => array(
                'reqType' => 'GET',
                'path' => array('<module>', 'export', '?'),
                'pathVars' => array('module', '', 'record_list_id'),
                'method' => 'export',
                'rawReply' => true,
                'allowDownloadCookie' => true,
                'shortHelp' => 'Returns a record set in CSV format along with HTTP headers to indicate content type.',
                'longHelp' => 'include/api/help/module_export_get_help.html',
            ),
        );
    }

    /**
     * Export API
     *
     * @param ServiceBase $api The API class of the request, used in cases where the API changes how the fields are pulled from the args array.
     * @param array $args The arguments array passed in from the API
     * @return String
     */
    public function export(ServiceBase $api, array $args = array())
    {
        $seed = BeanFactory::newBean($args['module']);

        if (!$seed->ACLAccess('export')) {
            throw new DotbApiExceptionNotAuthorized($GLOBALS['app_strings']['ERR_EXPORT_DISABLED']);
        }

        ob_start();
        global $dotb_config;
        global $current_user;
        global $app_list_strings;

        $theModule = clean_string($args['module']);

        if ($dotb_config['disable_export'] || (!empty($dotb_config['admin_export_only']) && !(is_admin(
                        $current_user
                    ) || (ACLController::moduleSupportsACL($theModule) && ACLAction::getUserAccessLevel(
                            $current_user->id,
                            $theModule,
                            'access'
                        ) == ACL_ALLOW_ENABLED &&
                        (ACLAction::getUserAccessLevel($current_user->id, $theModule, 'admin') == ACL_ALLOW_ADMIN ||
                            ACLAction::getUserAccessLevel(
                                $current_user->id,
                                $theModule,
                                'admin'
                            ) == ACL_ALLOW_ADMIN_DEV))))
        ) {
            throw new DotbApiExceptionNotAuthorized($GLOBALS['app_strings']['ERR_EXPORT_DISABLED']);
        }

        //check to see if this is a request for a sample or for a regular export
        if (!empty($args['sample'])) {
            //call special method that will create dummy data for bean as well as insert standard help message.
            $content = exportSampleFromApi($args);

        } else {
            $content = exportFromApi($args);
        }

        $filename = $args['module'];
        //use label if one is defined
        if (!empty($app_list_strings['moduleList'][$args['module']])) {
            $filename = $app_list_strings['moduleList'][$args['module']];
        }

        //strip away any blank spaces
        $filename = str_replace(' ', '', $filename);


        if (isset($args['members']) && $args['members'] == true) {
            $filename .= '_' . 'members';
        }
        ///////////////////////////////////////////////////////////////////////////////
        ////	BUILD THE EXPORT FILE
        ob_end_clean();

        return $this->doExport($api, $filename, $content);
    }

    /**
     * Utility method to allow for subclasses to do the same export calls
     *
     * @param ServiceBase $api
     * @param string $filename The File name for the export
     * @param string $content What should be in the exported file
     * @return mixed
     */
    protected function doExport(ServiceBase $api, $filename, $content)
    {
        //add by TKT
        //27-2-2019
        include_once 'include/export_utils.php';
        ob_start();
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
    }
}
