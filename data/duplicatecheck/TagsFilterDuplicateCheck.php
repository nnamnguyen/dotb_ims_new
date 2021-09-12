<?php



/**
 * This method of duplicate check passes a configurable set of filters off to the Filter API to find duplicates.
 */
class TagsFilterDuplicateCheck extends FilterDuplicateCheck
{
    /**
     * @inheritDoc
     */
    public function getValueFromField($inField)
    {
        // For tags we want lower case name duplicate comparison
        return strtolower($this->bean->$inField);
    }
}
