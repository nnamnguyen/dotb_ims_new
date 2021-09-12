<?php

/*********************************************************************************

 * Description: Holds import setting for TSV (Tab Delimited) files
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 ********************************************************************************/
 

class ImportMapTab extends ImportMapOther
{
	/**
     * String identifier for this import
     */
    public $name = 'tab';
	/**
     * Field delimiter
     */
    public $delimiter = "\t";
    /**
     * Field enclosure
     */
    public $enclosure;
}


?>
