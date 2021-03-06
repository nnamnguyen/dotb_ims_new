<?php


require_once('include/download_file.php');
/**
 * @api
 */
class ReportsExportApi extends DotbApi {
    // how long the cache is ok, in minutes
    private $cacheLength = 10;

    public function registerApiRest() {
        return array(
            'exportRecord' => array(
                'reqType' => 'GET',
                'path' => array('Reports', '?', '?'),
                'pathVars' => array('module', 'record', 'export_type'),
                'method' => 'exportRecord',
                'rawReply'=> true,
                'shortHelp' => 'This method exports a record in the specified type',
                'longHelp' => '',
            ),
        );
    }

    /**
     * Export Report records into various files, now just pdf
     * @param ServiceBase $api The service base
     * @param array $args Arguments array built by the service base
     * @return binary file
     */
    public function exportRecord(ServiceBase $api, array $args)
    {

        $this->requireArgs($args,array('record', 'export_type'));
        $args['module'] = 'Reports';

        $GLOBALS['disable_date_format'] = FALSE;

        $method = 'export' . ucwords($args['export_type']);

        if(!method_exists($this, $method)) {
            throw new DotbApiExceptionNoMethod('Export Type Does Not Exists');
        }

        $saved_report = $this->loadBean($api, $args, 'view');

        if(!$saved_report->ACLAccess('view')) {
            throw new DotbApiExceptionNotAuthorized('No access to view records for module: Reports');
        }

        return $this->$method($api, $saved_report);

    }

    /**
     * Export a Base64 PDF Report
     * @param DotbBean report
     * @return file contents
     */
    protected function exportBase64(ServiceBase $api, DotbBean $report)
    {
        global  $beanList, $beanFiles;
        global $dotb_config,$current_language;
        require_once('modules/Reports/templates/templates_pdf.php');
        $contents = '';
        $report_filename = false;
        if($report->id != null)
        {
            //Translate pdf to correct language
            $reporter = new Report(html_entity_decode($report->content), '', '');
            $reporter->layout_manager->setAttribute("no_sort",1);
            $reporter->fromApi = true;
            //Translate pdf to correct language
            $mod_strings = return_module_language($current_language, 'Reports');

            //Generate actual pdf
            $report_filename = template_handle_pdf($reporter, false);

            dotb_cache_put($report->id . '-' . $GLOBALS['current_user']->id, $report_filename, $this->cacheLength * 60);

            $dl = new DownloadFile();
            $contents = $dl->getFileByFilename($report_filename);
        }
        if(empty($contents)) {
            throw new DotbApiException('File contents empty.');
        }
        // Reply is raw just pass back the base64 encoded contents
        return base64_encode($contents);
    }

    /**
     * Export a Report As PDF
     * @param DotbBean $report
     * @return null
     */
    protected function exportPdf(ServiceBase $api, DotbBean $report)
    {
        global  $beanList, $beanFiles;
        global $dotb_config,$current_language;
        require_once('modules/Reports/templates/templates_pdf.php');
        $report_filename = false;
        if($report->id != null)
        {
            //Translate pdf to correct language
            $reporter = new Report(html_entity_decode($report->content), '', '');
            $reporter->layout_manager->setAttribute("no_sort",1);
            $reporter->fromApi = true;
            $reporter->saved_report_id = $report->id;
            $reporter->is_saved_report = true;
            //Translate pdf to correct language
            $mod_strings = return_module_language($current_language, 'Reports');

            //Generate actual pdf
            $report_filename = template_handle_pdf($reporter, false);

            $api->setHeader("Content-Type", "application/pdf");
            $api->setHeader("Content-Disposition", 'attachment; filename="'.basename($report_filename).'"');
            $api->setHeader("Expires", TimeDate::httpTime(time() + 2592000));
            $api->fileResponse($report_filename);
        }
    }
}