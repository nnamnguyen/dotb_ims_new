<?php

require_once 'clients/base/api/ExportApi.php';

/**
 * @author Emil Kilhage <emil.kilhage@addoptify.com>
 */
class DRICustomerJourneyTemplatesImportExportApi extends ExportApi
{
    /**
     * @return array
     */
    public function registerApiRest()
    {
        return array(
            'templateImportPost' => array(
                'reqType' => 'POST',
                'path' => array('DRI_Workflow_Templates', 'file', 'template_import'),
                'pathVars' => array('module', '', ''),
                'method' => 'import',
                'rawPostContents' => true,
                'acl' => 'create',
                'shortHelp' => 'Imports a Customer Insight Template from a .json file',
            ),
            'checkTemplateImportPost' => array(
                'reqType' => 'POST',
                'path' => array('DRI_Workflow_Templates', 'file', 'check_template_import'),
                'pathVars' => array('module', '', ''),
                'method' => 'checkImport',
                'rawPostContents' => true,
                'acl' => 'create',
                'shortHelp' => 'Imports a Customer Insight Template from a .json file',
            ),
            'exportGet' => array(
                'reqType' => 'GET',
                'path' => array('DRI_Workflow_Templates', '?', 'export'),
                'pathVars' => array('module', 'record'),
                'method' => 'export',
                'rawReply' => true,
                'allowDownloadCookie' => true,
                'shortHelp' => 'Exports a Customer Insight Template in .json format.',
            ),
        );
    }

    /**
     * @param ServiceBase $api
     * @param array $args
     * @return array
     * @throws DotbApiExceptionMissingParameter
     * @throws DotbApiExceptionNotAuthorized
     * @throws DotbApiExceptionRequestMethodFailure
     */
    public function checkImport(ServiceBase $api, array $args)
    {
        $importer = new \DRI_Workflow_Templates\TemplateImporter();
        $file = $this->getUploadFileName($args);

        try {
            $template = $importer->parseUpload($file);
        } catch (DotbApiExceptionNotAuthorized $e) {
            throw new DotbApiExceptionNotAuthorized('ERROR_UPLOAD_ACCESS_PD');
        }

        try {
            $existing = \DRI_Workflow_Template::getByName($template['name'], $template['id']);
            $template['id'] = $existing->id;
            $duplicate = true;
        } catch (DRI_Workflow_Templates_Exception_NotFound $e) {
            $duplicate = false;
        }

        try {
            $existing = \DRI_Workflow_Template::getById($template['id']);
            $template['id'] = $existing->id;
            $update = true;
        } catch (DRI_Workflow_Templates_Exception_NotFound $e) {
            $update = false;
        }

        return array(
            'duplicate' => $duplicate,
            'update' => $update,
            'record' => array (
                'id' => $template['id'],
                'name' => $template['name'],
            ),
        );
    }

    /**
     * @param ServiceBase $api
     * @param array $args
     * @return array
     * @throws DotbApiExceptionMissingParameter
     * @throws DotbApiExceptionNotAuthorized
     * @throws DotbApiExceptionRequestMethodFailure
     */
    public function import(ServiceBase $api, array $args)
    {
        $importer = new \DRI_Workflow_Templates\TemplateImporter();
        $file = $this->getUploadFileName($args);

        try {
            $template = $importer->importUpload($file);
        } catch (DotbApiExceptionNotAuthorized $e) {
            throw new DotbApiExceptionNotAuthorized('ERROR_UPLOAD_ACCESS_PD');
        }

        return array(
            'record' => array (
                'id' => $template->id,
                'name' => $template->name,
                'new_with_id' => $template->new_with_id,
            ),
        );
    }

    /**
     * @param array $args
     * @return string
     * @throws DotbApiExceptionMissingParameter
     * @throws DotbApiExceptionNotAuthorized
     * @throws DotbApiExceptionRequestMethodFailure
     */
    private function getUploadFileName(array $args)
    {
        $this->requireArgs($args, array('module'));
        $bean = BeanFactory::newBean('DRI_Workflow_Templates');

        if (!$bean->ACLAccess('save') || !$bean->ACLAccess('import')) {
            throw new DotbApiExceptionNotAuthorized('No access to import Customer Insight Templates');
        }

        if (null !== $_FILES && count($_FILES) === 1) {
            reset($_FILES);
            $file = key($_FILES);

            $name = $_FILES[$file]['name'];

            if (false === stripos($name, '.json')) {
                throw new DotbApiExceptionRequestMethodFailure('ERROR_UPLOAD_FAILED');
            }

            return $file;
        }

        throw new DotbApiExceptionMissingParameter('ERROR_UPLOAD_FAILED');
    }

    /**
     * @param ServiceBase $api
     * @param array $args
     * @return string
     * @throws DotbApiExceptionNotAuthorized
     */
    public function export(ServiceBase $api, array $args = array())
    {
        $this->requireArgs($args, array('module', 'record'));
        $bean = $this->loadBean($api, $args);

        if (!$bean->ACLAccess('export')) {
            throw new DotbApiExceptionNotAuthorized('No access to export Customer Insight Templates');
        }

        $name = $bean->name;
        $name = str_replace(' ', '_', $name);
        $filename = sprintf('%s.json', $name);

        $exporter = new \DRI_Workflow_Templates\TemplateExporter();
        $data = $exporter->export($bean);

        if (defined('JSON_PRETTY_PRINT')) {
            $content = json_encode($data, JSON_PRETTY_PRINT);
        } else {
            $content = json_encode($data);
        }

        $content = $this->doExport($api, $filename, $content);

        $api->setHeader('Content-Type', 'application/json; charset=' . $GLOBALS['locale']->getExportCharset());
        $api->setHeader('Content-Disposition', 'attachment; filename=' . $filename);

        return $content;
    }
}
