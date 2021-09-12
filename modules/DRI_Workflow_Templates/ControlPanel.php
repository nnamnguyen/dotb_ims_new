<?php

namespace DRI_Workflow_Templates;

require_once 'modules/DRI_Workflows/Config.php';
require_once 'modules/DRI_Workflows/ConnectorHelper.php';
require_once 'modules/DRI_Workflows/LicenseValidator.php';
require_once 'modules/DRI_Workflow_Templates/TemplateImporter.php';

use DRI_Workflows\Config;
use DRI_Workflows\ConnectorHelper;
use DRI_Workflows\LicenseValidator;

/**
 * @author Emil Kilhage <emil.kilhage@addoptify.com>
 */
class ControlPanel
{
    /**
     * @var ConnectorHelper
     */
    private $helper;

    /**
     * @var Config
     */
    private $config;

    /**
     * ControlPanel constructor.
     */
    public function __construct()
    {
        $this->helper = new ConnectorHelper();
        $this->config = $this->helper->getConfig();
    }

    /**
     * @param bool $force
     */
    public function importTemplates($force = false)
    {
        if ($force || $this->config->getTemplateVersion() !== $this->config->getCurrentVersion()) {
            $importer = new TemplateImporter();
            $importer->importAll();
            $this->config->setTemplateVersion($this->config->getCurrentVersion());
        }
    }

    /**
     * @return array
     * @throws \DRI_Workflow_Templates_Exception_IdNotFound
     * @throws \DotbApiExceptionInvalidParameter
     * @throws \DotbQueryException
     */
    public function resaveAll()
    {
        foreach (\DRI_Workflow_Template::all() as $template) {
            foreach ($template->getStageTemplates() as $stageTemplate) {
                foreach ($stageTemplate->getActivityTemplates() as $activityTemplate) {
                    $activityTemplate->save();
                }

                $stageTemplate->retrieve();
                $stageTemplate->save();
            }

            $template->retrieve();
            $template->save();
        }

        return array ();
    }

    /**
     * @param string $licenseKey
     * @param string $validationKey
     * @throws \DRI_Workflows\Exception\InvalidLicenseException
     * @throws \DotbApiException
     */
    public function validateLicense($licenseKey, $validationKey)
    {
        $this->config->setLicenseKey($licenseKey);
        $this->config->saveValidationKey($validationKey);

        $this->helper->validateLicense(true, true);

        $validator = new LicenseValidator(
            'customer_journey',
            $this->config->getLicenseKey(),
            $this->config->getValidationKey()
        );

        $this->config->setValidUntil($validator->getValidUntil()->format("Y-m-d"));
        $this->config->setUserLimit($validator->getUserLimit());
    }
}
