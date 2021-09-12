<?php




use Dotbcrm\Dotbcrm\ProcessManager;


class PMSEBusinessRules extends vCardApi
{
    public function registerApiRest()
    {
        return array(
            'businessRuleDownload' => array(
                'reqType' => 'GET',
                'path' => array('pmse_Business_Rules', '?', 'brules'),
                'pathVars' => array('module', 'record', ''),
                'method' => 'businessRuleDownload',
                'rawReply' => true,
                'allowDownloadCookie' => true,
                'acl' => 'view',
                'shortHelp' => 'Exports a .pbr file with a Process Business Rules definition',
                'longHelp'  => 'modules/pmse_Business_Rules/clients/base/api/help/business_rules_export_help.html',
            ),
            'businessRulesImportPost' => array(
                'reqType' => 'POST',
                'path' => array('pmse_Business_Rules', 'file', 'businessrules_import'),
                'pathVars' => array('module', '', ''),
                'method' => 'businessRulesImport',
                'rawPostContents' => true,
                'acl' => 'create',
                'shortHelp' => 'Imports a Process Business Rules definition from a .pbr file',
                'longHelp'  => 'modules/pmse_Business_Rules/clients/base/api/help/business_rules_import_help.html',
            ),
        );
    }

    /**
     * @param $api
     * @param $args
     * @return array
     * @throws DotbApiExceptionMissingParameter
     * @throws DotbApiExceptionRequestMethodFailure
     * @throws DotbApiExceptionNotAuthorized
     */
    public function businessRulesImport($api, $args)
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
                && !empty($_FILES[$first_key]['size'])
            ) {
                $importerObject = PMSEImporterFactory::getImporter('business_rule');
                $name = $_FILES[$first_key]['name'];
                $extension = pathinfo($name,  PATHINFO_EXTENSION);
                if ($extension == $importerObject->getExtension()) {
                    try {
                        $data = $importerObject->importProject($_FILES[$first_key]['tmp_name']);
                    } catch (DotbApiExceptionNotAuthorized $e) {
                        $e->setMessage('ERROR_UPLOAD_ACCESS_BR');
                        PMSELogger::getInstance()->alert($e->getMessage());
                        throw $e;
                    }
                    $results = array('businessrules_import' => $data);
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
     * @param $api
     * @param $args
     * @return string
     * @throws DotbApiExceptionMissingParameter
     */
    public function businessRuleDownload($api, $args)
    {
        ProcessManager\AccessManager::getInstance()->verifyAccess($api, $args);
        $businessRule = $this->getPMSEBusinessRuleExporter();
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

        return $businessRule->exportProject($args['record'], $api);
    }

    /*
     * @return PMSEBusinessRuleExporter
     */
    public function getPMSEBusinessRuleExporter()
    {
        return ProcessManager\Factory::getPMSEObject('PMSEBusinessRuleExporter');
    }
}
