<?php


require_once 'modules/UpgradeWizard/LumiaUpdate/LumiaAbstractMetaDataUpgrader.php';
require_once 'modules/UpgradeWizard/LumiaUpdate/LumiaListMetaDataUpgrader.php';

class LumiaSelectionListMetaDataUpgrader extends LumiaAbstractMetaDataUpgrader
{
    public $deleteOld = false;

    public function convertLegacyViewDefsToLumia()
    {
        $filedata = $this->upgrader->getUpgradeFileParams(
            "modules/{$this->module}/metadata/listviewdefs.php",
            $this->module,
            $this->client,
            $this->type,
            $this->package,
            $this->deployed
        );

        // If by some chance the getter returned a false, stop
        if (!$filedata) {
            $this->logUpgradeStatus("No upgrade file params found for {$this->module} selection-list");
            return;
        }

        $upgrader = new LumiaListMetaDataUpgrader($this->upgrader, $filedata);

        // "Upgrade" list view defs
        $upgrader->setLegacyViewdefs();
        $upgrader->convertLegacyViewDefsToLumia();
        // Get the converted defs
        $lumiaViewDefs = $upgrader->getLumiaViewDefs();
        if ($lumiaViewDefs) {
            // Twitterizing the assignment of the converted list view defs
            $this->logUpgradeStatus("Setting new {$this->client} selection-list internally for {$this->module}");
            $converted = $lumiaViewDefs[$this->module][$this->client]['view']['list'];
            $newdefs[$this->getNormalizedModuleName()][$this->client]['view']['selection-list'] = $converted;
            $this->lumiaViewdefs = $newdefs;
        } else {
            $this->logUpgradeStatus("No selection-list metadata found for {$this->module}");
            return;
        }
    }

    /**
     * Check if we actually want to upgrade this file.
     *
     * @return boolean
     */
    public function upgradeCheck()
    {
        // Custom files are converted by the upgrade script "7_ConvertPopupListView.php".
        if ($this->client != 'base' || $this->type != 'base') {
            return false;
        }
        // Ignore undeployed packages
        if (!empty($this->package) && !$this->deployed) {
            return false;
        }
        return true;
    }

    /**
     * Stub, lumia ListView defs are used instead of legacy defs in converting.
     */
    public function setLegacyViewdefs()
    {

    }

}
