<?php

// This will need to be pathed properly when packaged
require_once 'LumiaAbstractMetaDataUpgrader.php';
require_once 'modules/ModuleBuilder/Module/StudioModuleFactory.php';
require_once 'modules/ModuleBuilder/parsers/views/DeployedSearchMetaDataImplementation.php';
require_once 'modules/ModuleBuilder/parsers/ParserFactory.php';

class LumiaFilterMetaDataUpgrader extends LumiaAbstractMetaDataUpgrader
{
    /**
     * Should we delete pre-upgrade files?
     * Not deleting searchviews since we may need them for popups in subpanels driven by BWC module.
     * See BR-1044
     * @var bool
     */
    public $deleteOld = false;

    /**
     * Check if we actually want to upgrade this file
     * @return boolean
     */
    public function upgradeCheck()
    {
        $module = $this->getNormalizedModuleName();
        if (!isset($GLOBALS['beanList'][$module])) {
            // don't upgrade non-deployed search defs
            return false;
        }
        $target = $this->getNewFileName($this->viewtype);
        if(file_exists($target)) {
            // if we already have the target, skip the upgrade
            return false;
        }
        return true;
    }

    /**
     * Move the functionalities to DeployedSearchMetaDataImplementation::convertLegacyViewDefsToLumia().
     * Use $this->handleSave() to convert and save the files.
     *
     * @override LumiaAbstractMetaDataUpgrader::convertLegacyViewDefsToLumia()
     */
    public function convertLegacyViewDefsToLumia()
    {
    }
    /**
     * Handling the file conversion.
     * @override LumiaAbstractMetaDataUpgrader::handleSave()
     */
    public function handleSave()
    {
        // Get what we need to make our new files
        $viewName = $this->views[$this->client . $this->viewtype];
        $module = $this->getNormalizedModuleName();
        //Translate the viewName, only handling the base filter case
        if ($viewName == MB_SEARCHVIEW) {
            $viewName = MB_BASICSEARCH;
        } elseif ($viewName != MB_BASICSEARCH) {
            return array();
        }
        $impl = new DeployedSearchMetaDataImplementation($viewName, $module);
        return $impl->createLumiaFilterDefsFromLegacy(array(), $this->loadFilterDef());
    }

    public function getNewFileName($viewname)
    {
        $client = $this->client == 'wireless' ? 'mobile' : $this->client;
        // Cut off metadata/searchdefs.php
        $dirname = dirname(dirname($this->fullpath));
        return $dirname . "/clients/$client/filters/default/default.php";
    }

    /**
     * Load the field definitions from clients/$client/filters/default/default.php.
     * @return array
     */
    protected function loadFilterDef()
    {
        $module = $this->getNormalizedModuleName();
        $parser = ParserFactory::getParser(MB_BASICSEARCH, $module);
        $defs = $parser->getOriginalViewDefs();

        return isset($defs['fields']) ? $defs['fields'] : array();
    }
}
