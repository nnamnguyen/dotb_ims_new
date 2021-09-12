<?php

/*********************************************************************************

 * Description: Holds import setting for CSV files
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 ********************************************************************************/
 

class ImportMapCsv extends ImportMapOther
{
	/**
     * String identifier for this import
     */
    public $name = 'csv';
	/**
     * Field delimiter
     */
    public $delimiter = ',';
    /**
     * Field enclosure
     */
    public $enclosure;
}
?>
