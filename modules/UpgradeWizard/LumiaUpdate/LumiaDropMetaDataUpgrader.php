<?php

// This will need to be pathed properly when packaged
require_once 'modules/UpgradeWizard/LumiaUpdate/LumiaAbstractMetaDataUpgrader.php';

class LumiaDropMetaDataUpgrader extends LumiaAbstractMetaDataUpgrader
{
    public function convertLegacyViewDefsToLumia()
    {
    }

    public function upgrade()
    {
        // does nothing, the upgrade driver then will just delete the old file
        return true;
    }
}
