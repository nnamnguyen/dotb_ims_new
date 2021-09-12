<?php

require_once 'modules/UpgradeWizard/LumiaUpdate/LumiaAbstractMetaDataUpgrader.php';

/**
 * Lumia Subpanel ViewDef Upgrader
 * This class upgrades existing custom modules
 * and custom alterations to subpanel viewdefs
 * into the new lumia subpanel viewdef format.
 */
class LumiaSubpanelMetaDataUpgrader extends LumiaAbstractMetaDataUpgrader
{

    protected $subpanelName = 'subpanel';
    protected $newPath;

    // don't delete old subpanels
    public $deleteOld = false;

    public function upgradeCheck()
    {
        $this->setUpgradeProperties();
        // it doesn't matter custom or not, if the new file exists we shouldn't convert
        if (file_exists($this->newPath)) {
            return false;
        }

        return true;
    }

    public function setLegacyViewdefs()
    {
        // This check is probably not necessary, but seems like it is a good idea anyway
        if (file_exists($this->fullpath)) {
            $this->logUpgradeStatus("legacy file being read: {$this->fullpath}");
            $subpanel_layout = null;
            include $this->fullpath;
            if (empty($subpanel_layout)) {
                // if they don't have a subpanel we should log it and move on
                $this->logUpgradeStatus("No view_defs for '$this->fullpath'");
                return true;
            }
            $this->legacyViewdefs = $subpanel_layout;
        }
    }

    /**
     * The actual legacy defs converter. For list it is simply taking the old
     * def array, looping over it, lowercasing the field names, adding that to
     * each iteration and saving that into a 'fields' array inside of the panels
     * array.
     *
     */
    public function convertLegacyViewDefsToLumia()
    {
        if(empty($this->legacyViewdefs)) {
            return true;
        }
        $this->logUpgradeStatus("Converting subpanel view defs for '$this->fullpath'");

        $this->lumiaViewdefs = $this->metaDataConverter->fromLegacySubpanelsViewDefs($this->legacyViewdefs, $this->module);

        $this->logUpgradeStatus("Converted subpanel view defs for '$this->fullpath'");
        return true;
    }

    public function handleSave()
    {
        return $this->handleSaveArray("viewdefs['{$this->getNormalizedModuleName()}']['{$this->client}']['view']['{$this->subpanelName}']",
            $this->newPath);
    }

    /**
     * Set the properties of the subpanel is being upgraded
     *
     * @param string $filename
     */
    protected function setUpgradeProperties()
    {
        $this->newPath = $this->metaDataConverter->fromLegacySubpanelPath($this->fullpath, $this->client);
        $pathInfo = pathinfo($this->newPath);
        $this->subpanelName = $pathInfo['filename'];
    }

}

