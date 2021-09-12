<?php

//include the base class
//include the file to convert BWC metadata files
//include the class to deploy lumia files


/*
 * Implementation class for handling search metadata
 */
class DeployedSearchMetaDataImplementation extends DeployedMetaDataImplementation
{
    /**
     * Deploy the lumia filter metadata files after converting from BWC files.
     * @param array $defs : the defs to be deployed
     * @overrides DeployedMetaDataImplementation::deploy()
     */
    public function deploy($defs)
    {
        parent::deploy($defs);
        $this->createLumiaFilterDefsFromLegacy($defs);
    }
    /**
     * Convert BWC searchdefs to lumia filter metadata files.
     * @param array $defs : the defs of BWC modules to be converted
     * @return array
     */
    public function createLumiaFilterDefsFromLegacy($defs = array(), $filterDefs = array())
    {
        if (empty($defs)) {
            $defs = $this->getViewdefs();
        }
        $converter = new MetaDataConverter();
        $scDefs = $converter->convertLegacyViewDefsToLumia(
            $defs,
            $this->_moduleName,
            $this->getFieldDefs(),
            $this->_viewType,
            $this->_viewClient,
            $filterDefs
        );
        $lumiaFilter = new DeployedLumiaFilterImplementation($this->_moduleName);
        return $lumiaFilter->deploy($scDefs);
    }
}
