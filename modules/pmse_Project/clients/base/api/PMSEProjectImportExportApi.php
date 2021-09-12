<?php



use Dotbcrm\Dotbcrm\Security\Validator\Validator;
use Dotbcrm\Dotbcrm\Security\Validator\Constraints\JSON as JSONConstraint;
use Dotbcrm\Dotbcrm\ProcessManager;

class PMSEProjectImportExportApi extends vCardApi
{
    /**
     *
     * @return type
     */
    public function registerApiRest()
    {
        return array(
            'projectImportPost' => array(
                'reqType' => 'POST',
                'path' => array('pmse_Project', 'file', 'project_import'),
                'pathVars' => array('module', '', ''),
                'method' => 'projectImport',
                'rawPostContents' => true,
                'acl' => 'create',
                'shortHelp' => 'Imports a Process Definition from a .bpm file',
                'longHelp'  => 'modules/pmse_Project/clients/base/api/help/project_import_help.html',
                'exceptions' => array(
                    'DotbApiExceptionNotAuthorized',
                    'DotbApiExceptionNotAuthorized',
                    'DotbApiExceptionRequestMethodFailure',
                    'DotbApiExceptionMissingParameter',
                ),
            ),
            'projectDownload' => array(
                'reqType' => 'GET',
                'path' => array('pmse_Project', '?', 'dproject'),
                'pathVars' => array('module', 'record', ''),
                'method' => 'projectDownload',
                'rawReply' => true,
                'allowDownloadCookie' => true,
                'acl' => 'view',
                'shortHelp' => 'Exports a .bpm file with a Process Definition',
                'longHelp'  => 'modules/pmse_Project/clients/base/api/help/project_export_help.html',
            ),
        );
    }

    public function projectDownload(ServiceBase $api, array $args)
    {
        ProcessManager\AccessManager::getInstance()->verifyAccess($api, $args);
        $projectBean = ProcessManager\Factory::getPMSEObject('PMSEProjectExporter');
        $requiredFields = array('record', 'module');
        foreach ($requiredFields as $fieldName) {
            if (!array_key_exists($fieldName, $args)) {
                $dotbApiExceptionMissingParameter = new DotbApiExceptionMissingParameter(
                    'Missing parameter: ' . $fieldName
                );
                PMSELogger::getInstance()->alert($dotbApiExceptionMissingParameter->getMessage());
                throw $dotbApiExceptionMissingParameter;
            }
        }
        
        if (PMSEEngineUtils::isExportDisabled($args['module'])) {
            $dotbApiExceptionNotAuthorized = new DotbApiExceptionNotAuthorized(
                $GLOBALS['app_strings']['ERR_EXPORT_DISABLED']
            );
            PMSELogger::getInstance()->alert($dotbApiExceptionNotAuthorized->getMessage());
            throw $dotbApiExceptionNotAuthorized;
        }

        return $projectBean->exportProject($args['record'], $api);
    }

    public function projectImport(ServiceBase $api, array $args)
    {
        ProcessManager\AccessManager::getInstance()->verifyAccess($api, $args);
        $this->requireArgs($args, array('module'));

        $bean = BeanFactory::newBean($args['module']);
        if (!$bean->ACLAccess('save') || !$bean->ACLAccess('import')) {
            $dotbApiExceptionNotAuthorized = new DotbApiExceptionNotAuthorized('EXCEPTION_NOT_AUTHORIZED');
            PMSELogger::getInstance()->alert($dotbApiExceptionNotAuthorized->getMessage());
            throw $dotbApiExceptionNotAuthorized;
        }

        if (isset($_FILES) && count($_FILES) === 1) {
            reset($_FILES);
            $first_key = key($_FILES);
            if (isset($_FILES[$first_key]['tmp_name'])
                && $this->isUploadedFile($_FILES[$first_key]['tmp_name'])
                && isset($_FILES[$first_key]['size'])
                && isset($_FILES[$first_key]['size']) > 0
            ) {
                $importerObject = PMSEImporterFactory::getImporter('project');
                $name = $_FILES[$first_key]['name'];
                $extension = pathinfo($name,  PATHINFO_EXTENSION);
                $options = $this->getOptions();
                if ($extension == $importerObject->getExtension()) {
                    try {
                        $data = $importerObject->importProject($_FILES[$first_key]['tmp_name'], $options);
                    } catch (DotbApiExceptionNotAuthorized $e) {
                        $e->setMessage('ERROR_UPLOAD_ACCESS_PD');
                        PMSELogger::getInstance()->alert($e->getMessage());
                        throw $e;
                    }
                    $results = array('project_import' => $data);
                } else  {
                    $dotbApiExceptionRequestMethodFailure = new DotbApiExceptionRequestMethodFailure(
                        'ERROR_UPLOAD_FAILED'
                    );
                    PMSELogger::getInstance()->alert($dotbApiExceptionRequestMethodFailure->getMessage());
                    throw $dotbApiExceptionRequestMethodFailure;
                }
                return $results;
            }
        } else {
            $dotbApiExceptionMissingParameter = new DotbApiExceptionMissingParameter('ERROR_UPLOAD_FAILED');
            PMSELogger::getInstance()->alert($dotbApiExceptionMissingParameter->getMessage());
            throw $dotbApiExceptionMissingParameter;
        }
    }

    /**
     * Get options to pass to importer
     * @return array
     */
    private function getOptions()
    {
        $options = [];
        $sids = isset($_POST['selectedIds']) ? $_POST['selectedIds'] : '';
        $violations = Validator::getService()->validate($sids, new JSONConstraint());
        if (count($violations) === 0) {
            $options['selectedIds'] = json_decode($sids, true);
        }
        return $options;
    }
}

