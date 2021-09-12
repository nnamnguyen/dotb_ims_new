<?php

/*********************************************************************************

 * Description: Holds import setting for Outlook files
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 ********************************************************************************/


class ImportMapOutlook extends ImportMapOther
{
	/**
     * String identifier for this import
     */
    public $name = 'outlook';
	/**
     * Field delimiter
     */
    public $delimiter = ',';
    /**
     * Field enclosure
     */
    public $enclosure = '"';
	/**
     * Do we have a header?
     */
    public $has_header = true;
    
    /**
     * Gets the default mapping for a module
     *
     * @param  string $module
     * @return array field mappings
     */
	public function getMapping(
        $module
        )
    {
        $return_array = parent::getMapping($module);
        switch ($module) {
        case 'Contacts':
        case 'Leads':
            return $return_array + array(
                "Job Title"=>"title",
                "Home Country"=>"alt_address_country",
                "E-mail 2 Address"=>"email2",
                );
            break;
        case 'Accounts':
            return $return_array;
            break;
        default:
            return $return_array;
        }
    }
}


?>
